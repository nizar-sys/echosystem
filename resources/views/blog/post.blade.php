@extends('layouts.app')
@section('title', strip_tags($data['story']->title))
@section('c_css')
    <script src="{{ asset('/assets/vendor/ckeditor/build/ckeditor.js') }}"></script>
@endsection
@section('content')
    <!-- Begin Article
                                ================================================== -->
    <div class="container">
        <div class="row">

            <!-- Begin Fixed Left Share -->
            <div class="col-md-2 col-xs-12">
                <div class="share">
                    <p>
                        Share
                    </p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/intent/tweet?text={{ url()->full() }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://api.whatsapp.com/send?text={{ url()->full() }}"
                                data-action="share/whatsapp/share">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Fixed Left Share -->

            <!-- Begin Post -->
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <div class="mainheading">

                    <!-- Begin Top Meta -->
                    <div class="row post-top-meta">
                        <div class="col-md-2">
                            <a href="author.html"><img class="author-thumb" src="{{ $data['story']->user->avatar }}"
                                    alt="{{ $data['story']->user->fullname }}"></a>
                        </div>
                        <div class="col-md-10">
                            <a class="link-dark" href="author.html">{{ $data['story']->user->fullname }}</a><a
                                href="#" class="btn follow">Follow</a>
                            <span class="author-description">Founder of WowThemes.net and creator of <b>"Mediumish"</b>
                                theme that you're currently previewing. Developing professional premium themes, templates,
                                plugins, scripts since 2012.</span>
                            <span class="post-date">{{ date('d-m-Y', strtotime($data['story']->created_at)) }}</span>
                        </div>
                    </div>

                </div>

                <!-- Begin Post Content -->
                <div class="article-post">
                    {!! $data['story']->content !!}
                </div>
                <!-- End Post Content -->

                <!-- Begin Tags -->
                <div class="after-post-tags">
                    <ul class="tags">
                        @php
                            $tags = $data['story']->tags;
                            $tags = explode(',', $tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li><a href="#">{{Str::title($tag)}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- End Tags -->
            </div>
            <!-- End Post -->
        </div>
    </div>
    <!-- End Article
                                ================================================== -->

    <div class="hideshare"></div>

    <!-- Begin Related
                                ================================================== -->
    <div class="graybg">
        <div class="container">
            <div class="row listrecent listrelated">
                @foreach ($data['stories'] as $story)
                    <div class="col-md-4">
                        <div class="card">
                            @php
                                $thumbnail = $story->thumbnail == 'thumbPost.png' ? asset('/assets/img/demopic/thumbPost.png') : $story->thumbnail;
                            @endphp
                            <a
                                href="{{ route('blog.post.detail', ['post' => base64_encode($story->id), Str::slug(strip_tags($story->title))]) }}">
                                <img class="img-fluid img-thumb" src="{{ $thumbnail }}"
                                    alt="{{ strip_tags($story->title) }}">
                            </a>
                            <div class="card-block">
                                <h2 class="card-title"><a
                                        href="{{ route('blog.post.detail', ['post' => base64_encode($story->id), Str::slug(strip_tags($story->title))]) }}">{!! $story->title !!}</a>
                                </h2>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="meta-footer-thumb">
                                            <a href="author.html"><img class="author-thumb"
                                                    src="{{ $story->user->avatar }}"
                                                    alt="{{ $story->user->fullname }}"></a>
                                        </span>
                                        <span class="author-meta">
                                            <span class="post-name"><a
                                                    href="author.html">{{ $story->user->fullname }}</a></span><br />
                                            <span
                                                class="post-date">{{ date('d-m-Y', strtotime($story->created_at)) }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Related Posts
                                ================================================== -->
@endsection

@section('c_js')
    <script>
        InlineEditor
            .create(document.querySelector('.article-post'), {})
            .then(editor => {
                const toolbarElement = editor.ui.view.toolbar.element;
                editor.isReadOnly = true;
                toolbarElement.style.display = 'none';
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
