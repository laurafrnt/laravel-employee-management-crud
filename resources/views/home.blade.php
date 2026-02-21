@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Accueil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth()
                    {{ __('Vous êtes connecté !') }}
                            @can('client.user')
                                Vous avez accès à la vue client
                            @endcan

                            @can('edit.user')
                            Vous avez accès à la vue admin
                            @endcan
                        @endauth

                    @guest()
                        Vous avez accès à la vue visiteur
                        @endguest

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
