@extends('layout')

@section('title', 'Dashboard')

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
                        <a href="{{ route('users.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="{{ route('profiles.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="{{ route('sites.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
</div>
    
@endsection
