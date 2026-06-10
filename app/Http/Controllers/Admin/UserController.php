<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter - default to 'user' role if not specified
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        } else {
            // Default filter: show only 'user' role
            $userRole = Role::where('slug', 'user')->first();
            if ($userRole) {
                $query->where('role_id', $userRole->id);
            }
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $users = $query->paginate(15)->withQueryString();

        // Get filter options data
        $statuses = ['active', 'inactive', 'banned', 'pending'];
        $roles = Role::where('status', 'active')->get();

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create(): View
    {
        $roles = Role::where('status', 'active')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,banned,pending',
            'email_verified' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
            'email_verified_at' => $request->has('email_verified') ? now() : null,
        ]);

        // Optional: Send welcome email
        // Mail::to($user->email)->send(new WelcomeUser($user, $request->password));

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit(User $user): View
    {
        $roles = Role::where('status', 'active')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,banned,pending',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,banned,pending'
        ]);

        $oldStatus = $user->status;
        $user->status = $request->status;
        $user->save();

        // Check if it's an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "User status changed from " . ucfirst($oldStatus) . " to " . ucfirst($user->status),
                'new_status' => $user->status
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', "User status changed from " . ucfirst($oldStatus) . " to " . ucfirst($user->status));
    }
}