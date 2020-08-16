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


class FichaEpidemiologicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function show(FichaEpidemiologica $fichaEpidemiologica)
    {
        //
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

        return view('form.nuevo')->with('pai',$pai)
                                 ->with('dep',$dep)
                                 ->with('rel',$rel)
                                 ->with('ocu',$ocu)
                                 ->with('sin',$sin)
                                 ->with('est',$est)
                                 ->with('dia',$dia)
                                 ->with('enf',$enf)
                                 ->with('mue',$mue);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // 1. TABLA ESTABLECIMIENTO
        $establecimiento = new Establecimiento;
        $establecimiento->establecimiento = $request->establecimiento;
        $establecimiento->codigo = $request->codigo;
        $establecimiento->red = $request->red;
        $establecimiento->departamento = $request->departamento;
        $establecimiento->municipio = $request->municipio;
        $establecimiento->fecha_notificacion = $request->fecha_notificacion;
        $establecimiento->sem_epidem = $request->sem_epidem;
        $establecimiento->caso_identificado = $request->caso_identificado;
        $establecimiento->save();
        $id_est = $establecimiento->id_est;
        

        // 2. IDENTIFICACION DEL CASO / PACIENTE
        $paciente = new Paciente;
        $paciente->nombre_pacientes = $request->nombre_pacientes;
        $paciente->paterno_pacientes = $request->paterno_pacientes;
        $paciente->materno_pacientes = $request->materno_pacientes;
        $paciente->seguro_pacientes = $request->seguro_pacientes;
        $paciente->sexo = $request->sexo;
        $paciente->ci = $request->ci;
        $paciente->expedido = $request->expedido;
        $paciente->fecha_nac = $request->fecha_nac;
        $paciente->edad = $request->edad_pacientes;
        $paciente->id_dep = $request->id_dep_pacientes;
        $paciente->municipio_paciente = $request->municipio_paciente;
        $paciente->id_pai = $request->id_pai_pacientes;
        $paciente->calle = $request->calle;
        $paciente->zona = $request->zona;
        $paciente->num = $request->num;
        $paciente->telefono = $request->telefono_pacientes;
        $paciente->save();
        $id_pac = $paciente->id_pac;

        if ($request->menor) {
            $menor = new Menor;
            $menor->id_pac = $id_pac;
            $menor->id_rel = $request->id_rel_pacientes;
            $menor->nombre_relacion = $request->nombre_relacion;
            $menor->paterno_relacion = $request->paterno_relacion;
            $menor->materno_relacion = $request->materno_relacion;
            $menor->tel_cel = $request->tel_cel_pacientes;
            $menor->save();
        }

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
        $ante->departamento_contacto = $request->departamento_contacto;
        $ante->municipio_contacto = $request->municipio_contacto;
        $ante->ciudad_contacto = $request->ciudad_contacto;
        $ante->save();
        $id_ant = $ante->id_ant;

        // 4. DATOS CLINICOS
        $datos = new DatoClinico;
        $datos->fecha_inicio = $request->fecha_inicio;
        if(in_array("otro",$request->sintoma)) {
            if(isset($request->otro_sintoma)) {
                $otro = $this->create_sintoma($request->otro_sintoma);
                $sin = $this->borra_elemento($request->sintoma,$otro);
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

        // 5. DATOS EN CADO DE HOSPITALIZACION Y/O ASILAMIENTO
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

        // DATOS PERSONAL QUE NOTIFICA
        $personal = new PersonalNotifica;
        $personal->nombre_notifica = $request->nombre_personal;
        $personal->paterno_notifica = $request->paterno_personal;
        $personal->materno_notifica = $request->materno_personal;
        $personal->tel_cel_notifica = $request->tel_cel_personal;
        $personal->save();
        $id_pn = $personal->id_pn;

        // FICHA EPIDEMIOLOGICA
        $ficha = new FichaEpidemiologica;
        $ficha->id_est = $id_est;
        $ficha->id_pac = $id_pac ;
        $ficha->id_ant = $id_ant;
        $ficha->id_dc = $id_dc;
        $ficha->id_hos = $id_hos;
        $ficha->id_pn = $id_pn;
        $ficha->save();
        $id_fe = $ficha->id_fe;

        // 6. ENFERMEDADES DE BASE O CONFICIONES DE RIESGO
        if($request->pregunta){
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

        // 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOPSO ESTUVO EN CONTACTO
        if(isset($request->nombre_sospechoso)){
            if(count($request->nombre_sospechoso) > 0){
                if($request->nombre_sospechoso[0] != ""){
                    $this->create_sospechoso($id_fe,$request->nombre_sospechoso,$request->paterno_sospechoso,$request->materno_sospechoso,$request->id_rel,$request->edad_sospechoso,$request->telefono_sospechoso,$request->direccion_sospechoso,$request->fecha_sospechoso,$request->lugar_sospechoso);
                }
            }
        }

        // 8. LABORATORIO
        $lab = new Laboratorio;
        $lab->id_fe = $id_fe;
        $lab->muestra = $request->muestra_laboratorio;
        $lab->lugar_muestra = $request->lugar_muestra;
        $lab->nombre_laboratorio = $request->nombre_laboratorio;
        $lab->fecha_muestra = $request->fecha_muestra;
        $lab->fecha_envio = $request->fecha_envio;
        $lab->responsable_muestra = $request->responsable_muestra;
        $lab->observaciones = $request->observaciones;
        $lab->resultado_laboratorio = $request->resultado_muestra;
        $lab->fecha_resultado = $request->fecha_resultado;
        $lab->save();
        $id_lab = $lab->id_lab;

        if($request->id_mue == 'otro'){
            if(isset($request->otro_muestra)){
                $mue = $this->create_muestra($request->otro_muestra);
                
                $lismue = new ListaMuestra;
                $lismue->id_lab = $id_lab;
                $lismue->id_mue = $mue;
                $lismue->save();
            }
        }        

        //return view('template.inicio');
        return redirect()->route('imprimir/'.$id_fe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaEpidemiologica $fichaEpidemiologica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaEpidemiologica $fichaEpidemiologica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FichaEpidemiologica  $fichaEpidemiologica
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaEpidemiologica $fichaEpidemiologica)
    {
        //
    }

    /**
     * Create row the Sintomas
     * 
     */
    public function create_sintoma($sintoma){
        $sin = new Sintoma;
        $sin->sintoma = $sintoma;
        $sin->estado = true;
        $sin->save();
        $id = $sin->id_sin;
        return $id;
    }

    public function borra_elemento($lista,$otro) {
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

    public function create_diagnostico($diagnostico) {
        $diag = new Diagnostico;
        $diag->diagnostico = $diagnostico;
        $diag->estado = true;
        $diag->save();
        $id_dia = $diag->id_dia;
        return $id_dia;
    }

    public function create_ocupacion($ocupacion) {
        $ocu = new Ocupacion;
        $ocu->ocupacion = $ocupacion;
        $ocu->estado = true;
        $ocu->save();
        $id_ocu = $ocu->id_ocu;
        return $id_ocu;
    }

    public function create_enfermedad($enfermedad) {
        $enf = new Enfermedad;
        $enf->enfermedad = $enfermedad;
        $enf->estado = true;
        $enf->save();
        $id_enf = $enf->id_enf;
        return $id_enf;
    }

    public function create_sospechoso($id_fe,$nombre,$paterno,$materno,$relacion,$edad,$telefono,$direccion,$fecha,$lugar) {
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

    public function create_muestra($muestra) {
        $mue = new Muestra;
        $mue->muestra = $muestra;
        $mue->estado = true;
        $mue->save();
        return $mue->id_mue;
    }

    public function pantalla_imprimir($id){
        return view('imprimir.mensaje')->with('id',$id);
    }

    public function imprimir($id) {
        $fe = FichaEpidemiologica::find($id);

        $establecimiento = Establecimiento::join('departamentos_estados','departamentos_estados.id_dep','=','establecimientos.departamento')
                                          ->select('establecimiento','codigo','red','departamentos_estados.departamento','municipio','fecha_notificacion','sem_epidem','caso_identificado')
                                          ->where('establecimientos.id_est','=',$fe->id_est)
                                          ->get();
                                
        $identificacion = Paciente::join('departamentos_estados','departamentos_estados.id_dep','=','pacientes.expedido')
                                  ->join('paises','paises.id_pai','=','pacientes.id_pai')
                                  ->select('pacientes.id_pac','nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes','sexo','ci','departamentos_estados.departamento','fecha_nac','edad','pacientes.id_dep','municipio_paciente','paises.pais','calle','zona','num','telefono')
                                  ->where('pacientes.id_pac','=',$fe->id_pac)
                                  ->get();
        
        $dep = Departamento::where('id_dep','=',$identificacion[0]->id_dep)
                           ->select('departamento')
                           ->get();
        
        $identificacion[0]->id_dep = $dep[0]->departamento;

        $menor = Menor::join('relacion','relacion.id_rel','=','menores.id_rel')
                      ->select('relacion','nombre_relacion','paterno_relacion','materno_relacion','tel_cel')
                      ->where('menores.id_pac','=',$identificacion[0]->id_pac)
                      ->get();

        $antecendentes = Antecedente::join('ocupaciones','ocupaciones.id_ocu','=','antecedentes.id_ocu')
                                    ->select('ocupacion','vacuna_influenza','fecha_vacunacion','viaje_riesgo','id_pai','ciudad','fecha_retorno','hora_retorno','empresa_viaje','num_vuelo','num_asiento','contacto','fecha_contacto','nombre_contacto','paterno_contacto','materno_contacto','telefono_contacto','pais_contacto','departamento_contacto','municipio_contacto','ciudad_contacto')
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

        $laboratorio = Laboratorio::where('id_fe','=',$fe->id_fe)
                          ->select("muestra",'lugar_muestra','nombre_laboratorio','fecha_muestra','fecha_envio','responsable_muestra','observaciones','resultado_laboratorio','fecha_resultado')
                          ->get();
        
        $muestra = Muestra::join('listas_muestras','listas_muestras.id_mue','=','muestras.id_mue')
                          ->where('listas_muestras.id_lab','=',$laboratorio[0]->id_lab)
                          ->select('muestra')
                          ->get();

        $personal = PersonalNotifica::where('id_pn','=',$fe->id_pn)->get();
        
        $pdf = \PDF::loadView('imprimir.ficha_epidemiologica', array('est' => $establecimiento,
                                                                     'iden' => $identificacion,
                                                                     'men' => $menor,
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
        $pdf->setPaper("A4");
        return $pdf->stream('FichaEpidemiologica.pdf');
    }
}
