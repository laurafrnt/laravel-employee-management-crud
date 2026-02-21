@extends('layouts.app')

@section('title')
    Modification de l'utilisateur {{$user->name}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Modification de l'utilisateur {{$user->name}}</div>

                    <!-- FORMULAIRE UPDATE USER -->
                    <div class="card-body">
                        <!-- ON ENVOI LE PARAMETRE USER VERS LA FONCTION UPDATE -->
                        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if (session('success'))
                                <div class="alert alert-success" role="alert" class="text-danger">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- ROLES -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="roles" class="form-label">Rôles: </label>
                                    <div class="form-check">
                                        @foreach($roles as $role)
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->name }}"
                                                       @if($user->hasRole($role->name)) checked @endif>
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- PERMISSIONS -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="permissions" class="form-label">Permissions: </label>
                                    <div class="form-check">
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->name }}"
                                                       @if($user->hasPermissionTo($permission->name)) checked @endif>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- AVATAR -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Avatar: </label>
                                    <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}"  autocomplete="avatar">

                                    @error('avatar')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <img src="/avatars/{{ $user->avatar }}" style="width:80px;margin-top: 10px;">
                                </div>
                            </div>

                            <!--  NAME -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nom d'utilisateur: </label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" autofocus="" >
                                    @error('name')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email: </label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" autofocus="" >
                                    @error('email')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- TELEPHONE -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Téléphone: </label>
                                    <input class="form-control" type="text" id="phone" name="phone" value="{{ $user->phone }}" autofocus="" >
                                    @error('phone')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- VILLE -->
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">Ville: </label>
                                    <input class="form-control" type="text" id="city" name="city" value="{{ $user->city }}" autofocus="" >
                                    @error('city')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- MDP -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Nouveau mot de passe: </label>
                                    <input class="form-control" type="password" id="password" name="password" autofocus="" >
                                    @error('password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- CONFIRME MDP -->
                                <div class="mb-3 col-md-6">
                                    <label for="confirm_password" class="form-label">Confirmé le nouveau mot de passe: </label>
                                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" autofocus="" >
                                    @error('confirm_password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- BOUTON UPDATE -->
                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Mettre à jour l\'utilisateur') }}
                                    </button>
                                </div>
                            </div>

                            <!-- RETOUR SUR L'INDEX -->
                            <div class="mb-3">
                                <a class="btn btn-info" href="{{ route('users.index') }}">Retour</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
