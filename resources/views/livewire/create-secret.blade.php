<div>
    @session("message")
        <x-message type="success" :message="session('message')"/>
    @endsession
    <form method="post" class="shi-form" wire:submit='save'>
        <div class="row mb-3">
            <label for="title" class="col-sm-3 col-form-label">Shi Title</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="title" placeholder="give your shi a title: how i danced in the bathroom" name="title" wire:model='title'>
            @error("title")
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>
        <input type="number" name="random_title" value="" style="display: none">
        <div>

        </div>

        <div class="row mb-3">
            <label for="summary" class="col-sm-3 col-form-label">Shi Summary</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="summary" placeholder="Summarize the whole shi in a sentence" name="summary"  wire:model='summary'>
            @error("summary")
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="category" class="col-sm-3 col-form-label">Shi Category</label>
            <div class="col-sm-9">
                <select class="form-select" id="category" name="category"  wire:model='category'>
                    <option value="">Select Best Category for your Shi</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                @error("category")
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="content" class="col-sm-3 col-form-label">Shi Content</label>
            <div class="col-sm-9">
                <textarea name="content" id="content" class="form-control" rows="6" 
                placeholder="
                It all began one morning while I was taking bath...."  wire:model='content'></textarea>
                @error("content")
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
            @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="Lifecycle" class="col-sm-3 col-form-label">Shi Lifecycle</label>
            <div class="col-sm-9">
                <select class="form-select border-0" id="Lifecycle" name="lifecycle"  wire:model='lifecycle'>
                    <option selected>How long should your shi be available</option>
                    @foreach($expirationOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error("lifecycle")
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="row float-end px-2">
            <button class="btn btn-primary pry-bg btn-lg">Post Shi Now</button>
        </div>
    </form>
</div>
