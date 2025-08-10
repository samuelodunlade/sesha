<div class="card">
    <div class="card-header bg-primary text-white">
        <h2 class="h5 mb-0">You can manage Secrets Here</h2>
    </div>
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-8">
                        <input 
                            type="text" 
                            wire:model="search" 
                            placeholder="Search by title or content..." 
                            class="form-control"
                        >
                    </div>
    
                    <!-- Category Filter -->
                    <div class="col-md-4">
                        <select wire:model="categoryId" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Status Filters -->
                    <div class="col-6 col-sm-4">
                        <select wire:model="isBlocked" class="form-select">
                            <option value="">All Status</option>
                            <option value="1">Blocked Only</option>
                            <option value="0">Active Only</option>
                        </select>
                    </div>
    
                    <div class="col-6 col-sm-4">
                        <select wire:model="isEditorChoice" class="form-select">
                            <option value="">All</option>
                            <option value="1">Editor's Choice</option>
                            <option value="0">Not Editor's Choice</option>
                        </select>
                    </div>
                    <!-- Group By IP -->
                    <div class="col-6 col-sm-4">
                        <div class="form-check form-switch">
                            <input 
                                wire:model="groupByIp" 
                                class="form-check-input" 
                                type="checkbox" 
                                id="groupByIp"
                            >
                            <label class="form-check-label" for="groupByIp">Group by IP</label>
                        </div>
                    </div>
                    {{-- submit button  --}}
                    <div class="col-md-6 d-flex gap-2">
                        <button 
                            wire:click="applyFilters"
                            wire:loading.attr="disabled"
                            class="btn btn-outline-secondary flex-grow-1"
                        >
                            <span wire:loading.remove>
                                <i class="fas fa-search mr-1"></i> Search
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin mr-1"></i> 
                            </span>
                        </button>
                        <button 
                            wire:click="clearFilters"
                            wire:loading.attr="disabled"
                            class="btn btn-outline-secondary"
                            title="Clear all filters"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    @if($filtersApplied)
                        <div class="mt-3 text-muted small">
                            Filters applied. <a href="#" wire:click="clearFilters" class="text-primary">Clear all</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th wire:click="sortBy('title')" style="cursor: pointer;">
                            @if($sortField === 'title') @include('partials.sort-icon') @endif
                            Title
                        </th>
                        <th wire:click="sortBy('category_id')" style="cursor: pointer;">
                            @if($sortField === 'category_id') @include('partials.sort-icon') @endif
                            Category 
                        </th>
                        <th wire:click="sortBy('ip_address')" style="cursor: pointer;">
                            
                            @if($sortField === 'ip_address') @include('partials.sort-icon') @endif
                            IP Address 
                        </th>
                        <th wire:click="sortBy('upvotes')" style="cursor: pointer;">
                            
                            @if($sortField === 'upvotes') @include('partials.sort-icon') @endif
                            <i class="fa fa-thumbs-up" title="upvotes"></i> 
                        </th>
                        <th wire:click="sortBy('downvotes')" style="cursor: pointer;">
                            
                            @if($sortField === 'downvotes') @include('partials.sort-icon') @endif
                            {{-- thumbsdown icon --}}
                            <i class="fa fa-thumbs-down" title="downvotes"></i>
                        </th>
                        <th wire:click="sortBy('views')" style="cursor: pointer;">
                            
                            @if($sortField === 'views') @include('partials.sort-icon') @endif
                            <i class="fa fa-eye" title="views"></i>
                        </th>
                        <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                            
                            @if($sortField === 'created_at') @include('partials.sort-icon') @endif
                            Date  Created   
                        </th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($groupByIp)
                        @foreach($secrets as $ipGroup)
                            <tr>
                                <td colspan="6">
                                    <strong>IP: {{ $ipGroup->ip_address }}</strong> 
                                    ({{ $ipGroup->secret_count }} secrets)
                                </td>
                                <td colspan="3">
                                    <button 
                                        wire:click="$set('groupByIp', false)"
                                        class="btn btn-sm btn-outline-secondary"
                                    >
                                        View Secrets
                                    </button>
                                </td>
                    
                            </tr>
                        @endforeach
                    @else
                        @foreach($secrets as $secret)
                            <tr>
                                <td width="500">{{ Str::limit($secret->title, 30) }}</td>
                                <td>{{ $secret->category->title }}</td>
                                <td>{{ $secret->ip_address }}</td>
                                <td>{{ $secret->upvotes }}</td>
                                <td>{{ $secret->downvotes }}</td>
                                <td>{{ $secret->views }}</td>
                                <td>
                                    {{ $secret->created_at->format('M d, Y') }}
                                    @if($secret->expires_at && $secret->expires_at->isPast())
                                        <span class="badge bg-danger">Expired</span>
                                    @elseif($secret->expires_at)
                                        <span class="badge bg-warning text-dark">
                                            Expires: {{ $secret->expires_at->diffForHumans() }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($secret->is_blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                    
                                    @if($secret->is_editor_choice)
                                        <span class="badge bg-primary mt-1"> Choice</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($secret->is_blocked)
                                            <button 
                                                wire:click="unblockSecret({{ $secret->id }})"
                                                class="btn btn-sm btn-success"
                                                title="Unblock"
                                            >
                                            <i class="fas fa-ban text-white"></i>
                                            </button>
                                        @else
                                            <button 
                                                wire:click="blockSecret({{ $secret->id }})"
                                                class="btn btn-sm btn-warning"
                                                title="Block"
                                            >
                                            <i class="fas fa-eye-slash"></i>
                                            </button>
                                        @endif
                                        
                                        <button 
                                            wire:click="expireSecret({{ $secret->id }})"
                                            class="btn btn-sm btn-info"
                                            title="Expire Now"
                                        >
                                            <i class="bi bi-clock-history"></i>
                                        </button>
                                        
                                        <button 
                                            wire:click="toggleEditorChoice({{ $secret->id }})"
                                            class="btn btn-sm {{ $secret->is_editor_choice ? 'btn-primary' : 'btn-outline-primary' }}"
                                            title="{{ $secret->is_editor_choice ? 'Remove from Editor\'s Choice' : 'Mark as Editor\'s Choice' }}"
                                        >
                                            <i class="bi bi-star"></i>
                                        </button>
                                        
                                        <button 
                                            wire:click="deleteSecret({{ $secret->id }})"
                                            class="btn btn-sm btn-danger"
                                            title="Delete"
                                            onclick="return confirm('Are you sure?')"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <a href="secrets/{{ $secret->id }}/show" class="btn btn-sm btn-secondary" title="View Secret">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $secrets->links() }}
        </div>
    </div>
</div>
