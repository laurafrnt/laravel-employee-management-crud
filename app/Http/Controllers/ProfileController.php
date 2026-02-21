<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'confirm_password' => 'required_with:password|same:password',
            'avatar' => 'image',
        ]);

        $input = $request->all();

        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);

            $input['avatar'] = $avatarName;

        } else {
            unset($input['avatar']);
        }

        if ($request->filled('password')) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        auth()->user()->update($input);

        return back()->with('success', 'Profile modifié avec succes !');
    }

    public function destroy($id)
    {
        // Recherche de l'utilisateur par son identifiant. Si l'utilisateur n'est pas trouvé, une exception "ModelNotFoundException" est levée.
        $user = User::findOrFail($id);

        // Vérifie si l'utilisateur authentifié est bien celui qui souhaite supprimer son compte.
        // Si c'est pas le cas erreur 403 pour empecher l'action
        if (Auth::id() !== $user->id) {
            abort(403);
        }

        // Déconnecte l'utilisateur actuellement authentifié.
        Auth::logout();

        // Supprime l'utilisateur de la base de données.
        $user->delete();

        // Redirige l'utilisateur vers la page d'accueil (route '/home') avec un message de succès indiquant que le compte a été supprimé.
        return redirect('/home')->with('success', 'Votre compte a été supprimé avec succès.');
    }

}
