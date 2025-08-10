
<div>
    <div 
        x-data="{ showMessage: false, message: '' }"
        x-on:notify.window="showMessage = true; message = $event.detail.message; setTimeout(() => showMessage = false, 3000)"
        x-show="showMessage"
        class="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded"
    >
        <span x-text="message"></span>
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">

        <button type="button" wire:click="vote('upvote')" class="btn btn-primary {{ $userVote === 'upvote' ? 'btn-success' : 'btn-muted' }}">  
            <i class="fa-solid fa-thumbs-up"></i>
            <span class="badge badge-primary"> {{ $secret->upvotes }} </span>
        </button>
        <button type="button" wire:click="vote('downvote')" class="btn btn-primary {{ $userVote === 'downvote' ? 'btn-danger' : 'btn-muted' }}">  
            <i class="fa-solid fa-thumbs-down"></i>
            <span class="badge badge-primary"> {{ $secret->downvotes }} </span>
        </button>
        
        <button type="button" class="btn btn-primary" disabled>  
            <i class="fa-solid fa-eye"></i>
            <span class="badge badge-primary"> {{ $secret->views }} </span>
        </button>

    </div>
</div>


