<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Messages personnalisés pour les erreurs
        $messages = [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser les 100 caractères',

            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
            'email.max' => 'L\'adresse email ne peut pas dépasser les 100 caractères'
        ];

        // On valide les données
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|unique:users,email',
        ], $messages);


        // On créer un utilisateur avec ces données
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make("password"); // Hash::make pour chiffrer le mot de passe
        $user->save();


        return redirect()->route('users.index')->with('success', 'L\'utilisateur a bien été ajouté, le mot de passe par défaut est "password" changez le dans le profile.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.read',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.users.edit', compact('user','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        // Messages personnalisés pour les erreurs de validation
        $messages = [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser :max caractères.',

            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'email.max' => 'L\'adresse e-mail ne peut pas dépasser :max caractères.',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée.',

            'phone.digits' => 'Le numéro de téléphone n\'est pas valide',
            'phone.regex' => 'Le numéro de téléphone doit commencer par le chiffre 0',

            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule et un chiffre.',

            'confirm_password.required_with' => 'Veuillez confirmer le mot de passe',
            'confirm_password.same' => 'Les mots de passe ne correspondent pas',

            'avatar.image' => 'Le fichier doit être une image.',
            'avatar.mimes' => 'L\'image doit être de type : :values.',
            'avatar.max' => 'L\'image ne doit pas dépasser :max kilo-octets.',

            'city.max' => 'La ville ne peut pas dépasser :max caractères.',
        ];

        // Validation des données reçues du formulaire
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'phone' => [
                'nullable',
                'digits:10',
                'regex:/^0\d{9}$/', // Le numéro commence par 0
            ],
            'password' => [
                'nullable',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/', // Le mot de passe doit avoir un chiffre et une majuscule
            ],
            'confirm_password' => 'required_with:password|same:password',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'city' => 'nullable|max:100',
        ], $messages);

        // Mise à jour des champs de l'utilisateur
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->city = $validatedData['city'];

        // Mise à jour du mot de passe si renseigné
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']); // hash du mdp pour chiffrer et sécuriser
        }

        // Traitement de l'avatar s'il est envoyé
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Enregistrer le nouvel avatar
            $avatarName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->storeAs('public/avatars', $avatarName);
            $user->avatar = $avatarName;
        }

        // Mise à jour des rôles et permissions
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        $user->save();

        return redirect()->route('users.index')->with('success', 'L\'utilisateur a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','L\'utilisateur a bien été suprimé !');
    }
}
