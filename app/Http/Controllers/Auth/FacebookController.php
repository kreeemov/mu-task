<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    //
    public function redirectToFacebook()

    {

        return Socialite::driver('facebook')->redirect();

    }




    public function handleFacebookCallback()

    {

        try {

            $user = Socialite::driver('facebook')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['facebook_id'] = $user->getId();


            $userModel = new User;

            $createdUser = $userModel->addNew($create);

            Auth::loginUsingId($createdUser->id);


            return redirect()->route('home');


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }

    }


}
