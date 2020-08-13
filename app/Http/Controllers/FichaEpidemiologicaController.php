<?php

namespace App\Http\Controllers;

use App\FichaEpidemiologica;
use App\Establecimiento;
use App\Paciente;
use App\Menor;
use App\Relacion;
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
        return view('form.nuevo');
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
        /* $establecimiento = new Establecimiento;
        $establecimiento->establecimiento = $request->establecimiento;
        $establecimiento->codigo = $request->codigo;
        $establecimiento->red = $request->red;
        $establecimiento->departamento = $request->departamento;
        $establecimiento->municipio = $request->municipio;
        $establecimiento->fecha_notificacion = $request->fecha_notificacion;
        $establecimiento->sem_epidem = $request->sem_epidem;
        $establecimiento->caso_identificado = $request->caso_identificado;
        $establecimiento->save();
        $id_est = $establecimiento->id_est;*/

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


        //$ficha = new FichaEpidemiologica;

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
