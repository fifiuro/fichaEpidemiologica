@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="col-md-4"></div>
    <div class="card card-info col-md-4">
        <div class="card-header">
            <h3 class="card-title">MENSAJE</h3>
        </div>
        <div class="card-body">
            <p class="text-center">Todos los datos se guardaron correctamente.</p>
        </div>
        <div class="card-footer">
            <a href="{{ url('imprimir/'.$id) }}" class="btn btn-success" target="_blanc">IMPRIMIR</a>
            <a href="{{ url('/') }}" class="btn btn-danger">CERRAR</a>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
@stop

@section('extra')
    
@stop