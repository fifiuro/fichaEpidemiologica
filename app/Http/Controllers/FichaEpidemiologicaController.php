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
        // TABLA ESTABLECIMIENTO
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
        

        // IDENTIFICACION DEL CASO / PACIENTE
        $paciente = new Paciente;
        $paciente->nombre_pacientes = $request->nombre_pacientes;
        $paciente->paterno_pacientes = $request->paterno_pacientes;
        $paciente->materno_pacientes = $request->materno_pacientes;
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

        // ANTECEDENTES EPIDEMIOLOGICOS
        $ante = new Antecedente;
        $ante->id_ocu = $request->id_ocu;
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
        $ante->nombre_contacto = $request->nombre_contacto;
        $ante->paterno_contacto = $request->paterno_contacto;
        $ante->materno_contacto = $request->materno_contacto;
        $ante->telefono_contacto = $request->telefono_contacto;
        $ante->pais_contacto = $request->id_pai_contacto;
        $ante->departamento_contacto = $request->departamento_contacto;
        $ante->municipio_contacto = $request->municipio_contacto;
        $ante->ciudad_contacto = $request->ciudad_contacto;
        $ante->save();
        $id_ant = $ante->id_ant;

        // 4. DATOS CLINICOS
        $datos = new DatoClinico;
        $datos->fecha_inicio = $request->fecha_inicio;
        $sin = implode(",",$request->sintoma);
        $datos->sintomas = $sin;
        $datos->id_est = $request->id_estado;
        $datos->fecha_estado = $request->fecha_estado;
        $datos->id_dia = $request->id_dia;
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
        for ($i=0; $i < count($request->id_enf) ; $i++) {
            $base = new EnfermedadesBase;
            $base->id_enf = $request->id_enf[$i];
            $base->id_fe = $id_fe;
            $base->save();
        }

        // 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOPSO ESTUVO EN CONTACTO
        $conta = new Contacto;
        $conta->id_fe = $id_fe;
        $conta->nombre_contacto = $request->nombre_sospechoso;
        $conta->paterno_contacto = $request->paterno_sospechoso;
        $conta->materno_contacto = $request->materno_sospechoso;
        $conta->id_rel = $request->id_rel;
        $conta->edad = $request->edad_sospechoso;
        $conta->telefono = $request->telefono_sospechoso;
        $conta->direccion = $request->direccion_sospechoso;
        $conta->fecha_contacto = $request->fecha_sospechoso;
        $conta->lugar_contacto = $request->lugar_sospechoso;
        $conta->save();

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

        return view('template.inicio');
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
}
