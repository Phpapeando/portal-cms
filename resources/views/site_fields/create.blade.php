@extends('layout')

@section('title', 'Adicionar Campos: ' . $site->name)

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
            <div class="col-md-8">
    
                <div class="card card-outline card-primary" data-bs-theme="dark">
                    <div class="card-header">
                        <form action="{{ route('site_fields.store', $site->id) }}" method="POST">
                            @csrf
                            <div>
                                <h4 class="text-center"><b>Adicionar Campos</b></h4>
                            </div>
                            <div id="fields-container">
                                <div class="fields[0][name]">
                                    <div class="row">
                                        <div class="form-group col-9">
                                            <label for="name">Nome do Campo:</label>
                                            <input type="text" class=" form-control" name="fields[0][name]" placeholder="Nome do Campo" required>
                                        </div>
                                    
                                        <div class="col-3">
                                            <label for="fields[0][type]">Tipo:</label>
                                            <select class=" form-control" name="fields[0][type]" required>
                                                <option value="text">Texto</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="image">Imagem</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info btn-sm" type="button" onclick="addField()"><i class="fa fa-plus"></i> Adicionar Campo</button>
                            <button class="btn btn-danger btn-sm" type="button" onclick="addField()"><i class="fa fa-minus"></i> Remover Campo</button>
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

    <script>
        let fieldIndex = 1;
        function addField() {
            const container = document.getElementById('fields-container');
            const fieldHTML = `
                <div class="fields">
                                    <div class="row">
                                        <div class="form-group col-9">
                                            <label for="name">Nome do Campo:</label>
                                            <input type="text" class=" form-control" name="fields[0][name]" placeholder="Nome do Campo" required>
                                        </div>
                                    
                                        <div class="col-3">
                                            <label for="fields[0][type]">Tipo:</label>
                                            <select class=" form-control" name="fields[0][type]" required>
                                                <option value="text">Texto</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="image">Imagem</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>`;
            container.insertAdjacentHTML('beforeend', fieldHTML);
            fieldIndex++;
        }
    </script>
@endsection
