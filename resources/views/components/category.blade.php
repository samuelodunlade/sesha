<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="shi-cat-box">
        <ul class="list-group">
            @foreach ($categories as $category)
                @if ($category->secret_count > 1 )
                    <li class="list-group-item d-flex justify-content-between align-items-center"> 
                        <a href="{{ route('shisha.bycategory', ['cat_name'=>$category->slug])}}"> {{ $category->title }}   </a>

                        <span class="badge bg-primary badge-pill float-right">
                            {{ count($category->activeSecrets) }} </span>
                    </li>
                @endif
                
                
            @endforeach
            

        </ul>
    </div>

</div>