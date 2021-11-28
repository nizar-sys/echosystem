@extends('layouts.app')
@section('title', 'My-echosystem - Edit your story')

@section('c_css')
    <script src="{{ asset('/assets/js/ckeditor.js') }}"></script>
@endsection

@section('content')
    <input type="hidden" name="story_id" id="story_id" value="{{ $story->id }}">
    <button class="btn btn-sm btn-success float-right" onclick="postStory($('#editor'))">Save</button>
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
                var title = editor.children().first().prop('outerHTML')
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
                console.log(response);
                Snackbar.show({
                    text: 'Saved!'
                })
            } catch (error) {
                Snackbar.show({
                    text: "Error " + error
                })
            }
        }
    </script>
@endsection
