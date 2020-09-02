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
        $find = FichaEpidemiologica::join('pacientes','pacientes.id_pac','=','ficha_epidemiologica.id_pac')
                                   ->select('id_fe','pacientes.id_pac','nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes','telefono')
                                   ->where(DB::raw('CONCAT(nombre_pacientes," ",paterno_pacientes," ",materno_pacientes)'),'like','%'.$request->nombre.'%')
                                   ->paginate(10);
                                   //->get();

        if(!is_null($find)){
            return view('form.buscar')->with('find', $find)
                                      ->with('estado', '1')
                                      ->with('mensaje', '')
                                      ->with('usu',$this->Usuario());
        }else{
            return view('form.buscar')->with('find', $find)
                                      ->with('estado', '0')
                                      ->with('mensaje', 'No se tiene resultado para la busqueda: '.$request->nombre)
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

        return view('form.nuevo')->with('pai',$pai)
                                 ->with('dep',$dep)
                                 ->with('rel',$rel)
                                 ->with('ocu',$ocu)
                                 ->with('sin',$sin)
                                 ->with('est',$est)
                                 ->with('dia',$dia)
                                 ->with('enf',$enf)
                                 ->with('mue',$mue)
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
        $ficha->id_est = $id_est;
        $ficha->id_pac = $id_pac ;
        $ficha->id_ant = $id_ant;
        $ficha->id_dc = $id_dc;
        $ficha->id_hos = $id_hos;
        $ficha->save();
        $id_fe = $ficha->id_fe;

        // 6. ENFERMEDADES DE BASE O CONFICIONES DE RIESGO
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

        return view('form.buscar')->with('usu',$this->Usuario());
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

    public function imprimir($id)
    {
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

        if(count($laboratorio) > 0){
            $muestra = Muestra::join('listas_muestras','listas_muestras.id_mue','=','muestras.id_mue')
                              ->where('listas_muestras.id_lab','=',$laboratorio[0]->id_lab)
                              ->select('muestra')
                              ->get();
        }else{
            $muestra = array();
        }
                          

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
        return $pdf->stream('FichaEpidemiologica.pdf');
    }

    public function certificado($id,$id_lab)
    {
        $paciente = FichaEpidemiologica::join('pacientes','pacientes.id_pac','=','ficha_epidemiologica.id_pac')
                                       ->where('ficha_epidemiologica.id_fe','=',$id)
                                       ->select('nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes')
                                       ->get();
        $lab = Laboratorio::join('listas_muestras','listas_muestras.id_lab','=','laboratorios.id_lab')
                          ->join('muestras','muestras.id_mue','=','listas_muestras.id_mue')
                          ->select('laboratorios.id_fe','laboratorios.id_lab','laboratorios.id_pn','listas_muestras.id_lm','muestras.id_mue','fecha_muestra','resultado_laboratorio','fecha_resultado','fecha_impresion','numero')
                          ->where('laboratorios.id_fe','=',$id)
                          ->where('laboratorios.id_lab','=',$id_lab)
                          ->get();
        $fi = $this->fecha($id_lab,$id);
        $reporte = PersonalNotifica::where('id_pn','=',$lab[0]->id_pn)->get();
        $pdf = \PDF::loadView('imprimir.certificado', array('pac' => $paciente, 'lab' => $lab, 'reporte' => $reporte, 'fi' => $fi));
        return $pdf->stream('Certificado.pdf');
    }

    public function fecha($id_lab,$id_fe)
    {
        $find = Laboratorio::where('id_lab','=',$id_lab)
                           ->where('id_fe','=',$id_fe)
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

    public function certificado_medico($id_fe)
    {
        $paciente = FichaEpidemiologica::join('pacientes','pacientes.id_pac','=','ficha_epidemiologica.id_pac')
                                       ->where('ficha_epidemiologica.id_fe','=',$id_fe)
                                       ->select('ficha_epidemiologica.id_dc','nombre_pacientes','paterno_pacientes','materno_pacientes','seguro_pacientes')
                                       ->get();
                                       //dd($paciente[0]);
        $lab = Laboratorio::join('personal_notificado','personal_notificado.id_pn','=','laboratorios.id_pn')
                          ->where('laboratorios.id_fe','=',$id_fe)
                          ->select('nombre_notifica','paterno_notifica','materno_notifica','matricula_profesional')
                          ->get();
                          //dd($lab);
        $dc = DatoClinico::select('sintomas')
                              ->where('id_dc','=',$paciente[0]->id_dc)
                              ->get();
                              //dd($dc);
        $filtro = explode(",",$dc[0]->sintomas);
        $sintoma = Sintoma::whereIn('id_sin',$filtro)->select('sintoma')->get();
        $pdf = \PDF::loadView('imprimir.certificado_medico', array('pac' => $paciente, 'lab' => $lab, 'sin' => $sintoma));
        return $pdf->stream('CertificadoMedico.pdf');
    }

    public function Usuario()
    {
        $usu = PersonalNotifica::where('id','=',\Auth::user()->id)
                               ->select('id_pn','nombre_notifica','paterno_notifica','materno_notifica')
                               ->get();
        return $usu;
    }
}
