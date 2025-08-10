<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Secret;
use App\Models\Category;

class AdminManageSecret extends Component
{
    use WithPagination;
    public $search = '';
    public $categoryId = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $isBlocked = '';
    public $isEditorChoice = '';
    public $groupByIp = false;
    public $filtersApplied = false;


    public $categories;
    public $ipAddresses = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'isBlocked' => ['except' => ''],
        'isEditorChoice' => ['except' => ''],
        'groupByIp' => ['except' => false],
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->ipAddresses = Secret::select('ip_address')
            ->distinct()
            ->orderBy('ip_address')
            ->pluck('ip_address');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function blockSecret($secretId)
    {
        Secret::find($secretId)->update(['is_blocked' => true]);
    }

    public function unblockSecret($secretId)
    {
       Secret::find($secretId)->update(['is_blocked' => 0]);
    }

    public function expireSecret($secretId)
    {
        Secret::find($secretId)->update(['expires_at' => now()]);
    }

    public function deleteSecret($secretId)
    {
        Secret::find($secretId)->delete();
    }

    public function toggleEditorChoice($secretId)
    {
        $secret = Secret::find($secretId);
        $secret->update(['is_editor_choice' => !$secret->is_editor_choice]);
    }

    public function render()
    {
        $secrets = Secret::query()
        ->with(['category', 'votes', 'views'])
        ->when($this->filtersApplied, function($query) {
            $query->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                      ->orWhere('content', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->categoryId, function ($query) {
                $query->where('category_id', $this->categoryId);
            })
            ->when($this->isBlocked !== '', function ($query) {
                $query->where('is_blocked', (bool)$this->isBlocked);
            })
            ->when($this->isEditorChoice !== '', function ($query) {
                $query->where('is_editor_choice', (bool)$this->isEditorChoice);
            });
        })
        ->when($this->groupByIp, function ($query) {
            $query->selectRaw('ip_address, COUNT(*) as secret_count')
                 ->groupBy('ip_address');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->simplePaginate(15);
        return view('livewire.admin-manage-secret', [
            'secrets' => $secrets,
            'categories' => $this->categories,
            'ipAddresses' => $this->ipAddresses
        ]);
    }

    public function applyFilters()
    {
        $this->filtersApplied = true;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'categoryId',
            'isBlocked',
            'isEditorChoice',
            'groupByIp'
        ]);
        $this->resetPage();
    }
}
