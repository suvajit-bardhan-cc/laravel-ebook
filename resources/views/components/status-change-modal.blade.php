@props(['userId', 'currentStatus'])

<x-modal id="statusModal-{{ $userId }}" 
         title="Change User Status" 
         size="md">
    
    <form action="{{ route('admin.users.update-status', $userId) }}" 
          method="POST" 
          id="statusForm-{{ $userId }}"
          data-user-id="{{ $userId }}"
          class="status-form">
        @csrf
        @method('PATCH')
        
        <div class="space-y-4">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Change the status for this user account.
            </p>
            
            <div class="space-y-3">
                @php
                    $statuses = [
                        'active' => ['label' => 'Active', 'color' => 'green', 'description' => 'User can login and access all features'],
                        'inactive' => ['label' => 'Inactive', 'color' => 'gray', 'description' => 'User cannot login but account remains'],
                        'banned' => ['label' => 'Banned', 'color' => 'red', 'description' => 'User is permanently blocked'],
                        'pending' => ['label' => 'Pending', 'color' => 'yellow', 'description' => 'Waiting for approval'],
                    ];
                @endphp
                
                @foreach($statuses as $value => $status)
                    <label class="flex items-start gap-3 p-3 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <input type="radio" 
                               name="status" 
                               value="{{ $value }}"
                               {{ $currentStatus === $value ? 'checked' : '' }}
                               class="mt-1 w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-slate-900 dark:text-white">{{ $status['label'] }}</span>
                                @if($currentStatus === $value)
                                    <span class="text-xs text-green-600 dark:text-green-400">(Current)</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                {{ $status['description'] }}
                            </p>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        
        <div class="flex justify-end gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 rounded-b-lg">
            <button type="button" 
                    onclick="closeModal('statusModal-{{ $userId }}')"
                    class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                Cancel
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                Update Status
            </button>
        </div>
    </form>
</x-modal>

<script>
console.log('Status modal script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded triggered');
    const forms = document.querySelectorAll('.status-form');
    console.log('Found', forms.length, 'status forms');
    
    forms.forEach((form, index) => {
        console.log('Attaching listener to form', index);
        form.addEventListener('submit', function(e) {
            console.log('Form submit event triggered');
            e.preventDefault();
            
            const userId = this.getAttribute('data-user-id');
            console.log('Processing form for user:', userId);
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = 'Updating...';
            submitBtn.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                console.log('Response received:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showNotification(data.message, 'success');
                    closeModal(`statusModal-${userId}`);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification(data.message || 'Error updating status', 'error');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred. Please try again.', 'error');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
            
            return false;
        });
    });
});

window.openStatusModal = function(userId) {
    console.log('Opening status modal for user:', userId);
    openModal(`statusModal-${userId}`);
}

function showNotification(message, type = 'success') {
    console.log('Showing notification:', message, type);
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } transition-all transform translate-x-full`;
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>