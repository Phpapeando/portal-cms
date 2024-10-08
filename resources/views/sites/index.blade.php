@extends('layout')

@section('title', 'Gerenciar Projetos')

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

<script>
  $(document).ready(function() {
      $('#siteDetailsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var siteId = button.data('site-id');
            var modal = $(this);
            var siteName = modal.find('#siteName');
            var siteUrl = modal.find('#siteUrl');
            var siteDescription = modal.find('#siteDescription');
            var profilesList = modal.find('#profilesList');
            var manageFieldsButton = modal.find('#manageFieldsButton');

            // Limpar os detalhes anteriores
            siteName.text('');
            siteUrl.text('');
            siteDescription.text('');
            profilesList.empty();

            // Atualizar o botão "Gerenciar Campos" com o siteId correto
            manageFieldsButton.attr('href', '/sites/' + siteId);

            // Fazer uma requisição AJAX para obter os detalhes do site
            $.ajax({
                url: '/sites/' + siteId + '/details/', // Rota para obter os detalhes do site
                method: 'GET',
                success: function(data) {
                    siteName.text(data.name);
                    siteUrl.text(data.url);
                    siteDescription.text(data.description);
                    
                    if (data.profiles.length > 0) {
                        data.profiles.forEach(function(profile) {
                            profilesList.append('<li class="list-group-item">' + profile.name + '</li>');
                        });
                    } else {
                        profilesList.append('<li class="list-group-item">Nenhum perfil associado.</li>');
                    }
                },
                error: function() {
                    siteName.text('Erro ao carregar os detalhes do site.');
                }
            });
        });
    });
    $('#deleteSiteModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var siteId = button.data('site-id');
      var modal = $(this);
      modal.find('#deleteForm').attr('action', '/sites/' + siteId);
  });
</script>

@endsection

@section('content')
<div class="container mx-auto">
    <div class="row align-center justify-content-center">
        <div class="col-md-8">

            <div class="card card-outline card-info" data-bs-theme="dark">
                <div class="card-header">
                    <div class="col">
                    <h3 class="card-title mt-2"><b>Gerenciar Projetos</b></h3>
                  
                    <a href="{{ route('sites.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>  Adicionar Projeto</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(isset($sites) && !$sites->isEmpty())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nome</th>
                                <th style="width: 230px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                            <tr>
                                <td>{{ $site->id }}</td>
                                <td>{{ $site->name }}</td>
                                <td class="text-center">
                                <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#siteDetailsModal" data-site-id="{{ $site->id }}">Exibir Detalhes <i class="fas fa-info-circle"></i></a>
                                <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSiteModal" data-site-id="{{ $site->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <ul id="usersList" class="list-group">
                            <li class="list-group-item">Nenhum Projeto cadastrado.</li>
                        </ul>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{ $sites->links() }}
                </div>
              </div>

        </div>
    </div>
</div>

<!-- Modal Detalhes-->
<div class="modal fade" id="siteDetailsModal" tabindex="-1" role="dialog" aria-labelledby="siteDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="siteDetailsModalLabel">Detalhes do Projeto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p><strong>Nome:</strong> <span id="siteName"></span></p>
              <p><strong>URL:</strong> <span id="siteUrl"></span></p>
              <p><strong>Descrição:</strong> <span id="siteDescription"></span></p>
              <p><strong>Perfis Associados:</strong></p>
              <ul id="profilesList" class="list-group">
                  <!-- Os perfis serão carregados aqui -->
              </ul>
          </div>
          <div class="modal-footer">
              <a href="" id="manageFieldsButton" class="btn btn-info">Ir Para o Projeto   <i class="fas fa-arrow-right"></i></a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar   <i class="fas fa-times"></i></button>
          </div>
      </div>
  </div>
</div>
<!-- Modal Excluir Site -->
<div class="modal fade" id="deleteSiteModal" tabindex="-1" role="dialog" aria-labelledby="deleteSiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSiteModalLabel">Excluir Projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir este projeto?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deleteForm" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
