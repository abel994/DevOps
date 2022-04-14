@extends('layouts.app')

@section('title','Administrador de proyectos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Proyectos</h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-success" href="{{ route('proyectos.create') }}">Nuevo protecto</a>
        </div>
    </div>
</div>
@endsection