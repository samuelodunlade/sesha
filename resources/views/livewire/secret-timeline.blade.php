<div class="col-md-8">
    <div class="mb-4">
        <form wire:submit.prevent>
            <div class="p-3" style="background-color: #fff;box-shadow: 0 8px 10px rgba(2, 8, 34, 0.3), 0 16px 40px rgba(2, 8, 34, 0.25); border-radius: 8px; display: flex; align-items: center;">
            
            <input type="text" class="form-control me-2" placeholder="Search..." wire:model.lazy="searchTerm" placeholder="Search by title or content">
            
            <select class="form-select me-2" style="max-width: 200px;" wire:model="selectedCategory">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
            </select>
            
            <button class="btn btn-primary me-2" wire:click="$refresh">Search</button>
            <button class="btn btn-danger"  wire:click="resetFilters">Reset</button>
            </div>
        </form>
    </div>
    <!-- all shi -->
    <div wire:loading.delay class="fixed top-0 left-0 right-0 bg-blue-500 text-white py-2 text-center">
        Loading results...
    </div>
    @if($secrets->count())
        @foreach ($secrets as $secret)
        {{-- Replace this with a component --}}
        <x-single-secret :secret="$secret" />

        @endforeach
        <!-- Pagination -->
        <div class="mt-4">
            {{ $secrets->links() }}
        </div>
    @else
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6 text-center">
                <p class="text-gray-500">No secrets found matching your search criteria.</p>
                <button class="btn btn-danger"  wire:click="resetFilters">Clear Search</button>
            </div>
        </div>
    @endif
   

    
</div>
