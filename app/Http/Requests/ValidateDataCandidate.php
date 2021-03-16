<?php
namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Utils\Helpers;
use Validator;

class ValidateDataCandidate
{
	 public static function  create(Request $request){
        $rules = [
          'name'        => 'required|max:100', 
          'surname'     => 'required|max:100',
         	'email'       => 'required|string|email|unique:candidates|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/',
          'phone'       => 'required|integer|min:10',
          'date_of_interview' => 'required|date_format:Y-m-d',
          'qualification'=> 'required|integer|min:1|max:10'
        ];

        $messages = [
          'name.required'=>'El nombre es requerido',
          'name.max'=>'Solo se permiten 100 caracteres para el nombre',
        	'surname.required'=>'El apellido es requerido',
          'surname.max'=>'Solo se permiten 100 caracteres para el apellido',
          'email.required'=>'El email es requerido',
          'email.unique'=>'El correo electronico ya se encuentra registrado',
        	'email.email'=>'El email ingresado no es valido',
          'email.regex'=>'El formato del email no es correcto',
        	'phone.required'=>'El número telefónico es requerido',
          'phone.integer'=>'Solo se aceptan números para el contacto teléfonico',
          'phone.min'=>'El número telefónico debe contener como mínimo 10 dígitos',
          'date_of_interview.required'=>'La fecha de entrevista es requerida',
          'date_of_interview.date_format'=>'La fecha de entrevista debe tener el siguiente formato YYYY-MM-DD',
          'qualification.required'=>'Los calificación es requerida',
          'qualification.integer'=>'Los calificación debe ser númerica',
          'qualification.min'=>'La calificación no debe ser menor de 1',
          'qualification.max'=>'La calificación no debe ser mayor de 10',
        ];
        //Se almacena las validaciones que haya captado la clase Validator para poder manejarlas en esta ∂∂∂
        $confirm = Validator::make($request->all(), $rules, $messages);
        //Verificar las validaciones con error
        if($confirm->fails())
        {
          //retorna la variable errors con lo que haya encontrado Validator
           $errors=$confirm->errors();
           //este array contiene las validaciones que ha obtenido
           return Helpers::responseJson('ERROR','Error al validar los datos',$errors);
        }
        // si no hay errores de validaciones deja pasar a las demas sentencias que tenga el controlador que la esta llamando
         return false;   
    }

    public static function  update(Request $request, $id){
        $rules = [
            'email'=> 'email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/|unique:candidates,email,'.$id,
            'qualification'=> 'required|integer|min:1|max:10'
        ];
        $messages = [
          'email.unique'=>'El correo electronico ya se encuentra registrado',
          'email.email'=>'El email ingresado no es valido',
          'email.regex'=>'El formato del email no es correcto',
          'qualification.integer'=>'Los calificación debe ser númerica',
          'qualification.min'=>'La calificación no debe ser menor de 1',
          'qualification.max'=>'La calificación no debe ser mayor de 10',
        ];
        $confirm = Validator::make($request->all(), $rules, $messages);
        if($confirm->fails())
        {
           $errors=$confirm->errors(); 
           return Helpers::responseJson('ERROR','Error al validar los datos',$errors);
        }  
         return false;   
    }
}