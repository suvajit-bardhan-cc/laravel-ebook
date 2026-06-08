@props(['id' => 'modal', 'title' => 'Modal Title', 'size' => 'md', 'showClose' => true, 'closeOnOverlay' => true])

@php
    $sizeClasses = [
        'sm' => 'max-w-md',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        'full' => 'max-w-[90%]',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div id="{{ $id }}" 
     class="fixed inset-0 z-50 hidden overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity dark:bg-gray-900 dark:bg-opacity-90" 
         @if($closeOnOverlay) onclick="closeModal('{{ $id }}')" @endif></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 text-left shadow-xl transition-all sm:my-8 w-full {{ $sizeClass }}">
            
            <!-- Header -->
            <div class="px-6 pt-5 pb-4 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold leading-6 text-slate-900 dark:text-white" id="modal-title">
                        {{ $title }}
                    </h3>
                    @if($showClose)
                    <button type="button" onclick="closeModal('{{ $id }}')" 
                            class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-4">
                {{ $slot }}
            </div>

            <!-- Footer (optional) -->
            @if(isset($footer))
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-3">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
// Make functions global
window.openModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Add escape key listener
        document.addEventListener('keydown', function escapeHandler(e) {
            if (e.key === 'Escape') {
                closeModal(modalId);
                document.removeEventListener('keydown', escapeHandler);
            }
        });
    }
}

window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
}
</script>