@extends('layout')

@section('title', 'Projeto - ' . $site->name)

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
        <div class="col-12">
            <div class="card card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>{{ $site->name }}</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>URL: </strong> <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></p>
                    <p><strong>Descrição: </strong> {{ $site->description }}</p>
                </div>
            </div>

            <div class="card card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Campos do Site</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($site->fields->isEmpty())
        <p>Não há campos adicionados a este site.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($site->fields as $field)
                    <tr>
                        <td>{{ $field->field_name }}</td>
                        <td>{{ $field->field_type }}</td>
                        <td>
                            <a href="{{ route('site_fields.edit', [$site->id, $field->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('site_fields.destroy', [$site->id, $field->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('site_fields.create', $site->id) }}" class="btn btn-info"><i class="fa fa-plus"></i> Add Campo(s)</a>
                </div>
            </div>

            <div class="card card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Conteúdos do Site</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($site->fields->isEmpty())
                        <p>Não há conteúdos adicionados a este site.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 150px">Campo</th>
                                    <th>Conteúdo</th>
                                    <th style="width: 100px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($site->fields as $field)
                                <tr>
                                    <td>{{ $field->field_name }}</td>
                                    <td>
                                        @if($field->field_type == 'image' && isset($field->contents->first()->content))
                                            <img src="{{ asset('storage/' . $field->contents->first()->content) }}" alt="{{ $field->field_name }}" class="img-fluid">
                                        @else
                                            {{ $field->contents->first()->content ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editContentModal{{ $field->id }}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteContentModal{{ $field->id }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- Edit Content Modal -->
                                <div class="modal fade" id="editContentModal{{ $field->id }}" tabindex="-1" role="dialog" aria-labelledby="editContentModalLabel{{ $field->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editContentModalLabel{{ $field->id }}">Editar Conteúdo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('site_contents.update', [$site->id, $field->contents->first()->id ?? 0]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="content{{ $field->id }}">Conteúdo</label>
                                                        @if($field->field_type == 'image')
                                                            <input type="file" name="content" id="content{{ $field->id }}" class="form-control">
                                                        @else
                                                            <input type="text" name="content" id="content{{ $field->id }}" class="form-control" value="{{ $field->contents->first()->content ?? '' }}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Content Modal -->
                                <div class="modal fade" id="deleteContentModal{{ $field->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteContentModalLabel{{ $field->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteContentModalLabel{{ $field->id }}">Remover Conteúdo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Tem certeza de que deseja remover o conteúdo deste campo?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('site_contents.destroy', [$site->id, $field->contents->first()->id ?? 0]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remover</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('site_contents.create', $site->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar Todos os Conteúdos</a>
                </div>
            </div>

        </div>
    </div>
    
    



    
</div>
@endsection
