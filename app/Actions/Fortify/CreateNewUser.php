<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => array_merge($this->passwordRules(), ['confirmed']), 
        ])->validate();

        $name = $input['prenom'] . ' ' . $input['nom'];

        return User::create([
            'prenom' => $input['prenom'],
            'nom' => $input['nom'],
            'name' => $name,
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
            'statut' => false,
  ]);

        // Redirection vers la page de connexion
        return redirect()->route('acceuilDashboard')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }   
}
