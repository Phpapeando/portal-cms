@extends('layout')

@section('title', 'Perfil de Usuário')

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

            <div class="card">
                <div class="card-header">
                    <div class="col">
                    <h3 class="card-title mt-2"><b>Usuários</b></h3>
                  
                    <a href="" class="btn btn-primary float-right"><i class="fas fa-plus"></i>  Adicionar Perfil de Usuário</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th style="width: 93px">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <form action="" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este usuário?');">
                              @csrf
                              @method('DELETE')
                              <a href="" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                              <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  
                </div>
              </div>

        </div>
    </div>
</div>


@endsection