<?php
namespace App\Gates;

class AdminGate{
    public function check_admin($user){
        return $user->email === 'admin@gmail.com';            
    }
}

?>