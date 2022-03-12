@props([
    "blogs" => \App\Blog::getBlog()
])

<div id="list-blog">
    @forelse($blogs as $blog)
        <div class="d-flex justify-content-center">
            <div class="card mr-lg-5 mb-3 w-75">
                <img src="{{$blog->getThumbnail()}}" alt='{{"Thumbnail Blog {$blog->title}"}}' class="w-100 img-fluid">
                <div class="card-body">
                    <h5 class="font-weight-bold text-capitalize">{{$blog->title}}</h5>
                    <p class="text-secondary d-inline">{!! Str::limit($blog->body, 150, "...") !!}</p>
                    <a class="pl-md-2" href='{{"/blog/$blog->slug"}}'> Read more...</a>
                </div>
            </div>
        </div>
    @empty
        <h3 class="text-center">Anda Belum Membuat Blog</h3>
    @endforelse
    <div class="d-flex justify-content-center">
        {{$blogs->links()}}
    </div>
</div>
