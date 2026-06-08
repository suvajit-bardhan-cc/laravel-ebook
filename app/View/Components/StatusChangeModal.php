<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusChangeModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $userId = '',
        public string $currentStatus = '',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $statuses = [
            'active' => ['label' => 'Active', 'color' => 'green'],
            'inactive' => ['label' => 'Inactive', 'color' => 'gray'],
            'banned' => ['label' => 'Banned', 'color' => 'red'],
            'pending' => ['label' => 'Pending', 'color' => 'yellow'],
        ];

        return view('components.status-change-modal', [
            'statuses' => $statuses,
        ]);
    }
}
