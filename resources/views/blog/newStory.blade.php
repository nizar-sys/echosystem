@extends('layouts.app')
@section('title', 'My-echosystem - New story')

@section('c_css')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/inline/ckeditor.js"></script>
@endsection

@section('content')
    <div id="editor">
    </div>
    <script>
        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        InlineEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
