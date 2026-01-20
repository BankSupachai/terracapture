<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Mongo;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            // $email = (string) $request->email;
            // return Limit::perMinute(5)->by($email.$request->ip());
            $w[]  = array('email', $request->email);
            $user = User::where('email', $request->email)->first();

            $w[]  = array('email', $request->email);
            $user_data = (object) Mongo::table('users')->where('email', $request->email)->first();
            if ( $user && Hash::check($request->password, $user->password )  ) {

                $timeend = time() + 2592000; // seconds in month
                setcookie("uid", $user_data->id, $timeend, "/");
                // $minutes = 60 * 24;
                // Cookie::queue('user', strval($user_data->_id) , $minutes, '/');
                return $user;
            } else {
                Session::flash('error', 'error');
                return redirect("login");
                // return false;
            }

        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $w[]  = array('email', $request->email);
            $user = User::where('email', $request->email)->first();

            $w[]  = array('email', $request->email);
            $user_data = (object) Mongo::table('users')->where('email', $request->email)->first();
            if ( $user && Hash::check($request->password, $user->password )  ) {
                $minutes = 60 * 24;
                Cookie::queue('user', strval($user_data->_id) , $minutes, '/');
                return $user;
            } else {
                Session::flash('error', 'error');
                return false;
            }

        });
    }
}
