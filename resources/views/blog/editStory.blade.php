@extends('layouts.app')
@section('title', 'My-echosystem - Edit your story')

@section('menu')
    @if ($story->status == 'draft')
        <li class="nav-item">
            <a class="nav-link btn btn-success btn-sm text-white" onclick="event.preventDefault();" data-toggle="modal"
                data-target="#exampleModal">Publish</a>
        </li>
    @elseif($story->status == 'published')
        <li class="nav-item">
            <a class="nav-link btn btn-danger btn-sm text-white" onclick="event.preventDefault(); publishStory('draft')">Save
                to draft</a>
        </li>
    @endif
@endsection
@section('c_css')
    <script src="{{ asset('/assets/vendor/ckeditor/build/ckeditor.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <input type="hidden" name="story_id" id="story_id" value="{{ $story->id }}">
    <input type="hidden" name="thumbnail" id="thumbnail" value="{{ $story->thumbnail }}">
    <div id="editor">
        {!! $story->content !!}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add your post tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="tags" name="tags-input" multiple="multiple" style="width: 100%">

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="publishStory('published')">Publish</button>
                </div>
            </div>
        </div>
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
                    thumbnail: $('#thumbnail').val(),
                    title,
                    content,
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
                    _token: "{{ csrf_token() }}",
                    story_id: $('#story_id').val(),
                    newStatus: status,
                    tags: $('#tags').val().join(',')
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

        $("#tags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
@endsection
