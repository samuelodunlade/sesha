<div class="row">
    <div class="col">
        <div class="shi-box">
            <div class="shi-main">
                <h3>{{$secret->title}}</h3>
                
                <div class="tag-container">
                    <span> <strong>      Admin Tag:</strong> </span>
                    @forelse ($secret->tags as $tag )
                        
                            <span class="badge bg-primary py-2 mytag">
                                <a href="/secrets/tag/{{ $tag->slug }}" class="text-decoration-none">
                                {{ $tag->name }}
                                </a>
                            </span>
                        
                    @empty
                        <span class="badge bg-primary py-2">
                            Untagged
                        </span>
                    @endforelse
                </div>
               

                <p> {{ $secret->summary }} </p>
                
                <hr>
                <a href="/secrets/{{ $secret->slug }}" class="btn btn-primary"> <i class="fa-solid fa-eye"></i> Detail Shi</a>


            </div>
            <div class="shi-stat">
                <p class="text-muted">
                    <i class="fa-solid fa-eye"></i>
                    <span>{{ $secret->views }}</span>
                </p>
                <p class="text-muted">
                    <i class="fa-solid fa-thumbs-up"></i>
                    <span> {{ $secret->upvotes }} </span>
                </p>

                <p class="text-muted">
                    <i class="fa-solid fa-thumbs-down"></i>
                    <span>{{ $secret->downvotes }}</span>
                </p>
                <p class="text-muted">
                    <i class="fa-solid fa-clock"></i>
                   <span class="small"> {{ $secret->created_at->diffForHumans() }} </span>
                </p>

            </div>
        </div>
    </div>
</div>