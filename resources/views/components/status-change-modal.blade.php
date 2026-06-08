<x-modal id="statusModal-{{ $userId }}" 
         title="Change User Status" 
         size="md">
    
    <form action="{{ route('admin.users.update-status', $userId) }}" 
          method="POST" 
          id="statusForm-{{ $userId }}">
        @csrf
        @method('PATCH')
        
        <div class="space-y-4">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Change the status for this user account.
            </p>
            
            <div class="space-y-3">
                @foreach($statuses as $value => $status)
                    <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <input type="radio" 
                               name="status" 
                               value="{{ $value }}"
                               {{ $currentStatus === $value ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <div class="flex-1">
                            <span class="font-medium text-slate-900 dark:text-white">{{ $status['label'] }}</span>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                @switch($value)
                                    @case('active')
                                        User can login and access all features
                                        @break
                                    @case('inactive')
                                        User cannot login but account remains
                                        @break
                                    @case('banned')
                                        User is permanently blocked
                                        @break
                                    @case('pending')
                                        Waiting for approval
                                        @break
                                @endswitch
                            </p>
                        </div>
                        @if($currentStatus === $value)
                            <span class="text-xs text-green-600 dark:text-green-400">Current</span>
                        @endif
                    </label>
                @endforeach
            </div>
        </div>
        
        <x-slot name="footer">
            <button type="button" 
                    onclick="closeModal('statusModal-{{ $userId }}')"
                    class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                Cancel
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                Update Status
            </button>
        </x-slot>
    </form>
</x-modal>

<script>
function openStatusModal(userId) {
    openModal(`statusModal-${userId}`);
}
</script>