@extends('layouts.app')
@section('title', 'RPL-Echosystem - profile')

@section('c_css')
    <script src="{{ asset('/assets/vendor/ckeditor/build/ckeditor.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-md-offset-2">
                <div class="mainheading">
                    <div class="row post-top-meta authorpage">
                        <div class="col-md-10 col-xs-12">
                            <h1>{{ $user->fullname }}</h1>
                            <span style="width: 100%;" class="author-description"
                                id="{{ $user->id == Auth::user()->id ? 'editor' : '' }}">{!! $user->biodata !!}</span>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <img class="author-thumb" src="{{ $user->avatar }}" alt="{{ $user->fullname }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="graybg authorpage">
        <div class="container">
            <div class="listrecent listrelated">

                @foreach ($user->posts as $post)
                    <div class="authorpostbox">
                        <div class="card">
                            @php
                                $thumbnail = $post->thumbnail == 'thumbPost.png' ? asset('/assets/img/demopic/thumbPost.png') : $post->thumbnail;
                            @endphp
                            <a
                                href="{{ route('blog.post.detail', ['post' => base64_encode($post->id), Str::slug(strip_tags($post->title))]) }}">
                                <img style="height: 200px" class="img-fluid img-thumb" src="{{ $thumbnail }}" alt="">
                            </a>
                            <div class="card-block">
                                <h2 class="card-title">
                                    @if (Auth::user()->id == $post->user->id)
                                        <span
                                            class="badge badge-{{ $post->status == 'draft' ? 'danger' : 'success' }} badge-sm">
                                            {{ Str::title($post->status) }}
                                        </span>
                                    @endif
                                    <a
                                        href="{{ route('blog.post.detail', ['post' => base64_encode($post->id), Str::slug(strip_tags($post->title))]) }}">{!! $post->title !!}</a>
                                </h2>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="meta-footer-thumb">
                                            <a href="{{ route('blog.profile', ['username' => $post->user->username]) }}"><img
                                                    class="author-thumb" src="{{ $post->user->avatar }}"
                                                    alt="{{ $post->user->username }}"></a>
                                        </span>
                                        <span class="author-meta">
                                            <span class="post-name"><a
                                                    href="{{ route('blog.profile', ['username' => $post->user->username]) }}">{{ $post->user->username }}</a></span><br />
                                            <span
                                                class="post-date">{{ date('d-m-Y', strtotime($post->created_at)) }}</span>
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
@endsection

@section('c_js')
    @include('_partials.c_js.ajaxPromise')
    <script>
        async function posBiodata(editor) {
            try {
                var content = "";
                editor.children().each(function() {
                    content += $(this).prop('outerHTML');
                });
                var data = {
                    _token: "{{ csrf_token() }}",
                    userID: "{{ Auth::user()->id }}",
                    biodata: content
                }
                const response = await HitData("{{ route('blog.profile.bio') }}", data, 'POST')
                Snackbar.show({
                    text: response.message
                })
            } catch (error) {
                Snackbar.show({
                    text: "Error " + error
                })
            }
        }

        function saveData(data) {
            return new Promise(resolve => {
                setTimeout(() => {
                    posBiodata($('#editor'))

                    resolve();
                }, 1000);
            });
        }


        InlineEditor.create(document.querySelector("#editor"), {
                extraPlugins: ['Autosave'],
                autosave: {
                    save(editor) {
                        return saveData(editor.getData());
                    }
                },

            }).then((editor) => {

            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endsection
