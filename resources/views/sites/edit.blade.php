@extends('layout')

@section('title', 'Editar Conteúdos: ' . $site->name)

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('scripts')
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                toastr.options = {
                    "progressBar": true
                }
                break;
            
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
@endsection

@section('content')
<div class="container mx-auto">
    <div class="row align-center justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar Conteúdos: <b>{{ $site->name }}</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('site_contents.update_all', $site->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @foreach($site->fields as $field)
                        <div class="form-group">
                            <label for="content_{{ $field->id }}">{{ $field->field_name }}</label>
                            @if($field->field_type == 'image')
                                @if(isset($field->contents->first()->content))
                                    <img src="{{ asset('storage/' . $field->contents->first()->content) }}" alt="{{ $field->field_name }}" class="img-fluid mb-2">
                                @endif
                                <input type="file" name="contents[{{ $field->id }}]" id="content_{{ $field->id }}" class="form-control">
                            @else
                                <textarea name="contents[{{ $field->id }}]" id="content_{{ $field->id }}" class="form-control">{{ $field->contents->first()->content ?? '' }}</textarea>
                                @endif
                            </div>
                            @endforeach
    
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                        Salvar   <i class="fa fa-save"></i>
                                    </button>
                                    <a href="{{ route('sites.show', $site->id) }}" type="button" class="float-right btn btn-secondary mt-3 ml-1">
                                        Voltar   <i class="fas fa-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
