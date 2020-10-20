<?php

namespace App\Http\Controllers;

use App\FichaEpidemiologica;
use App\Establecimiento;
use App\Paciente;
use App\Menor;
use App\Relacion;
use App\Antecedente;
use App\Ocupacion;
use App\DatoClinico;
use App\Sintoma;
use App\EstadoPaciente;
use App\Diagnostico;
use App\Hospitalizacion;
use App\EnfermedadesBase;
use App\Enfermedad;
use App\Contacto;
use App\Laboratorio;
use App\Muestra;
use App\ListaMuestra;
use App\PersonalNotifica;
use App\Departamento;
use App\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Http;
use GuzzleHttp\Client;

class FichaEpidemiologicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form.buscar')->with('usu',$this->Usuario());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = array();
        $otro_cs = array();
        $cs = Http::get('http://192.168.0.104/api-project/public/api/students/'.$request->ci.'/'.$request->fecha);

        foreach ($cs->json() as $c) {
            array_push($id,$c["id_pac"]);
        }

        $array_cs = json_decode($cs);
        foreach ($array_cs as $c) {
            $otro_cs[$c->id_pac] = $c;
        }

        $find = FichaEpidemiologica::whereIn('id_pac',$id)->get();

        foreach ($find as $f) {
            $f->nombre = $otro_cs[$f->id_pac]->nombre.' '.$otro_cs[$f->id_pac]->paterno.' '.$otro_cs[$f->id_pac]->materno;
            $f->ci = $otro_cs[$f->id_pac]->ci;
            $f->fecha_nacimiento = $otro_cs[$f->id_pac]->fecha_nacimiento;
            $f->telefono = $otro_cs[$f->id_pac]->telefono;
        }

        if(count($find) > 0){
            return view('form.buscar')->with('find', $find)
                                      ->with('estado', '1')
                                      ->with('mensaje', '')
                                      ->with('usu',$this->Usuario());
        }else{
            return view('form.buscar')->with('find', $find)
                                      ->with('estado', '0')
                                      ->with('mensaje', 'No se tiene resultado para la busqueda: '.$request->ci.', '.$request->fecha)
                                      ->with('usu',$this->Usuario());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pai = Pais::Where('estado','=',true)->get();
        $dep = Departamento::where('estado','=',true)->get();
        $rel = Relacion::where('estado','=',true)->get();
        $ocu = Ocupacion::where('estado','=',true)->get();
        $sin = Sintoma::where('estado','=',true)->get();
        $est = EstadoPaciente::where('estado','=',true)->get();
        $dia = Diagnostico::where('estado','=',true)->get();
        $enf = Enfermedad::where('estado','=',true)->get();
        $mue = Muestra::where('estado','=',true)->get();

        $cs = Http::get('http://192.168.0.104/api-project/public/api/establecimiento');

        return view('form.nuevo')->with('pai',$pai)
                                 ->with('dep',$dep)
                                 ->with('rel',$rel)
                                 ->with('ocu',$ocu)
                                 ->with('sin',$sin)
                                 ->with('est',$est)
                                 ->with('dia',$dia)
                                 ->with('enf',$enf)
                                 ->with('mue',$mue)
                                 ->with('cs',$cs->json())
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
        // 3. ANTECEDENTES EPIDEMIOLOGICOS
        $ante = new Antecedente;
        if($request->id_ocu == "otro") {
            $ocu = $this->create_ocupacion($request->otro_ocupacion);
            $ante->id_ocu = $ocu;
        } else {
            $ante->id_ocu = $request->id_ocu;
        }
        $ante->vacuna_influenza = $request->vacuna_influenza;
        $ante->fecha_vacunacion = $request->fecha_vacunacion;
        $ante->viaje_riesgo = $request->viaje_riesgo;
        $ante->id_pai = $request->id_pai_antcedentes;
        $ante->ciudad = $request->ciudad_antecedentes;
        $ante->fecha_retorno = $request->fecha_retorno;
        $ante->hora_retorno = $request->hora_retorno;
        $ante->empresa_viaje = $request->empresa_viaje;
        $ante->num_vuelo = $request->num_vuelo;
        $ante->num_asiento = $request->num_asiento;
        $ante->contacto = $request->contacto_antecedentes;
        $ante->fecha_contacto = $request->fecha_contacto_antecentes;
        $ante->nombre_contacto = (is_null($request->nombre_contacto)) ? '' : $request->nombre_contacto;
        $ante->paterno_contacto = (is_null($request->paterno_contacto)) ? '' : $request->paterno_contacto;
        $ante->materno_contacto = (is_null($request->materno_contacto)) ? '' : $request->materno_contacto;
        $ante->telefono_contacto = (is_null($request->telefono_contacto)) ? '' : $request->telefono_contacto;
        $ante->pais_contacto = $request->id_pai_contacto;
        $ante->departamento_contacto = (is_null($request->departamento_contacto)) ? '' : $request->departamento_contacto;
        $ante->municipio_contacto = $request->municipio_contacto;
        $ante->ciudad_contacto = $request->ciudad_contacto;
        $ante->save();
        $id_ant = $ante->id_ant;

        // 4. DATOS CLINICOS
        $datos = new DatoClinico;
        $datos->fecha_inicio = $request->fecha_inicio;
        if(is_null($request->sintoma)) {
            $sin = 1;
        }else{
            if(in_array("otro",$request->sintoma)) {
                if(isset($request->otro_sintoma)) {
                    $otro = $this->create_sintoma($request->otro_sintoma);
                    $sin = $this->borra_elemento($request->sintoma,$otro);
                } else {
                    $sin = $this->borra_elemento($request->sintoma,"");
                }
            } else {
              $sin = $this->borra_elemento($request->sintoma,"");
            }
        }
        $datos->sintomas = $sin;
        $datos->id_est = $request->id_estado;
        if(isset($request->fecha_estado)) {
            $datos->fecha_estado = $request->fecha_estado;
        }
        if(isset($request->otro_diagnostico)) {
            $diag = $this->create_diagnostico($request->otro_diagnostico);
            $datos->id_dia = $diag;
        }else{
            $datos->id_dia = $request->id_dia;
        }

        $datos->save();
        $id_dc = $datos->id_dc;

        // 5. DATOS EN CASO DE HOSPITALIZACION Y/O ASILAMIENTO
        $hos = new Hospitalizacion;
        $hos->fecha_aislamiento = $request->fecha_aislamiento;
        $hos->lugar_aislamiento = $request->lugar_aislamiento;
        $hos->fecha_internacion = $request->fecha_internacion;
        $hos->establecimiento = $request->establecimiento_internacion;
        $hos->ventilacion = $request->ventilacion;
        $hos->terapia_intensiva = $request->terapia_intensiva;
        $hos->fecha_ingreso_uti = $request->fecha_ingreso_uti;
        $hos->save();
        $id_hos = $hos->id_hos;

        // FICHA EPIDEMIOLOGICA
        $ficha = new FichaEpidemiologica;
        $ficha->id_est = $request->id_est;
        $ficha->id_pac = $request->id_pac ;
        $ficha->id_ant = $id_ant;
        $ficha->id_dc = $id_dc;
        $ficha->id_hos = $id_hos;
        $ficha->id_lab = 1;
        $ficha->fecha_notificacion = $request->fecha_notificacion;
        $ficha->sem_epidem = $request->sem_epidem;
        $ficha->caso_identificado = $request->caso_identificado;
        $ficha->estado = 2;
        $ficha->save();
        $id_fe = $ficha->id_fe;

        // 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
        if($request->pregunta){
            if(is_null($request->id_enf)){

            }else{
                for ($i=0; $i < count($request->id_enf) ; $i++) {
                    if($request->id_enf[$i] == 'otro') {
                        $enf = $this->create_enfermedad($request->otro_enfermedad);
                        $base = new EnfermedadesBase;
                        $base->id_enf = $enf;
                        $base->id_fe = $id_fe;
                        $base->save();
                    } else {
                        $base = new EnfermedadesBase;
                        $base->id_enf = $request->id_enf[$i];
                        $base->id_fe = $id_fe;
                        $base->save();
                    }
                }
            }
        }

        // 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOPSO ESTUVO EN CONTACTO
        if(isset($request->nombre_sospechoso)){
            if(count($request->nombre_sospechoso) > 0){
                if($request->nombre_sospechoso[0] != ""){
                    $this->create_sospechoso($id_fe,$request->nombre_sospechoso,$request->paterno_sospechoso,$request->materno_sospechoso,$request->id_rel,$request->edad_sospechoso,$request->telefono_sospechoso,$request->direccion_sospechoso,$request->fecha_sospechoso,$request->lugar_sospechoso);
                }
            }
        }
        
        if($request->api) {
            return response()->json([
                "message" => "Registro Exsitoso."
            ], 200);
        } else {
            return view('form.buscar')->with('usu',$this->Usuario());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$ci,$fecha,$id_est)
    {
        $fe = FichaEpidemiologica::find($id);
        // ESTALECIMIENTO
        $establecimiento = array();
        $cs = Http::get('http://192.168.0.104/api-project/public/api/establecimiento');
        $cs = $cs->json();
        foreach ($cs as $c) {
            if ($c["id_est"] == $id_est) {
                array_push($establecimiento,$c);
            }
        }
        // PACIENTE
        $pa = Http::get('http://192.168.0.104/api-project/public/api/students/'.$ci.'/'.$fecha);
        // ANTECEDENTES EPIDEMIOLOGICOS
        $antecendentes = Antecedente::find($fe->id_ant);
        $ocupacion = Ocupacion::find($antecendentes->id_ocu);
        $pais_viaje = Pais::find($antecendentes->id_pai);
        $pais_contacto = Pais::find($antecendentes->pais_contacto);
        // DATOS CLINICOS
        $dc = DatoClinico::find($fe->id_dc);
        $s = explode(',',$dc->sintomas);
        // DATOS DE HOSPITALIZACION
        $ho = Hospitalizacion::find($fe->id_hos);
        // ENFERMEDADES DE BASE
        $eb = EnfermedadesBase::where('id_fe',$id)->get();
        if(count($eb) > 0) {
            $enfermedad = explode(',',$eb->id_enf);
        } else {
            $enfermedad = array();
        }
        // PERSONAS CONTACTO
        $co = Contacto::join('relacion','relacion.id_rel','=','contactos.id_rel')->where('id_fe','=',$id)->get();
        // EXTRAS
        $ocu = Ocupacion::where('estado','=',true)->get();
        $pai = Pais::Where('estado','=',true)->get();
        $sin = Sintoma::where('estado','=',true)->get();
        $est = EstadoPaciente::where('estado','=',true)->get();
        $dia = Diagnostico::where('estado','=',true)->get();
        $enf = Enfermedad::where('estado','=',true)->get();
        $rel = Relacion::where('estado','=',true)->get();
        $dep = Departamento::where('estado','=',true)->get();
        return view('form.editar')->with('fe',$fe)
                                  ->with('cs',$establecimiento)
                                  ->with('pa',$pa->json())
                                  ->with('antecendentes',$antecendentes)
                                  ->with('ocupacion',$ocupacion)
                                  ->with('pais_viaje',$pais_viaje)
                                  ->with('pais_contacto',$pais_contacto)
                                  ->with('dc',$dc)
                                  ->with('sintoma',$s)
                                  ->with('ho',$ho)
                                  ->with('eb',$eb)
                                  ->with('enfermedad',$enfermedad)
                                  ->with('co',$co)
                                  ->with('ocu',$ocu)
                                  ->with('pai',$pai)
                                  ->with('sin',$sin)
                                  ->with('est',$est)
                                  ->with('dia',$dia)
                                  ->with('enf',$enf)
                                  ->with('rel',$rel)
                                  ->with('dep',$dep)
                                  ->with('usu',$this->Usuario());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        // 3. ANTECEDENTES EPIDEMIOLOGICOS
        $ante = Antecedente::find($request->id_ant);
        if($request->id_ocu == "otro") {
            $ocu = $this->create_ocupacion($request->otro_ocupacion);
            $ante->id_ocu = $ocu;
        } else {
            $ante->id_ocu = $request->id_ocu;
        }
        $ante->vacuna_influenza = $request->vacuna_influenza;
        $ante->fecha_vacunacion = $request->fecha_vacunacion;
        $ante->viaje_riesgo = $request->viaje_riesgo;
        $ante->id_pai = $request->id_pai_antcedentes;
        $ante->ciudad = $request->ciudad_antecedentes;
        $ante->fecha_retorno = $request->fecha_retorno;
        $ante->hora_retorno = $request->hora_retorno;
        $ante->empresa_viaje = $request->empresa_viaje;
        $ante->num_vuelo = $request->num_vuelo;
        $ante->num_asiento = $request->num_asiento;
        $ante->contacto = $request->contacto_antecedentes;
        $ante->fecha_contacto = $request->fecha_contacto_antecentes;
        $ante->nombre_contacto = (is_null($request->nombre_contacto)) ? '' : $request->nombre_contacto;
        $ante->paterno_contacto = (is_null($request->paterno_contacto)) ? '' : $request->paterno_contacto;
        $ante->materno_contacto = (is_null($request->materno_contacto)) ? '' : $request->materno_contacto;
        $ante->telefono_contacto = (is_null($request->telefono_contacto)) ? '' : $request->telefono_contacto;
        $ante->pais_contacto = $request->id_pai_contacto;
        $ante->departamento_contacto = (is_null($request->departamento_contacto)) ? '' : $request->departamento_contacto;
        $ante->municipio_contacto = $request->municipio_contacto;
        $ante->ciudad_contacto = $request->ciudad_contacto;
        $ante->save();
        $id_ant = $ante->id_ant;

        // 4. DATOS CLINICOS
        $datos = DatoClinico::find($request->id_dc);
        $datos->fecha_inicio = $request->fecha_inicio;
        if(is_null($request->sintoma)) {
            $sin = 1;
        }else{
            if(in_array("otro",$request->sintoma)) {
                if(isset($request->otro_sintoma)) {
                    $otro = $this->create_sintoma($request->otro_sintoma);
                    $sin = $this->borra_elemento($request->sintoma,$otro);
                } else {
                    $sin = $this->borra_elemento($request->sintoma,"");
                }
            } else {
              $sin = $this->borra_elemento($request->sintoma,"");
            }
        }
        $datos->sintomas = $sin;
        $datos->id_est = $request->id_estado;
        if(isset($request->fecha_estado)) {
            $datos->fecha_estado = $request->fecha_estado;
        }
        if(isset($request->otro_diagnostico)) {
            $diag = $this->create_diagnostico($request->otro_diagnostico);
            $datos->id_dia = $diag;
        }else{
            $datos->id_dia = $request->id_dia;
        }

        $datos->save();
        $id_dc = $datos->id_dc;

        // 5. DATOS EN CASO DE HOSPITALIZACION Y/O ASILAMIENTO
        $hos = Hospitalizacion::find($request->id_hos);
        $hos->fecha_aislamiento = $request->fecha_aislamiento;
        $hos->lugar_aislamiento = $request->lugar_aislamiento;
        $hos->fecha_internacion = $request->fecha_internacion;
        $hos->establecimiento = $request->establecimiento_internacion;
        $hos->ventilacion = $request->ventilacion;
        $hos->terapia_intensiva = $request->terapia_intensiva;
        $hos->fecha_ingreso_uti = $request->fecha_ingreso_uti;
        $hos->save();
        $id_hos = $hos->id_hos;

        // 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
        if($request->pregunta){
            if(is_null($request->id_enf)){

            }else{
                for ($i=0; $i < count($request->id_enf) ; $i++) {
                    if($request->id_enf[$i] == 'otro') {
                        $enf = $this->create_enfermedad($request->otro_enfermedad);
                        $base = new EnfermedadesBase;
                        $base->id_enf = $enf;
                        $base->id_fe = $id_fe;
                        $base->save();
                    } else {
                        $base = new EnfermedadesBase;
                        $base->id_enf = $request->id_enf[$i];
                        $base->id_fe = $id_fe;
                        $base->save();
                    }
                }
            }
        }

        // 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOPSO ESTUVO EN CONTACTO
        if(isset($request->nombre_sospechoso)){
            if(count($request->nombre_sospechoso) > 0){
                if($request->nombre_sospechoso[0] != ""){
                    $this->create_sospechoso($request->id_fe,$request->nombre_sospechoso,$request->paterno_sospechoso,$request->materno_sospechoso,$request->id_rel,$request->edad_sospechoso,$request->telefono_sospechoso,$request->direccion_sospechoso,$request->fecha_sospechoso,$request->lugar_sospechoso);
                }
            }
        }

        // 1. DATOS ESTABLECIMIENTO NOTIFICADOR
        $ficha = FichaEpidemiologica::find($request->id_fe);
        $ficha->fecha_notificacion = $request->fecha_notificacion;
        $ficha->sem_epidem = $request->sem_epidem;
        $ficha->caso_identificado = $request->caso_identificado;
        $ficha->save();
        
        return view('form.buscar')->with('usu',$this->Usuario());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('form.confirma')->with('id', $id)->with('usu',$this->Usuario());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $eb = EnfermedadesBase::where('id_fe','=',$request->id)->delete();

        $con = Contacto::where('id_fe','=',$request->id)->delete();

        $lab = Laboratorio::where('id_fe','=',$request->id)->delete();

        $fe = FichaEpidemiologica::find($request->id);
        $fe->delete();

        return view('form.buscar')->with('usu',$this->Usuario());
    }

    /**
     * Create row the Sintomas
     *
     */
    public function create_sintoma($sintoma)
    {
        $sin = new Sintoma;
        $sin->sintoma = $sintoma;
        $sin->estado = true;
        $sin->save();
        $id = $sin->id_sin;
        return $id;
    }

    public function borra_elemento($lista,$otro)
    {
        if(($clave = array_search("otro",$lista)) !== false) {
            unset($lista[$clave]);
        }

        if($otro != "") {
            if(count($lista) > 0){
                $resultado = implode(",",$lista).",".$otro;
            } else {
                $resultado = $otro;
            }
        } else {
            $resultado = implode(",",$lista);
        }
        return $resultado;
    }

    public function create_diagnostico($diagnostico)
    {
        $diag = new Diagnostico;
        $diag->diagnostico = $diagnostico;
        $diag->estado = true;
        $diag->save();
        $id_dia = $diag->id_dia;
        return $id_dia;
    }

    public function create_ocupacion($ocupacion)
    {
        $ocu = new Ocupacion;
        $ocu->ocupacion = $ocupacion;
        $ocu->estado = true;
        $ocu->save();
        $id_ocu = $ocu->id_ocu;
        return $id_ocu;
    }

    public function create_enfermedad($enfermedad)
    {
        $enf = new Enfermedad;
        $enf->enfermedad = $enfermedad;
        $enf->estado = true;
        $enf->save();
        $id_enf = $enf->id_enf;
        return $id_enf;
    }

    public function create_sospechoso($id_fe,$nombre,$paterno,$materno,$relacion,$edad,$telefono,$direccion,$fecha,$lugar)
    {
        for ($i=0; $i < count($nombre) ; $i++) {
            $conta = new Contacto;
            $conta->id_fe = $id_fe;
            $conta->nombre_contacto = $nombre[$i];
            $conta->paterno_contacto = $paterno[$i];
            $conta->materno_contacto = $materno[$i];
            $conta->id_rel = $relacion[$i];
            $conta->edad = $edad[$i];
            $conta->telefono = $telefono[$i];
            $conta->direccion = $direccion[$i];
            $conta->fecha_contacto = $fecha[$i];
            $conta->lugar_contacto = $lugar[$i];
            $conta->save();
        }
    }

    public function pantalla_imprimir($id){
        return view('imprimir.mensaje')->with('id',$id)->with('usu',$this->Usuario());
    }

    public function imprimir($id,$ci,$fecha,$id_est)
    {
        $fe = FichaEpidemiologica::find($id);
        // ESTALECIMIENTO
        $establecimiento = array();
        $cs = Http::get('http://192.168.0.104/api-project/public/api/establecimiento');
        $cs = $cs->json();
        foreach ($cs as $c) {
            if ($c["id_est"] == $id_est) {
                array_push($establecimiento,$c);
            }
        }
        // PACIENTE
        $pa = Http::get('http://192.168.0.104/api-project/public/api/students/'.$ci.'/'.$fecha);

        /* $dep = Departamento::where('id_dep','=',$identificacion[0]->id_dep)
                           ->select('departamento')
                           ->get(); */

        /* $identificacion[0]->id_dep = $dep[0]->departamento; */

        /* $menor = Menor::join('relacion','relacion.id_rel','=','menores.id_rel')
                      ->select('relacion','nombre_relacion','paterno_relacion','materno_relacion','tel_cel')
                      ->where('menores.id_pac','=',$identificacion[0]->id_pac)
                      ->get(); */

        $antecendentes = Antecedente::join('ocupaciones','ocupaciones.id_ocu','=','antecedentes.id_ocu')
                                    ->select('ocupacion','vacuna_influenza','fecha_vacunacion','viaje_riesgo','id_pai','ciudad','fecha_retorno','hora_retorno','empresa_viaje','num_vuelo','num_asiento','contacto','fecha_contacto','nombre_contacto','paterno_contacto','materno_contacto','telefono_contacto','pais_contacto','departamento_contacto','municipio_contacto','ciudad_contacto')
                                    ->where('id_ant','=',$fe->id_ant)
                                    ->get();

        $pai = Pais::where('id_pai','=',$antecendentes[0]->id_pai)->select('pais')->get();
        $antecendentes[0]->id_pai = $pai[0]->pais;
        $pai = Pais::where('id_pai','=',$antecendentes[0]->pais_contacto)->select('pais')->get();
        $antecendentes[0]->pais_contacto = $pai[0]->pais;

        $dato = DatoClinico::join('estados_pacientes','estados_pacientes.id_est','=','datos_clinicos.id_est')
                           ->join('diagnosticos','diagnosticos.id_dia','=','datos_clinicos.id_dia')
                           ->select('fecha_inicio','sintomas','nombre','fecha_estado','diagnostico')
                           ->where('datos_clinicos.id_dc','=',$fe->id_dc)
                           ->get();

        $s = explode(",",$dato[0]->sintomas);
        $sintoma = Sintoma::whereIn('id_sin',$s)->select('sintoma')->get();

        $hospitalizacion = Hospitalizacion::where('id_hos','=',$fe->id_hos)->get();

        $enf_base = EnfermedadesBase::join('enfermedades','enfermedades.id_enf','=','enfermedades_base.id_enf')
                                    ->where('id_fe','=',$fe->id_fe)->select('enfermedad')
                                    ->get();

        $cont = Contacto::join('relacion','relacion.id_rel','=','contactos.id_rel')
                        ->select('nombre_contacto','paterno_contacto','materno_contacto','relacion','edad','telefono','direccion','fecha_contacto','lugar_contacto')
                        ->where('id_fe','=',$fe->id_fe)
                        ->get();

        $laboratorio = Laboratorio::where('id_lab','=',$fe->id_lab)
                          ->select("id_pn","id_mue","muestra",'lugar_muestra','nombre_laboratorio','fecha_muestra','fecha_envio','responsable_muestra','observaciones','resultado_laboratorio','fecha_resultado')
                          ->get();

        if(count($laboratorio) > 0){
            $muestra = Muestra::where('id_mue','=',$laboratorio[0]->id_mue)
                              ->select('muestra')
                              ->get();
        }else{
            $muestra = array();
        }
                          

        $personal = PersonalNotifica::where('id_pn','=',$laboratorio[0]->id_pn)->get();

        $pdf = \PDF::loadView('imprimir.ficha_epidemiologica', array(
                                                                     'fe' => $fe,
                                                                     'est' => $establecimiento,
                                                                     'iden' => $pa->json(),
                                                                     //'men' => $menor,
                                                                     'ant' => $antecendentes,
                                                                     'dat' => $dato,
                                                                     'sin' => $sintoma,
                                                                     'hos' => $hospitalizacion,
                                                                     'enf' => $enf_base,
                                                                     'cont' => $cont,
                                                                     'lab' => $laboratorio,
                                                                     'mue' => $muestra,
                                                                     'per' => $personal
                                                                    ));
        return $pdf->stream('FichaEpidemiologica.pdf');
    }

    public function certificado($id,$id_lab,$ci,$fecha)
    {
        $paciente = Http::get('http://192.168.0.104/api-project/public/api/students/'.$ci.'/'.$fecha);
        $lab = Laboratorio::join('muestras','muestras.id_mue','=','laboratorios.id_mue')
                          ->select('laboratorios.id_lab','laboratorios.id_pn','muestras.id_mue','fecha_muestra','resultado_laboratorio','fecha_resultado','fecha_impresion','numero')
                          ->where('laboratorios.id_lab','=',$id_lab)
                          ->get();
        $fi = $this->fecha($id_lab);
        $reporte = PersonalNotifica::where('id_pn','=',$lab[0]->id_pn)->get();
        $pdf = \PDF::loadView('imprimir.certificado', array('pac' => $paciente->json(), 'lab' => $lab, 'reporte' => $reporte, 'fi' => $fi));
        return $pdf->stream('Certificado.pdf');
    }

    public function fecha($id_lab)
    {
        $find = Laboratorio::where('id_lab','=',$id_lab)
                           ->select('fecha_impresion')
                           ->get();
        if(is_null($find[0]->fecha_impresion)){
            $nue = Laboratorio::find($id_lab);
            $nue->fecha_impresion = date("Y")."-".date("m")."-".date("d");
            $nue->save();
            return $nue->fecha_impresion;
        } else {
            return $find[0]->fecha_impresion;
        }
    }

    public function certificado_medico($id_fe,$ci,$fecha)
    {
        $fe = FichaEpidemiologica::find($id_fe);
        $paciente = Http::get('http://192.168.0.104/api-project/public/api/students/'.$ci.'/'.$fecha);
        $lab = Laboratorio::join('personal_notificado','personal_notificado.id_pn','=','laboratorios.id_pn')
                          ->where('laboratorios.id_lab','=',$fe->id_lab)
                          ->select('nombre_notifica','paterno_notifica','materno_notifica','matricula_profesional')
                          ->get();
        $dc = DatoClinico::select('sintomas')
                              ->where('id_dc','=',$fe->id_dc)
                              ->get();
        $filtro = explode(",",$dc[0]->sintomas);
        $sintoma = Sintoma::whereIn('id_sin',$filtro)->select('sintoma')->get();
        $pdf = \PDF::loadView('imprimir.certificado_medico', array('pac' => $paciente->json(), 'lab' => $lab, 'sin' => $sintoma));
        return $pdf->stream('CertificadoMedico.pdf');
    }

    public function Usuario()
    {
        $usu = PersonalNotifica::where('id','=',\Auth::user()->id)
                               ->select('id_pn','nombre_notifica','paterno_notifica','materno_notifica')
                               ->get();
        return $usu;
    }

    public function web_fichaEpidemiologica(Request $request)
    {
        // 3. ANTECEDENTES EPIDEMIOLOGICOS
        $ante = new Antecedente;
        if($request->id_ocu == "otro") {
            $ocu = $this->create_ocupacion($request->otro_ocupacion);
            $ante->id_ocu = $ocu;
        } else {
            $ante->id_ocu = $request->id_ocu;
        }
        $ante->vacuna_influenza = $request->vacuna_influenza;
        $ante->fecha_vacunacion = $request->fecha_vacunacion;
        $ante->viaje_riesgo = $request->viaje_riesgo;
        $ante->id_pai = $request->id_pai_antcedentes;
        $ante->ciudad = $request->ciudad_antecedentes;
        $ante->fecha_retorno = $request->fecha_retorno;
        $ante->hora_retorno = $request->hora_retorno;
        $ante->empresa_viaje = $request->empresa_viaje;
        $ante->num_vuelo = $request->num_vuelo;
        $ante->num_asiento = $request->num_asiento;
        $ante->contacto = $request->contacto_antecedentes;
        $ante->fecha_contacto = $request->fecha_contacto_antecentes;
        $ante->nombre_contacto = (is_null($request->nombre_contacto)) ? '' : $request->nombre_contacto;
        $ante->paterno_contacto = (is_null($request->paterno_contacto)) ? '' : $request->paterno_contacto;
        $ante->materno_contacto = (is_null($request->materno_contacto)) ? '' : $request->materno_contacto;
        $ante->telefono_contacto = (is_null($request->telefono_contacto)) ? '' : $request->telefono_contacto;
        $ante->pais_contacto = $request->id_pai_contacto;
        $ante->departamento_contacto = (is_null($request->departamento_contacto)) ? '' : $request->departamento_contacto;
        $ante->municipio_contacto = $request->municipio_contacto;
        $ante->ciudad_contacto = $request->ciudad_contacto;
        $ante->save();
        $id_ant = $ante->id_ant;

        // 4. DATOS CLINICOS
        $datos = new DatoClinico;
        $datos->fecha_inicio = $request->fecha_inicio;
        if($request->sintoma == '') {
            $sin = 1;
        }else{
            if(in_array("otro",$request->sintoma)) {
                if(isset($request->otro_sintoma)) {
                    $otro = $this->create_sintoma($request->otro_sintoma);
                    $sin = $this->borra_elemento($request->sintoma,$otro);
                } else {
                    $sin = $this->borra_elemento($request->sintoma,"");
                }
            } else {
              $sin = $this->borra_elemento($request->sintoma,"");
            }
        }
        $datos->sintomas = $sin;
        $datos->id_est = $request->id_estado;
        if(isset($request->fecha_estado)) {
            $datos->fecha_estado = $request->fecha_estado;
        }
        if(isset($request->otro_diagnostico)) {
            $diag = $this->create_diagnostico($request->otro_diagnostico);
            $datos->id_dia = $diag;
        }else{
            $datos->id_dia = $request->id_dia;
        }

        $datos->save();
        $id_dc = $datos->id_dc;

        // 5. DATOS EN CASO DE HOSPITALIZACION Y/O ASILAMIENTO
        $hos = new Hospitalizacion;
        $hos->save();
        $id_hos = $hos->id_hos;

        // 8. LABORATORIO
        $lab = new Laboratorio;
        $lab->id_pn = 1;
        $lab->id_mue = 1;
        $lab->numero = 1;
        $lab->save();
        $id_lab = $lab->id_lab;

        // FICHA EPIDEMIOLOGICA
        $ficha = new FichaEpidemiologica;
        $ficha->id_est = $request->id_est;
        $ficha->id_pac = $request->id_pac ;
        $ficha->id_ant = $id_ant;
        $ficha->id_dc = $id_dc;
        $ficha->id_hos = $id_hos;
        $ficha->id_lab = $id_lab;
        $ficha->fecha_notificacion = $request->fecha_notificacion;
        $ficha->sem_epidem = $request->sem_epidem;
        $ficha->caso_identificado = $request->caso_identificado;
        $ficha->estado = 1;
        $ficha->save();
        $id_fe = $ficha->id_fe;

        return response()->json([
            "message" => "Registro Exitoso."
        ], 200);
    }
}
