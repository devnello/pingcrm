<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Parrafo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ParrafoController extends Controller
{
    public function index_all()
    {
        $parrafos = Parrafo::all();

        return Inertia::render('Parrafos/Index', [
            'parrafos' => [
                'parrafos' => $parrafos,
            ],
        ]);
    }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Inertia\Response
     */
    public function edit(Request $request)
    {
        // Selecccion todos los Parrafos de el capitulo id
        $parrafo = Parrafo::findOrFail($request->id);


        return Inertia::render('Parrafos/Edit', [
            'parrafo' => [
                'id' => $parrafo->id,
                'orden' => $parrafo->orden,
                'descripcion' => $parrafo->descripcion,
                'publicado' => $parrafo->publicado == 1,
                'deleted_at' => $parrafo->deleted_at
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $parrafo = Parrafo::findOrfail($request->id);

        $parrafo->orden = $request->orden;
        $parrafo->descripcion = $request->descripcion;
        $parrafo->publicado = $request->publicado;

        // VALIDAR ANTES

        $parrafo->save();

        return Redirect::back()->with('success', 'Parrafo actualizado.');
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
