@extends('layouts.app')
@section('title', 'My-echosystem - New story')

@section('c_css')
    <script src="{{ asset('/assets/vendor/ckeditor/build/ckeditor.js') }}"></script>
@endsection

@section('content')
    <input type="hidden" name="thumbnail" id="thumbnail">
    <div id="editor">
    </div>

@endsection
@section('c_js')
    @include('_partials.c_js.ckeditorFunc')
    @include('_partials.c_js.ajaxPromise')
    <script>
        async function postStory(editor) {
            try {
                var content = "";
                var title = editor.children().first().prop('outerHTML') == `<p><br data-cke-filler="true"></p>` ? '<p>Untitle story</p>' : editor.children().first().prop('outerHTML'); 
                editor.children().each(function() {
                    content += $(this).prop('outerHTML');
                });
                var data = {
                    _token: "{{ csrf_token() }}",
                    thumbnail: $('#thumbnail').val(),
                    title,
                    content
                }
                const response = await HitData("{{ route('blog.post.create') }}", data, 'POST')
                Snackbar.show({
                    text: 'Created!'
                })
                window.location.href = `/story/${response.id}/edit`
            } catch (error) {
                Snackbar.show({
                    text: "Error " + error
                })
            }
        }
    </script>
@endsection
