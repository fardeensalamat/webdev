<?php
namespace App\Http\Controllers\Api;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|max:50',
            'email'=> 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|max:50',
        ]);
        $validateData['password'] = Hash::make($request->password);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'accessToken' => $accessToken]);
    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        if(!auth()->attempt($loginData))
        {
            return response(['message'=> 'invalid cradentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'accessToken' => $accessToken]);
    }
    public function me(Request $request)
    {
        // dd($request->all());
        // return $request->user();
        $me = auth()->user();
        dd($me);
        $time = Carbon::now();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['me' => $me, 'time' => $time, 'accessToken' => $accessToken]);
    }
}
