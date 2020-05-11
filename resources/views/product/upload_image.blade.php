@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{__('Sube la imagen de la nueva categoría')}} <b>{{$category->name}}</b>
                    </div>
                    <div class="ibox-content">
                        <form action="{{route('category_image')}}" class="dropzone" id="dropzoneForm">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                            <input type="hidden" name="cat_id" value="{{$category->id}}">
                        </form>
                        <div class="box-footer">                            
                            <a href="{{ route('product_category.index')}}" role="button" class="btn btn-primary ">Finalizar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    Dropzone.options.dropzoneForm = {
        paramName: "profileImg", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        acceptedFiles: ".jpg, jpeg",
        dictDefaultMessage: "Arrastra tu fotografía hacia acá.",
        dictInvalidFileType: "No puedes subir archivos de este tipo",
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
        init: function() {
            this.on("addedfile", function() {
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                }
            });
        }
    };
</script>
@endsection