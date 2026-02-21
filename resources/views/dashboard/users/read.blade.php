@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Détails de l'utilisateur</div>
                    <div class="card-body">
                        <!-- NOM -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom d'utilisateur :</label>
                            <p id="name">{{$user->name}}</p>
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <p id="email">{{$user->email}}</p>
                        </div>

                        <!-- AVATAR -->
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar :</label>
                            @if($user->avatar)
                                <img src="/avatars/{{ $user->avatar }}" class="img-thumbnail" style="max-width: 150px; height: auto;" alt="avatar">
                            @else
                                <span>Non renseigné</span>
                            @endif
                        </div>

                        <!-- TELEPHONE -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone :</label>
                            <p id="phone">{{ $user->phone ?? 'Non renseigné' }}</p>
                        </div>

                        <!-- VILLE -->
                        <div class="mb-3">
                            <label for="city" class="form-label">Ville :</label>
                            <p id="city">{{ $user->city ?? 'Non renseigné' }}</p>
                        </div>

                        <!-- RETOUR SUR L'INDEX -->
                        <div class="mb-3">
                            <a class="btn btn-info" href="{{ route('users.index') }}">Retour</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
