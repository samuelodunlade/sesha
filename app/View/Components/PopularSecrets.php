<?php

namespace App\View\Components;
use App\Models\Secret;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularSecrets extends Component
{
    public $popularSecrets;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->popularSecrets= Secret::where('is_blocked', false)
         ->where(function($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
        })
            ->where('is_blocked', false)
            ->where('is_editor_choice', false)
            ->orderBy('upvotes', 'desc')
            ->orderBy('downvotes', 'asc')
            ->take(10)
            ->get();
        // dd($this->popularSecrets);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.popular-secrets');
    }
}
