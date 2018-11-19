<?php 
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



trait IssueTokenTrait {
	public function issueToken(Request $request, $grant_type, $scope ="*")
	{
		$params = [
			'grant_type' => 'password',
			'client_id' => $this->client->id,
			'client_secret' => $this->client->secret,
			'username' => $request->username ?: $request->email,
			'scope' => $scope
		];

		$request->request->add($params);

		$proxy = Request::create('oauth/token','POST');

		return Route::dispatch($proxy);
	}
}