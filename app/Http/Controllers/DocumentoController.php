<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DocumentoController extends Controller
{

    public function index()
    {

        return Inertia::render('Documentos/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'documentos' => Auth::user()->documentos()
                ->orderBy('orden')
                //->filter(Request::only('search', 'trashed'))
                ->paginate(10),
        ]);

        /*
        return Inertia::render('Documentos/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($organization) => [
                    'id' => $organization->id,
                    'name' => $organization->name,
                    'phone' => $organization->phone,
                    'city' => $organization->city,
                    'deleted_at' => $organization->deleted_at,
                ]),
        ]);
        */
    }

    public function create()
    {
        return Inertia::render('Documentos/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'orden' => ['nullable', 'max:50'],
            'descripcion' => ['required', 'max:150'],
            // 'publicado' => ['required', 'max:1'],
        ]);

        /*
        Request::validate([
            'orden' => ['nullable', 'max:50'],
            'descripcion' => ['required', 'max:150'],
            'publicado' => ['required', 'max:1'],
        ]);
        */

        /*
        Auth::user()->documento()->create(
            Request::validate([
                'orden' => ['nullable', 'max:50'],
                'descripcion' => ['required', 'max:150'],
                'publicado' => ['required', 'max:1'],
            ])
        );
        */

        Auth::user()->documentos()->create($request->all());


        return Redirect::route('documentos')->with('success', 'Documento creado.');
    }

    public function edit(Request $request)
    {

        // MSP
        $documento = Documento::findOrfail($request->id);

        return Inertia::render('Documentos/Edit', [
            'documento' => [
                'id' => $documento->id,
                'orden' => $documento->orden,
                'descripcion' => $documento->descripcion,
                'publicado' => $documento->publicado == 1,
                'deleted_at' => $documento->deleted_at,
                'capitulos' => $documento->capitulos()/*->orderByName()*/ ->get()->map->only('id', 'orden', 'descripcion','imagen'),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $documento = Documento::findOrfail($request->id);

        $documento->orden = $request->orden;
        $documento->descripcion = $request->descripcion;
        $documento->publicado = $request->publicado;

        // VALIDAR ANTES

        $documento->save();

        /*
        $documento->update(
            Request::validate([
                'orden' => ['nullable', 'max:10'],
                'descripcion' => ['required', 'max:50'],
                'flg_prf' => ['nullable', 'max:1'],
            ])
        );
        */

        return Redirect::back()->with('success', 'Documento actualizado.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }
}
