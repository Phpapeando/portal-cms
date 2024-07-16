@extends('layout')

@section('content')
    <div class="container">
        <h1>Adicionar Conteúdos ao Site: {{ $site->name }}</h1>
        <form action="{{ route('site_contents.store', $site->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @foreach($site->fields as $field)
                <div class="form-group">
                    <label>{{ $site->field->field_name }}</label>
                    @if($field->field_type == 'text')
                        <input type="text" name="contents[{{ $field->id }}]" class="form-control">
                    @elseif($site->field->field_type == 'textarea')
                        <textarea name="contents[{{ $field->id }}]" class="form-control"></textarea>
                    @elseif($site->field->field_type == 'image')
                        <input type="file" name="contents[{{ $field->id }}]" class="form-control">
                    @endif
                </div>
            @endforeach
            <button type="submit">Salvar Conteúdos</button>
        </form>
    </div>
@endsection
