<!-- resources/views/livewire/secret-tag-manager.blade.php -->
<div class="secret-tags-container mb-4">
    <label class="form-label">Tags</label>
    
    <!-- Current Tags Display -->
    <div class="d-flex flex-wrap gap-2 mb-3" wire:ignore>
        @foreach($selectedTags as $id => $name)
            <span class="badge bg-primary d-flex align-items-center py-2 pe-1">
                {{ $name }}
                <button 
                    wire:click="removeTag({{ $id }})" 
                    class="btn-close btn-close-white ms-2"
                    style="font-size: 0.5rem;"
                    aria-label="Remove tag"
                ></button>
            </span>
        @endforeach
    </div>
    
    <!-- Tag Input with Suggestions -->
    <div class="position-relative">
        <div class="input-group">
            <input
                type="text"
                wire:model="tagInput"
                wire:keydown.enter.prevent="addNewTag"
                wire:keydown.arrow-up.prevent="highlightPrevious"
                wire:keydown.arrow-down.prevent="highlightNext"
                wire:keydown.escape="$set('suggestions', [])"
                placeholder="Type to add tags..."
                class="form-control @error('tagInput') is-invalid @enderror"
                aria-label="Add tags"
                wire:loading.attr="disabled"
                wire:target="addNewTag,selectTag"
            >
            <button 
                wire:click="addNewTag"
                class="btn btn-outline-secondary"
                type="button"
                wire:loading.attr="disabled"
                wire:target="addNewTag"
            >
                <span wire:loading.remove wire:target="addNewTag">Add</span>
                <span wire:loading wire:target="addNewTag" class="spinner-border spinner-border-sm"></span>
            </button>
        </div>
        
        <!-- Suggestions Dropdown -->
        @if(count($suggestions) > 0)
            <div class="list-group position-absolute w-100 mt-1 shadow" style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                @foreach($suggestions as $id => $name)
                    <button
                        type="button"
                        wire:click="selectTag({{ $id }}, '{{ $name }}')"
                        class="list-group-item list-group-item-action text-start {{ $highlightIndex === $loop->index ? 'active' : '' }}"
                    >
                        {{ $name }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Error Message -->
    @error('tagInput')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
    
    <!-- Help Text -->
    <small class="form-text text-muted">
        Type to search existing tags or create new ones. Press Enter to add.
    </small>
</div>

