<?php

namespace App\Livewire;

use App\Models\Secret;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class SecretTagManager extends Component
{
   public Secret $secret;
    public $tagInput = '';
    public $suggestions = [];
    public $selectedTags = [];
    public $highlightIndex = -1;

    public function mount(Secret $secret)
    {
        $this->secret = $secret;
        $this->selectedTags = $secret->tags->pluck('name', 'id')->toArray();
    }

    public function updatedTagInput($value)
    {
        $this->highlightIndex = -1;
        
        if (strlen($value) >= 2) {
            $this->suggestions = Tag::where('name', 'like', '%'.$value.'%')
                ->whereNotIn('id', array_keys($this->selectedTags))
                ->limit(10)
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function highlightPrevious()
    {
        if ($this->highlightIndex > 0) {
            $this->highlightIndex--;
        }
    }

    public function highlightNext()
    {
        if ($this->highlightIndex < count($this->suggestions) - 1) {
            $this->highlightIndex++;
        }
    }

    public function selectHighlighted()
    {
        if ($this->highlightIndex >= 0 && isset(array_keys($this->suggestions)[$this->highlightIndex])) {
            $tagId = array_keys($this->suggestions)[$this->highlightIndex];
            $tagName = $this->suggestions[$tagId];
            $this->selectTag($tagId, $tagName);
        }
    }

    public function selectTag($tagId, $tagName)
    {
        if (array_key_exists($tagId, $this->selectedTags)) {
            return;
        }

        $this->secret->tags()->attach($tagId);
        $this->selectedTags[$tagId] = $tagName;
        $this->resetInput();
    }

    public function addNewTag()
    {
        $tagName = trim($this->tagInput);
        
        if (empty($tagName)) {
            return;
        }

        // Check if tag exists globally
        $existingTag = Tag::where('slug', Str::slug($tagName))->first();

        if ($existingTag) {
            $this->selectTag($existingTag->id, $existingTag->name);
            return;
        }

        // Create new tag
        $newTag = Tag::create([
            'name' => $tagName,
            'slug' => Str::slug($tagName)
        ]);

        // Attach to secret
        $this->selectTag($newTag->id, $newTag->name);
    }

    public function removeTag($tagId)
    {
        if (array_key_exists($tagId, $this->selectedTags)) {
            $this->secret->tags()->detach($tagId);
            unset($this->selectedTags[$tagId]);
        }
    }

    private function resetInput()
    {
        $this->tagInput = '';
        $this->suggestions = [];
        $this->highlightIndex = -1;
        // $this->dispatchBrowserEvent('tag-added');
    }

    

    public function render()
    {
        return view('livewire.secret-tag-manager');
    }
}


