<?php 

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

     /**
      * Summary of register
      * @param array $data
      * @return User|\Illuminate\Database\Eloquent\Model
      */
     public function register(array $data)  
     {
         $data['password'] = Hash::make($data['password']);
 
         return User::create($data);
     }
     
     /**
      * Summry of login
      */

     public function login(string $email, string $password) 
     {
         $user = User::where('email', $email)->first();
 
         if ($user && Hash::check($password, $user->password)) {
             return $user;
         }
 
         return null;
     }
}
