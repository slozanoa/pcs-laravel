<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;

class UserController extends Controller
{
    public function  prueba(Request $request){

    	 $json = $request->input('json', null);
     	 $params = json_decode($json);
      	$params_array = json_decode($json,true);
      	var_dump($params_array);
      	die();
  }
  public function register(Request $request){
     //recoger los datos por post
      
      $json = $request->input('json', null);
      $params = json_decode($json);
      $params_array = json_decode($json,true);
      if(!empty($params) && !empty($params_array)){
          
          //limpiar los datos
           $params_array = array_map('trim', $params_array);
           
           //validar los datas
           $validate = \Validator::make($params_array,[
               'name'=> "required|alpha",
               'email' => "required|email|unique:users",
               'password'=> "required",
               'description'=> "required",

           ]);
           if($validate->fails()){
               $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El usuario no se ha creado',
                'errors' => $validate->errors()
                );
           }else{
               
               //cifrar la contraseña
               $pwd = hash('sha256', $params->password);
               
               //creo el objeto users
       
              $user = new User();
              $user->role_id = (int)$params_array['role'];
              $user->name = $params_array['name'];
              $user->surname = $params_array['surname'];
              $user->email = $params_array['email'];
              $user->password = $pwd;
              $user->description = $params_array['description'];
              
             
              $user->save();
               $data = array(
                   'status' => 'success',
                   'code' =>200,
                   'message' => 'el usuario se ha creado correctamente',
                   'user' =>$user
                   
               );
           }
      }else{
          $data= array(
             'status'=>'error',
             'code'=>404,
             'message' => 'El usuario no se ha creado correctamente'
          );
      }
          
      return response()->json($data, $data['code']);
  }

   public function login(Request $request){
      $jwtAuth = new \JwtAuth();
     //recoger datos por post
      $json = $request->input('json', null);
      $params = json_decode($json);
      $params_array = json_decode($json, true);
      if (!empty($params) && !empty($params_array)) {
            $validate = \Validator::make($params_array, [
                        'email' => "required|email",
                        'password' => "required"
            ]);
            if ($validate->fails()) {
                //la validacion falló
                $signup = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no está logueado',
                    'error' => $validate->errors()
                );
            } else {
                    
                $pwd = hash('sha256', $params->password);
                
                $signup = $jwtAuth->signup($params->email, $pwd);
                if (!empty($params->gettoken)) {
                    $signup = $jwtAuth->signup($params->email, $pwd, true);
                }
            }
        }
        return response()->json($signup,200);
  }
   public function  getUser(){

      $users = User::all();
      $data = array(
                   'status' => 'success',
                   'code' =>200,
                   'user' =>$users
                   
               );
      return response()->json($data, $data['code']);
  }
}
