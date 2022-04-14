@extends('layouts.app')

@section('title','Crear un nuevo proyecto')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class = "mb-3">Nuevo proyecto</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('proyectos.store') }}" method="post">
                @csrf()
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre" class="text-secondary font-weight-bold d-cblok @error('nombre') text-danger @enderror">Nombre</label>
                        <input type="text" name="nombre" id= "nombre "class = "form-control border-0 shadow @error('nombre') is-invalid @enderror" placeholder = "¿Cual proyecto?" value = "{{ old('nombre') }}" />
                        @error('nombre') 
                            <span class="d-block text-danger mt-2 font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_proyecto" class="text-secondary font-weight-bold d-cblok">Tipo proyecto</label>
                        <select name="tipo_proyecto" id= "tipo_proyecto" class = "form-control border-0 shadow" placeholder = "¿Cual proyecto?">
                            <option value="" selected disable>Selecciona</option>
                            <?php foreach($tipoProyectos as $val) : ?>
                                <option value="{{ $val->id }}">{{ $val->nombre }}</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-12 mt-5">
                        <label for="descripcion" class="text-secondary font-weight-bold d-cblok  @error('descripcion') text-danger @enderror">Descripcion</label>
                        <textarea name="descripcion" id= "descripcion "class = "form-control border-0 shadow @error('descripcion') text-danger @enderror" placeholder = "¿Cual proyecto?" rows ="5"></textarea>
                        @error('descripcion') 
                            <span class="d-block text-danger mt-2 font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class= "btn btn-primary mt-5">Guardar proyecto</button>
            </form>
        </div>
    </div>
</div>
@endsection