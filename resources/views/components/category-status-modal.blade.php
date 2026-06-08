<x-modal id="statusModal-{{ $categoryId }}" 
         title="Change Category Status" 
         size="md">
    
    <form action="{{ route('admin.categories.update-status', $categoryId) }}" 
          method="POST" 
          id="statusForm-{{ $categoryId }}">
        @csrf
        @method('PATCH')
        
        <div class="space-y-4">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Change the status for this category.
            </p>
            
            <div class="space-y-3">
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
        
        <x-slot name="footer">
            <button type="button" 
                    onclick="closeModal('statusModal-{{ $categoryId }}')"
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
window.openStatusModal = function(categoryId) {
    openModal(`statusModal-${categoryId}`);
}
</script>