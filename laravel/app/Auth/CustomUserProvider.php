<?php 

namespace App\Auth;

use App\User;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use App\Http\Controllers\Config;

class CustomUserProvider implements UserProviderInterface {
    /**
    * @param  mixed  $identifier
    * @return \Illuminate\Contracts\Auth\Authenticatable|null
    */
    public function retrieveById($identifier)
    {
        return User::find($id);
    }
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = User::where('email', $credentials['email']);

        if($user->count() >0)
        {
            return $user->first();
        }
        return null;
    }
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if($user->email == $credentials['email'] && $user->password == Config::encrypt($credentials['password']))
        {
            $user->last_login_time = Carbon::now();
            $user->save();

            return true;
        }
        return false;
    }

}