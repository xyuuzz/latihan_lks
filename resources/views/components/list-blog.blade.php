<div id="list-blog">
    @foreach($blogs as $blog)
        <div class="card-blog card mr-lg-5 mb-3">
            <div class="card-header">
                {{Str::title($blog->title)}}
            </div>
            <div class="card-body">
                <div>
                    {{Str::limit($blog->body, 150, ".")}}
                </div>
                <a href="/blog/{{$blog->id}}">Read More..</a>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{$blogs->links()}}
    </div>
</div>
