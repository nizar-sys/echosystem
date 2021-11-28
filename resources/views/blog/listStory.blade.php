@extends('layouts.app')

@section('title', 'My-echosystem - Your stories')
@section('content')
    <section class="featured-posts">
        <div class="section-title">
            <a href="/new-story" class="btn btn-outline-success float-right">New story</a>
            <h2><span>Your stories</span></h2>
        </div>
        <div class="card-columns listfeaturedtag">
            @foreach ($story as $story)
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 wrapthumbnail">
                            <a href="post.html">
                                <div class="thumbnail"
                                    style="background-image:url({{ asset('/') }}assets/img/demopic/1.jpg);">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="card-block">
                                <h2 class="card-title">
                                </h2>
                                {{-- <h4 class="card-text">{!! substr($story->content, 0, 100) !!}</h4> --}}
                                <h4 class="card-text"><a
                                        style="color: #000"
                                        href="{{ route('blog.post.edit', ['id' => $story->id]) }}">{!! substr($story->content, 0, 100) . '...' !!}</a>
                                </h4>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="meta-footer-thumb">
                                            <a href="author.html"><img class="author-thumb"
                                                    src="{{ $story->user->avatar }}"
                                                    alt="{{ $story->user->fullname }}"></a>
                                        </span>
                                        <span class="author-meta">
                                            <span class="post-name"><a
                                                    href="author.html">{{ $story->user->username }}</a></span><br />
                                            <span
                                                class="post-date">{{ date('d-m-Y', strtotime($story->created_at)) }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
