<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratorio;
use App\FichaEpidemiologica;
use App\Paciente;
use App\ListaMuestra;
use App\Muestra;
use App\Relacion;
use App\Menor;
use App\Departamento;
USE App\PersonalNotifica;
use Http;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $find = FichaEpidemiologica::join('pacientes','pacientes.id_pac','=','ficha_epidemiologica.id_pac')
                                   ->where('ficha_epidemiologica.id_fe','=',$id)
                                   ->select('ficha_epidemiologica.id_fe','pacientes.id_pac','nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes','sexo','ci','expedido','fecha_nac','edad','calle','zona','num','telefono')
                                   ->get();
        $dep = Departamento::where('id_dep','=',$find[0]->expedido)
                                   ->select('departamento')
                                   ->get();
        $mue = Muestra::where('estado','=',true)->get();
        $menor = Menor::where('id_pac','=',$find[0]->id_pac)
                      ->select('id_pac')
                      ->get();
        $lab = Laboratorio::join('muestras','muestras.id_mue','=','laboratorios.id_mue')
                          ->where('id_fe','=',$id)
                          ->select('id_lab','muestras.muestra','fecha_muestra','fecha_envio','responsable_muestra','resultado_laboratorio','fecha_resultado')
                          ->orderBy('numero','ASC')
                          ->get();
        
        return view('laboratorio.buscar')->with('find',$find)
                                         ->with('dep',$dep)
                                         ->with('mue',$mue)
                                         ->with('menor',$menor)
                                         ->with('lab',$lab)
                                         ->with('id',$id)
                                         ->with('usu',$this->Usuario());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $find = Laboratorio::join('ficha_epidemiologica','ficha_epidemiologica.id_fe','=','laboratorios.id_fe')
                           ->join('pacientes','pacientes.id_pac','=','pacientes.id_pac')
                           ->where(DB::raw('CONCAT(nombre_pacientes," ",paterno.pacientes," ",materno.pacientes)','like','%%'))
                           ->gert();
        return view('laboratorio.buscar')->with('usu',$this->Usuario());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $find = FichaEpidemiologica::join('pacientes','pacientes.id_pac','=','ficha_epidemiologica.id_pac')
                                   ->where('ficha_epidemiologica.id_fe','=',$id)
                                   ->select('ficha_epidemiologica.id_fe','pacientes.id_pac','nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes','sexo','ci','expedido','fecha_nac','edad','calle','zona','num','telefono')
                                   ->get();
        $dep = Departamento::where('id_dep','=',$find[0]->expedido)
                           ->select('departamento')
                           ->get();
        $mue = Muestra::where('estado','=',true)->get();
        $menor = Menor::where('id_pac','=',$find[0]->id_pac)
                      ->select('id_pac')
                      ->get();
        return view('laboratorio.nuevo')->with('find',$find)
                                        ->with('dep',$dep)
                                        ->with('mue',$mue)
                                        ->with('menor',$menor)
                                        ->with('usu',$this->Usuario());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find = new Laboratorio;
        $find->id_fe = $request->id_fe;
        $find->id_pn = $this->UsuarioID();
        $find->muestra = $request->muestra_laboratorio;
        $find->lugar_muestra = $request->lugar_muestra;
        $find->id_mue = $request->id_mue;
        $find->nombre_laboratorio = $request->nombre_laboratorio;
        $find->fecha_muestra = $request->fecha_muestra;
        $find->fecha_envio = $request->fecha_envio;
        $find->responsable_muestra = $request->responsable_muestra;
        $find->observaciones = $request->observaciones;
        $find->resultado_laboratorio = $request->resultado_muestra;
        $find->fecha_resultado = $request->fecha_resultado;
        $find->numero = $this->numero($request->id_fe);
        $find->save();
        $id_lab = $find->id_lab;

        if($request->id_mue == 'otro'){
            if(isset($request->otro_muestra)){
                $mue = $this->create_muestra($request->otro_muestra);
                $this->lista_muestra($id_lab,$mue);
            }
        } else {
          $this->lista_muestra($id_lab,$request->id_mue);
        }

        // DATOS PERSONAL QUE NOTIFICA
        /* $personal = new PersonalNotifica;
        $personal->id_lab = $id_lab;
        $personal->nombre_notifica = $request->nombre_personal;
        $personal->paterno_notifica = $request->paterno_personal;
        $personal->materno_notifica = $request->materno_personal;
        $personal->tel_cel_notifica = $request->tel_cel_personal;
        $personal->save();
        $id_pn = $personal->id_pn; */

        return redirect('laboratorio/buscar/'.$request->id_fe)->with('usu',$this->Usuario());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$ci,$fecha,$id_est)
    {
        $fe = FichaEpidemiologica::find($id);
        $lab = Laboratorio::find($fe->id_lab);
        $find = Http::get('http://192.168.0.104/api-project/public/api/students/'.$ci.'/'.$fecha);
        $mue = Muestra::where('estado','=',true)->get();
        return view('laboratorio.editar')->with('find',$find->json())
                                         ->with('mue',$mue)
                                         ->with('id',$id)
                                         ->with('estado',$fe->estado)
                                         ->with('id_fe',$fe->id_fe)
                                         ->with('lab',$lab)
                                         ->with('ci',$ci)
                                         ->with('fecha',$fecha)
                                         ->with('usu',$this->Usuario());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fe = FichaEpidemiologica::find($request->id_fe);
        $fe->estado = 3;
        $fe->save();
        $find = Laboratorio::find($fe->id_lab);
        $find->muestra = $request->muestra_laboratorio;
        $find->lugar_muestra = $request->lugar_muestra;
        $find->nombre_laboratorio = $request->nombre_laboratorio;
        $find->fecha_muestra = $request->fecha_muestra;
        $find->fecha_envio = $request->fecha_envio;
        $find->responsable_muestra = $request->responsable_muestra;
        $find->observaciones = $request->observaciones;
        $find->resultado_laboratorio = $request->resultado_muestra;
        $find->fecha_resultado = $request->fecha_resultado;
        $find->save();
        return view('form.buscar')->with('usu',$this->Usuario()); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('laboratorio.confirma')->with('id',$id)->with('usu',$this->Usuario());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Laboratorio::find($id);
        $find->delete();
        return view('laboratorio.buscar')->with('usu',$this->Usuario());
    }

    public function create_muestra($muestra) {
        $mue = new Muestra;
        $mue->muestra = $muestra;
        $mue->estado = true;
        $mue->save();
        return $mue->id_mue;
    }

    public function lista_muestra($id_lab,$muestra) {
        $lista = new ListaMuestra;
        $lista->id_lab = $id_lab;
        $lista->id_mue = $muestra;
        $lista->save();
    }

    public function numero($id) {
        $find = Laboratorio::where('id_fe','=',$id)
                           ->orderBy('numero','DESC')
                           ->take(1)
                           ->select('numero')
                           ->get();
        if(count($find) > 0){
            return $find[0]->numero + 1;
        } else {
            return 1;
        }
    }

    public function Usuario()
    {
        $usu = PersonalNotifica::where('id','=',\Auth::user()->id)
                               ->select('id_pn','nombre_notifica','paterno_notifica','materno_notifica')
                               ->get();
        return $usu;
    }

    public function UsuarioID()
    {
        $usu = PersonalNotifica::where('id','=',\Auth::user()->id)
                               ->select('id_pn')
                               ->get();
        return $usu[0]->id_pn;
    }
}
