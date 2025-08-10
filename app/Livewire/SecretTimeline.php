<?php

namespace App\Livewire;
use App\Models\Secret;
use App\Models\Category;
use App\Models\Vote;
use App\Models\View;

use Livewire\Component;

class SecretTimeline extends Component
{

    public $search = '';
    public $categoryFilter;
    public $categories;
    public $searchTerm = '';
    public $selectedCategory = '';
    

    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'selectedCategory' => ['except' => '']
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    // public function render()
    // {
    //     $secrets = Secret::with('category', 'votes', 'views')
    //     ->when($this->search, function($query) {
    //         $query->where('content', 'like', '%'.$this->search.'%');
    //     })
    //     ->when($this->categoryFilter, function($query) {
    //         $query->where('category_id', $this->categoryFilter);
    //     })
    //     ->orderByRaw('
    //         (upvotes - downvotes) DESC, 
    //         views DESC, 
    //         created_at DESC
    //     ')
    //     ->get()
    //     ->groupBy('ip_address') // Group by creator IP
    //     ->flatMap(function ($secretsByUser) {
    //         // Only take 2 most popular secrets per user
    //         return $secretsByUser
    //             ->sortByDesc(function ($secret) {
    //                 return $secret->upvotes - $secret->downvotes;
    //             })
    //             ->take(2);
    //     })
    //     ->sortByDesc(function ($secret) {
    //         // Final sorting by engagement score
    //         return $this->calculateEngagementScore($secret);
    //     })
    //     ->values()->all();
    //     $this->secrets = $secrets;
    //     return view('livewire.secret-timeline', compact('secrets'));
    // }

    
    public function render()
    {
        $query = Secret::query()
        ->with(['category', 'votes', 'views'])
        ->when($this->searchTerm, function ($query) {
            $query->where(function($q) {
                $q->where('title', 'like', '%'.$this->searchTerm.'%')
                  ->orWhere('content', 'like', '%'.$this->searchTerm.'%');
            });
        })
        ->where(function($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
        })
        ->where('is_blocked', false)
        ->when($this->selectedCategory, function ($query) {
            $query->where('category_id', $this->selectedCategory);
        });

    // Get all IDs sorted by engagement score
    $sortedIds = $query->get()
        ->sortByDesc(function ($secret) {
            return $this->calculateEngagementScore($secret);
        })
        ->pluck('id')
        ->toArray();

        // Now get paginated results in the correct order
        $secrets = Secret::whereIn('id', $sortedIds)
        ->with(['category', 'votes', 'views'])
        ->orderByRaw('FIELD(id, '.implode(',', $sortedIds).')');
        //if $secrets is empty, return an empty collection
        if ($secrets->count() === 0) {
            $secrets = collect();
        } else {
            $secrets = $secrets->paginate(10); // Use paginate instead of simplePaginate for better control
        }


        // ->simplePaginate(10);

        
            return view('livewire.secret-timeline', [
            'secrets' => $secrets,
            'categories' => $this->categories
        ]);
    }

    protected function calculateEngagementScore($secret)
    {
        // give editor's choice a higher 
        $editorsChoiceScore = $secret->is_editors_choice ? 10 : 0;
        // Weighted score calculation
        $voteScore = ($secret->upvotes - $secret->downvotes) * 2;
        $viewScore = $secret->views * 0.5;
        $recencyScore = 0;
        //recency calc based on when
        $timeSinceCreated = now()->diffInHours($secret->created_at);
        if ($timeSinceCreated < 24) {
            $recencyScore = 10;
        } elseif ($timeSinceCreated < 48) {
            $recencyScore = 5;
        } elseif ($timeSinceCreated < 72) {
            $recencyScore = 3;
        } elseif ($timeSinceCreated < 168) { // 7 days
            $recencyScore = 2;
        } else {
            $recencyScore = 0;
        }


        
        // Diversity factor - reduce score if same IP has many posts
        $ipPostsCount = Secret::where('ip_address', $secret->ip_address)
            ->where('created_at', '>', now()->subDay())
            ->count();
        
        $diversityFactor = max(0.5, 3 - $ipPostsCount); // More aggressive reduction

        return ($voteScore + $viewScore + $recencyScore + $editorsChoiceScore) * $diversityFactor;
    }

    public function resetFilters()
    {
        $this->reset(['searchTerm', 'selectedCategory']);
    }


}
