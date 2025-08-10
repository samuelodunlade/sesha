<?php

namespace App\Livewire;

use App\Models\Secret;
use App\Models\Vote;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class SecretVoting extends Component
{
    public $secret;
    public $userVote = null;

    protected $listeners = ['refreshVotes' => '$refresh'];


    public function mount($secret)
    {
        $this->secret = $secret;
        $this->checkUserVote();
    }

    public function checkUserVote()
    {
        $vote = Vote::where('secret_id', $this->secret->id)
            ->where('ip_address', request()->ip())
            ->first();
            
        $this->userVote = $vote ? $vote->type : null;
    }

    public function vote($type)
    {
        $key = 'votes.'.request()->ip();
        $maxAttempts = 2;
        /*
             //fix rate limiter
        */
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $this->dispatch('notify', message: 'You have reached your daily voting limit.');
            return;
        }
        
        // Check if user already voted the same way
        if ($this->userVote === $type) {
            return;
        }
        
        // Remove opposite vote if exists
        if ($this->userVote && $this->userVote !== $type) {
            Vote::where('secret_id', $this->secret->id)
                ->where('ip_address', request()->ip())
                ->delete();
                
            // Adjust counts
            if ($type === 'upvote') {
                $this->secret->decrement('downvotes');
            } else {
                $this->secret->decrement('upvotes');
            }
        }
        
        // Add new vote
        Vote::create([
            'secret_id' => $this->secret->id,
            'ip_address' => request()->ip(),
            'type' => $type,
        ]);
        
        // Update counts
        if ($type === 'upvote') {
            $this->secret->increment('upvotes');
        } else {
            $this->secret->increment('downvotes');
        }
        
        RateLimiter::hit($key, config('secret-sharing.rate_limits.votes.decay_minutes') * 60);
        
        // Refresh data
        $this->secret->refresh();
        $this->checkUserVote();
        $this->dispatch('refreshVotes');
    }
    
    
    public function render() 
    {
        return view('livewire.secret-voting');
    }
}
