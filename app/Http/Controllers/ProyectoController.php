<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\TipoProyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $proyectos = Proyecto::where('proyecto_id','=',1)
        //                         ->where('estatus_id', '=', 1)
        //                         ->orderby('created_at','DESC')
        //                         ->get();

        $proyectos = Proyecto::orderby('created_at','DESC')
                                ->paginate(2);

        return view('proyectos.index',compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProyectos = TipoProyecto::orderBy('nombre','ASC')->get();

        // return view('proyectos.create')->with('tipoProyectos',$tipoProyectos);

        return view('proyectos.create',compact('tipoProyectos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temp = $request -> validate([
            'nombre' => 'required|string|min:5',
            'tipo_proyecto' => 'required|integer|exists:App\Models\TipoProyecto,id',
            'descripcion' => 'required|string|min:30'
        ]);

        // dd($temp);

        // Primer forma de insertar datos
        // DB::table('proyectos')->insert([
        //     'nombre' => $temp['nombre'],
        //     'descripcion' => $temp['descripcion'],
        //     'proyecto_id' => $temp['tipo_proyecto'],
        //     'estatus_id' => 1,
        //     'user_id' => Auth::user()->id
        // ]);

        // Segunda forma para guardar datos con el request, auth como helper 
        // $proyecto = Proyecto::create([
        //     'nombre' => Str::title($request->input('nombre')),
        //     'descripcion' => Str::ucfirst($request->input('descripcion')),
        //     'slug' => Str::slug($request->nombre),
        //     'proyecto_id'=> $request->input('tipo_proyecto'),
        //     'estatus_id' => 1,
        //     'user_id' => auth()->user()->id

        // ]);

        $protecto = auth()->user()->proyectos()->create([
            'nombre' => Str::title($request->input('nombre')),
            'descripcion' => Str::ucfirst($request->input('descripcion')),
            'slug' => Str::slug($request->nombre),
            'proyecto_id'=> $request->input('tipo_proyecto'),
            'estatus_id' => 1,
        ]);

        // return redirect()->route('proyectos.index')
        //                 ->with('tipo','existoso')
        //                 ->with('mensaje', "Proyecto {$request->nombre} guardado exitosamente");

        session()->flash('tipo','exitoso');
        session()->flash('mensaje', "Proyecto: {$request->nombre} ha sido creado exitosamente");
        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto $proyecto)
    {
        $tipoProyectos = TipoProyecto::orderBy('nombre','ASC')->get();

        return view('proyectos.edit',compact('proyecto','tipoProyectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $temp = $request -> validate([
            'nombre' => 'required|string|min:5',
            'tipo_proyecto' => 'required|integer|exists:App\Models\TipoProyecto,id',
            'descripcion' => 'required|string|min:30'
        ]);
        
        $proyecto->nombre = Str::title($request->input('nombre'));
        $proyecto->descripcion = Str::ucfirst($request->input('descripcion'));
        $proyecto->proyecto_id = $request->input('tipo_proyecto');

        $proyecto->save();

        session()->flash('tipo','exitoso');
        session()->flash('mensaje', "Proyecto: {$request->nombre} ha sido actualizado exitosamente");

        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
