@extends('layouts.app')

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div id="alert_success" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a class="btn btn-success mb-3" href="{{ route('users.create')}}">Ajouter un utilisateur</a>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->city ?? '-' }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Voir</a>
                                <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">Modifier</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-dark">
                <tr>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('jsCustom')

    <script>
        setTimeout(() => {
            let alert = document.querySelector("#alert_success");
            if (alert) {
                alert.remove();
            }
        }, 5000);
    </script>
@endsection
