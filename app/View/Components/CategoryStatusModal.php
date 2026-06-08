<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CategoryStatusModal extends Component
{
    public function __construct(
        public string $categoryId = '',
        public string $currentStatus = '',
    ) {}

    public function render(): View
    {
        $statuses = [
            'active' => ['label' => 'Active', 'color' => 'green', 'description' => 'Category is visible and books can be assigned'],
            'inactive' => ['label' => 'Inactive', 'color' => 'gray', 'description' => 'Category is hidden from public view'],
        ];

        return view('components.category-status-modal', [
            'statuses' => $statuses,
        ]);
    }
}