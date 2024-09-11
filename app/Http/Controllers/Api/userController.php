<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class userController extends Controller
{
    function login(Request $request) {

        $std_validator  = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],[
            "email.required" => "You must add email to log in.",
            "email.email" => "it is not an email format what you provides.",
            "device_name.required" => "Device name needed.",
        ]);
        if ($std_validator-> fails()) {
            return response()->json(['errors' => $std_validator->errors()],400);
        }




        $user = User::where('email', $request->email)->first();

        if (! $user ) {

            return response()->json(['errors' => "there is no user with the provided email."],404);

        }else if(! Hash::check($request->password, $user->password)){
            return response()->json(['errors' => "password is incorrect please try again later."],401);

        }

        return $user->createToken($request->device_name)->plainTextToken;
    }


    function logoutFromOneDevice()
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out from this device'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error logging out from this device', 'error' => $e->getMessage()], 500);
        }
    }


    function logoutFromAllDevices()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out from all devices'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error logging out from all devices', 'error' => $e->getMessage()], 500);
        }
    }
//
//    function createUserGit() {
//        $githubUser = Socialite::driver('github')->stateless()->user();
//
//        $user = User::updateOrCreate([
//            'github_id' => $githubUser->id,
//        ], [
//            'name' => $githubUser->name,
//            'email' => $githubUser->email,
//            'password' => $githubUser->token,
//            'image' => $githubUser->getAvatar(),
//
//            'github_token' => $githubUser->token,
//            'github_refresh_token' => $githubUser->refreshToken,
//        ]);
//
//        Auth::login($user);
//
//        return view("main", ["user"=>$user]);
////        return response()->json(["user"=>$user]);
//
//        // $user->token
//    }
//
//



    function createUserGit() {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            $user = User::where('email', $githubUser->email)->first();

            if ($user) {
                $user->update([
                    'github_id' => $githubUser->id,
                    'name' => $githubUser->name,
                    'password' => bcrypt($githubUser->token),
                    'image' => $githubUser->getAvatar(),
                    'github_token' => $githubUser->token,
                    'github_refresh_token' => $githubUser->refreshToken ,
                ]);
            } else {

                $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => $githubUser->token,
            'image' => $githubUser->getAvatar(),

            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
            }

            Auth::login($user);

            return view("home", ["user" => $user]);

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['msg' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


}
