@extends('layouts.app_layout')

@section('styles')
    @parent
@endsection
@section('scripts')
    @parent
@endsection

@push('page_scripts')
<script type="text/javascript">
    $(function(){
        //
        //$('#content').summernote();
        $('#content').summernote({
            placeholder: 'Content',
            tabsize: 2,
            height: 300,    // set editor height
            minHeight: null,    // set minimum height of editor
            maxHeight: null,    // set maximum height of editor
            focus: true,    // set focus to editable area after initializing summe
        });
        //$('#content').summernote('destroy');
        //var markupStr = $('#content').summernote('code');
        //var markupStr = $('.content').eq(1).summernote('code');
        //var markupStr = 'hello world';
        //$('#content').summernote('code', markupStr);
        /*
        $('#content').summernote({
            placeholder: 'Content',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        */
    });
</script>
@endpush

@section('container')
    <!-- -->
    <div class="page-header">
        <h1 class="display-4">Post</h1>
    </div>

    <div class="row">
        <div class="col col-md-12">

            <form id="myform" action="{!! route('post_b_store') !!}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="50"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    <!-- -->
@endsection