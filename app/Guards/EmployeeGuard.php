<?php
namespace App\Guards;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

class EmployeeGuard extends SessionGuard
{
   /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool  $remember
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false)
    {

        $emailorempno =  $credentials['email']    ?? null;
        $password     =  $credentials['password'] ?? null;
        $email        = '';
        $employeeno   = '';
         if (filter_var($emailorempno, FILTER_VALIDATE_EMAIL)) {
            $email = $emailorempno;
          } else {
           $employeeno = $emailorempno;
          }
        
        if ($email && $password) {
            $user = $this->provider->retrieveByCredentials(compact('email'));
            if ($user && $this->provider->validateCredentials($user, compact('password'))) {

                $this->login($user, $remember);
                return true;
            }
        } elseif ($employeeno && $password) {
            $user = $this->provider->retrieveByCredentials(compact('employeeno'));
            if ($user && $this->provider->validateCredentials($user, compact('password'))) {
                $this->login($user, $remember);
                return true;
            }
        }

        return false;

    }
   
}