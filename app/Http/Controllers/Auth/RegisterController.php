<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                        ? new JsonResponse([], 201)
                        : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
protected function validator(array $data)
{
    return Validator::make($data, [
        'cin' => ['required', 'string', 'max:255', 'unique:users,cin'],
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'dateN' => ['required', 'date', 'before:today'],
        'telephone' => ['required', 'string', 'digits:10'],
        'adresse' => ['required', 'string', 'max:1024'],
        'sexe' => ['required', 'in:m,f'],
        'etablissement' => ['required', 'string', 'max:255'],
        'filiere' => ['required', 'string', 'max:255'],
        'niveau' => ['required', 'string', 'in:bac+1,bac+2,bac+3,bac+4,bac+5'],
        // Pour le champ 'cv', une validation de fichier pourrait ressembler à ceci
        'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // Assurez-vous que le fichier ne dépasse pas 2MB et est de type pdf, doc ou docx
    ]);
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Gestion du téléchargement du fichier CV
        $cvPath = null;
        if (isset($data['cv'])) {
            $cvPath = $data['cv']->store('cvs');
        }

        return User::create([
            'cin' => $data['cin'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dateN' => $data['dateN'],
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse'],
            'sexe' => $data['sexe'],
            'etablissement' => $data['etablissement'],
            'filiere' => $data['filiere'],
            'niveau' => $data['niveau'],
            'cv' => $cvPath, // Sauvegarde le chemin du fichier dans la base de données
        ]);
    }

}
