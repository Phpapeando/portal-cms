@extends('layout')

@section('title', 'Dashboard')

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

<div class="container">
    <div class="row align-center justify-content-center">
        <div class="col-12">

            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Usuários</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        @if(auth()->user()->profile->id == 1)
                        <a href="{{ route('users.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
    
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalProfiles }}</h3>
                            <p>Perfis</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        @if(auth()->user()->profile->id == 1)
                        <a href="{{ route('profiles.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
    
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalSites }}</h3>
                            <p>Sites</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        @if(auth()->user()->profile->id == 1)
                        <a href="{{ route('sites.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
</div>
    
@endsection
