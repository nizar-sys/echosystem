@extends('layouts.app')

@section('title', 'My-echosystem | Home')
@section('content')
    <section class="recent-posts">
        <div class="section-title">
            <h2><span>All Stories</span></h2>
        </div>
        <div class="card-columns listrecent">
            @foreach ($story as $story)
                <div class="card">
                    @php
                        $thumbnail = $story->thumbnail == 'thumbPost.png' ? asset('/assets/img/demopic/thumbPost.png') : $story->thumbnail;
                    @endphp
                    <a
                        href="{{ route('blog.post.detail', ['post' => base64_encode($story->id), Str::slug(strip_tags($story->title))]) }}">
                        <img class="img-fluid" src="{{ $thumbnail }}" alt="">
                    </a>
                    <div class="card-block">
                        <h2 class="card-title"><a
                                href="{{ route('blog.post.detail', ['post' => base64_encode($story->id), Str::slug(strip_tags($story->title))]) }}">{!! $story->title !!}</a>
                        </h2>
                        <div class="metafooter">
                            <div class="wrapfooter">
                                <span class="meta-footer-thumb">
                                    <a href="author.html"><img class="author-thumb" src="{{ $story->user->avatar }}"
                                            alt="{{ $story->user->fullname }}"></a>
                                </span>
                                <span class="author-meta">
                                    <span class="post-name"><a
                                            href="author.html">{{ $story->user->fullname }}</a></span><br />
                                    <span class="post-date">{{ date('d-m-Y', strtotime($story->created_at)) }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- End List Posts
                    ================================================== -->
@endsection
