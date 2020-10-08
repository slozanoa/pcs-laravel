<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;



class PruebaController extends Controller
{
   public function prueba(){
   	
   	
  		$users=Role::find(2)->users;
  		if (is_object($users)) {
        var_dump($users->toArray());
		foreach ($users as $user){
            echo "<h1>{$user->name}</h1>";
            echo "<h3>{$user->surname}</h3>";
            echo "<h3>{$user->email}</h3>";
			echo "<hr>";	
                        
        }
    }else{
    	echo "No funciona";
    }
  		
        
  
        die();
    }
}
