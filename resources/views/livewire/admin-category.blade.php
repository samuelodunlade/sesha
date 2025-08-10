
<div class="row py-5 bg-white">
        <div class="col-md-10 offset-md-1 bg-white">
                <h1 class="mb-4 text-secondary">Category Manager</h1>

                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                
                

                <!-- Form -->
            <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">{{ $editMode ? 'Edit Category' : 'Add New Category' }}</h2>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $editMode ? 'updateCategory' : 'saveCategory' }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title*</label>
                                    <input 
                                        type="text" 
                                        id="title" 
                                        wire:model="title" 
                                        class="form-control"
                                    >
                                    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="cover_image" class="form-label">
                                        {{ $editMode ? 'New Image (leave empty to keep current)' : 'Image*' }}
                                    </label>
                                    <input 
                                        type="file" 
                                        id="cover_image" 
                                        wire:model="cover_image" 
                                        class="form-control"
                                    >
                                    @error('cover_image') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea 
                                        id="description" 
                                        wire:model="description" 
                                        rows="3" 
                                        class="form-control"
                                    ></textarea>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input 
                                            type="checkbox" 
                                            wire:model="status" 
                                            id="status" 
                                            class="form-check-input"
                                            role="switch"
                                        >
                                        <label for="status" class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 d-flex justify-content-end gap-2">
                                @if($editMode)
                                    <button 
                                        type="button" 
                                        wire:click="resetForm" 
                                        class="btn btn-outline-secondary"
                                    >
                                        Cancel
                                    </button>
                                @endif
                                
                                <button 
                                    type="submit" 
                                    class="btn btn-primary bg-primary"
                                >
                                    <i class="bi bi-save me-1"></i>
                                    {{ $editMode ? 'Update' : 'Save' }} Category
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
            <hr class="my-5">
            <!-- Search -->
            <div class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        wire:model.debounce.500ms="search" 
                        placeholder="Search categories..."
                        wire:keyup.debounce.500ms="loadCategories"
                        class="form-control"
                    >
                    <span class="input-group-text" wire:click='loadCategories' style="cursor: pointer">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            </div>

             <!-- Categories Table -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Categories List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            @if($category->cover_image)
                                                <img src="{{ asset('storage/'.$category->cover_image) }}" 
                                                    alt="{{ $category->title }}" 
                                                    class="img-thumbnail" 
                                                    style="width: 60px; height: 60px; object-fit: cover">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                    style="width: 60px; height: 60px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                {{ $category->description }}
                                            </div>
                                        </td>
                                        <td>
                                            <button 
                                                wire:click="toggleStatus({{ $category->id }})" 
                                                class="btn btn-sm {{ $category->status=="active" ? 'btn-success' : 'btn-danger' }}"
                                            >
                                                {{ $category->status=="active" ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button 
                                                    wire:click="edit({{ $category->id }})" 
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Edit"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button 
                                                    wire:click="deleteCategory({{ $category->id }})" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
            
        </div>
</div> 


