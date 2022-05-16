<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Parrafo;
use App\Utils\Helper;
use App\Utils\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ParrafoController extends Controller
{
    public function index_all()
    {
        // OK
        // dd(Auth::user()->getAttribute('id'));
        // Not OK
        // dd(Auth::user()->documents());

        $user_id = Auth::user()->getAttribute('id');
        $parrafos = Helper::selView(View::V_PTO_PARRAFOS_00, '*', [['user_id', '=', $user_id]]);

        return Inertia::render('Parrafos/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'parrafos' => $parrafos,
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
