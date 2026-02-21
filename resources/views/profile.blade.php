@extends('layouts.app')

@section('title')
    Profile utilisateur - {{auth()->user()->name}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success" role="alert" class="text-danger">
                                    {{ session('success') }}
                                </div>
                            @endif

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
                                    <img src="/avatars/{{ auth()->user()->avatar }}" style="width:80px;margin-top: 10px;">
                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nom d'utilisateur: </label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="" >
                                    @error('name')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email: </label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" autofocus="" >
                                    @error('email')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Mot de passe: </label>
                                    <input class="form-control" type="password" id="password" name="password" autofocus="" >
                                    @error('password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="confirm_password" class="form-label">Confirmé le mot de passe: </label>
                                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" autofocus="" >
                                    @error('confirm_password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Téléphone: </label>
                                    <input class="form-control" type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}" autofocus="" >
                                    @error('phone')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">Ville: </label>
                                    <input class="form-control" type="text" id="city" name="city" value="{{ auth()->user()->city }}" autofocus="" >
                                    @error('city')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Mettre à jour le profile') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
