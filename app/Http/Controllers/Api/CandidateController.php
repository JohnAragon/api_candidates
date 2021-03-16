<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Utils\Helpers;
use App\Http\Requests\ValidateDataCandidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $list=Candidate::orderBy('created_at')->get();
       return Helpers::ResponseJson('OK','Datos cargados exitosamente',$list);
       if(!$list) return Helpers::ResponseJson('ERROR','No se han cargado los datos, intente nuevamente','');
    }

    /**
     * Display a listing with specific data search of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        $dates_of_interview=[];
        $name=$request->name;
        $surname=$request->surname;
        $email=$request->email;
        $dates_of_interview[]=$request->date_start;
        $dates_of_interview[]=$request->date_end;
        $qualification=$request->qualification;
        $result=Candidate::orderBy('created_at','desc')
        ->name($name)
        ->surname($surname)
        ->email($email)
        ->dateofinterview($dates_of_interview)
        ->qualification($qualification)
        ->get();
        if(count($result)>0){
            return Helpers::ResponseJson('OK',count($result).' registros encontrados',$result);
        }else {
            return Helpers::ResponseJson('INFO','No se encontraron coincidencias',$result);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=ValidateDataCandidate::create($request);
        if($validate) return $validate;
        try {
           Candidate::create($request->all());
           return Helpers::ResponseJson('OK','El candidato ha sido guardado','');
        } catch (Exception $e) {
           return Helpers::errorResponseJsonDB($e);
        }
    }

    /**
     * View the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate=Candidate::find($id);
        if(!$candidate) {
            return Helpers::ResponseJson('ERROR','No existe el usuario a actualizar','');
        }else{
            return Helpers::ResponseJson('OK','Candidato sucrito',$candidate);
        }    
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate=ValidateDataCandidate::update($request, $id);
        if($validate) return $validate;

        $candidate=Candidate::find($id);
        if(!$candidate) return Helpers::ResponseJson('ERROR','No existe el usuario a actualizar','');
        try {
           $candidate->update($request->all());
           return Helpers::ResponseJson('OK','El candidato ha sido actualizado','');
        } catch (Exception $e) {
           return Helpers::errorResponseJsonDB($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate=Candidate::find($id);
        if(!$candidate) return Helpers::ResponseJson('ERROR','No existe el usuario a eliminar','');
         try {
           $candidate->delete();
           return Helpers::ResponseJson('OK','El candidato ha sido eliminado','');
        } catch (Exception $e) {
           return Helpers::errorResponseJsonDB($e);
        }
    }    
}
