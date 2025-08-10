<ul class="list-group">
    @foreach ($popularSecrets as $secret)
        <li class="list-group-item"> <a href="/secrets/{{ $secret->slug }}">{{ $secret->title }}</a> </li>
    @endforeach
</ul>