@extends('layouts.app')
@section('title', 'My-echosystem - Edit your story')

@section('menu')
    @if ($story->status == 'draft')
        <li class="nav-item">
            <a class="nav-link btn btn-success btn-sm text-white"
                onclick="event.preventDefault(); publishStory('published')">Publish</a>
        </li>
    @elseif($story->status == 'published')
        <li class="nav-item">
            <a class="nav-link btn btn-danger btn-sm text-white"
                onclick="event.preventDefault(); publishStory('draft')">Save to draft</a>
        </li>
    @endif
@endsection
@section('c_css')
    <script src="{{ asset('/assets/vendor/ckeditor/build/ckeditor.js') }}"></script>
@endsection

@section('content')
    <input type="hidden" name="story_id" id="story_id" value="{{ $story->id }}">
    <div id="editor">
        {!! $story->content !!}
    </div>

@endsection
@section('c_js')
    @include('_partials.c_js.ckeditorFunc')
    @include('_partials.c_js.ajaxPromise')
    <script>
        async function postStory(editor) {
            try {
                var content = "";
                var title = editor.children().first().prop('outerHTML') == `<p><br data-cke-filler="true"></p>` ?
                    '<p>Untitle story</p>' : editor.children().first().prop('outerHTML');
                editor.children().each(function() {
                    content += $(this).prop('outerHTML');
                });
                var data = {
                    _token: "{{ csrf_token() }}",
                    story_id: $('#story_id').val(),
                    title,
                    content
                }
                const response = await HitData("{{ route('blog.post.create') }}", data, 'POST')
                Snackbar.show({
                    text: 'Saved!'
                })
            } catch (error) {
                Snackbar.show({
                    text: "Error " + error
                })
            }
        }

        async function publishStory(status) {
            try {
                var data = {
                    _token: "{{csrf_token()}}",
                    story_id: $('#story_id').val(),
                    newStatus: status
                }
                const response = await HitData('/story-update-status', data, 'POST')
                Snackbar.show({
                    text: response.message
                })
                window.location.reload()
            } catch (error) {
                Snackbar.show({
                    text: "Error " + error.responseJSON.message
                })
            }
        }
    </script>
@endsection
