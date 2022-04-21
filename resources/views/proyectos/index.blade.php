@extends('layouts.app')

@section('title','Administrador de proyectos')

@section('content')
{{-- <div class="container"> --}}
    <div class="row">
        <div class="col-md-12">
            <h1>Proyectos</h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-success" href="{{ route('proyectos.create') }}">Nuevo protecto</a>
        </div>
    </div>
{{-- </div> --}}

    @foreach ($proyectos as $proyecto)
        <div class="row p-3 my-3 border-0 shadow bg-white">
            <div class="col-md-12">
                <a href="{{ route ('proyectos.edit', ['proyecto' => $proyecto->id])}}" class="font-weight-bold">{{$proyecto->nombre}}</a>  
            </div>
            <div class="col-md-4">
                <p class="font-weight-bold">Tipo de proyecto</p>
                <p class="mb-0 text-secondary">{{ $proyecto->tipo->nombre }} </p>
            </div>
            <div class="col-md-4">
                <p class="font-weight-bold">Usuario Creador</p>
                <p class="mb-0 text-secondary">{{ $proyecto->usuario->name }} </p>
            </div>
            <div class="col-md-4">
                <p class="font-weight-bold">Estatus</p>
                <p class="mb-0 text-secondary">{{ $proyecto->estatus->nombre }} </p>
            </div>
            
        </div>
    @endforeach
    <div class="row justify-content-center">
        {{ $proyectos->links()}}
    </div>
@endsection