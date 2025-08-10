<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Secret;
use App\Models\Category as CategoryModel;
use Carbon\Carbon;
class Category extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
         // categories with at least five secrets
         $categories = CategoryModel::with('secrets')
         ->whereHas('secrets', function($query) {
             $query->where('is_blocked', false)
                ->where('status', 'active')
                 ->where(function($query) {
                     $query->whereNull('deleted_at')
                         ->orWhere('deleted_at', '>', Carbon::now());
                 });
         })
         ->take(10)
         ->get();
        return view('components.category', [
            'categories' => $categories
        ]);
    }
}
