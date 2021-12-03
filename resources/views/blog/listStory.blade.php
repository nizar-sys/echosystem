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
                @php
                    $thumbnail = $story->thumbnail == 'thumbPost.png' ? asset('/assets/img/demopic/thumbPost.png') : $story->thumbnail;
                @endphp
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 wrapthumbnail">
                            <div class="thumbnail" style="background-image:url({{ $thumbnail }}); cursor: pointer;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-block">
                                <h2 class="card-title">
                                    <span
                                        class="badge badge-{{ $story->status == 'draft' ? 'danger' : 'success' }} badge-sm">
                                        {{ Str::title($story->status) }}
                                    </span>
                                    <a style="color: #000"
                                        href="{{ route('blog.post.edit', ['id' => Str::random(20) . base64_encode($story->id)]) }}">{!! $story->title !!}</a>
                                </h2>
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

@section('c_js')
    <script>
        function bacaGambar(input) {
            try {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#avaImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                    Swal.fire({
                        title: 'Lanjutkan pasang thumbnail?',
                        text: "Jadikan gambar sebagai thumbnail",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya!',
                        cancelButtonText: 'Batalkan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#form-upload').submit()
                        } else {
                            $('#avaImage').css('background-image',
                                `url('/assets/img/demopic/${$('#oldImage').val()}')`)
                        }
                    })
                }
            } catch (error) {

                Snackbar.show({
                    text: 'Error ' + error,
                    duration: 4000,
                });
                window.location.reload()
            }
        }

        $('input[name="image"]').change(function() {
            bacaGambar(this);
        });
    </script>
@endsection
