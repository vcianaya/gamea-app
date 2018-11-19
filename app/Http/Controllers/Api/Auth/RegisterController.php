<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// HELPERS
use Illuminate\Support\Facades\Route;
//MODElS
use Laravel\Passport\Client;
use App\User;
class RegisterController extends Controller
{
	private $client;
	public function __construct()
	{
		$this->client = Client::find(1);
	}
	public function register(Request $request)
	{
		$this->validate($request,[
			'ci' => 'required',
			'nombre' => 'required',
			'apellido' => 'required',
			'email' => 'required|unique:users,email',
			'distrito' => 'required',
			'fec_nac' => 'required',
			'password' => 'required|min:4|confirmed'
		]);
		$user = User::create([
			'ci' => $request->ci,
			'nombre' => $request->nombre,
			'apellido' => $request->apellido,
			'telefono' => $request->telefono,
			'email' => $request->email,
			'zona' => $request->zona,
			'distrito' => $request->distrito,
			'fec_nac' => $request->fec_nac,
			'password' => bcrypt($request->password)
		]);

		$params = [
			'grant_type' => 'password',
			'client_id' => $this->client->id,
			'client_secret' => $this->client->secret,
			'username' => request('email'),
			'password' => request('password'),
			'scope' => '*'
		];
		$request->request->add($params);
		$proxy = Request::create('oauth/token','POST');
		return Route::dispatch($proxy);
	}
}
