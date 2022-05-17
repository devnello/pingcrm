<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Utils\Col;
use App\Utils\Helper;
use App\Utils\Tab;
use App\Utils\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CapituloController extends Controller
{

    /*
    public function convertArrayToStdClass($array)
    {
        return json_decode(json_encode($array));
    }

    public function convertStdClassToArray($stdClass)
    {
        return json_decode(json_encode($stdClass), true);
    }
    */
    public function index_all(Request $request)
    {
        //$capitulos = Capitulo::all();

        // OK
        // dd(Auth::user()->getAttribute('id'));
        // Not OK
        // dd(Auth::user()->documents());

        $user_id = Auth::user()->getAttribute('id');
        // $capitulos = Helper::selView(View::V_PTO_CAPITULOS_00, '*', [['user_id', '=', $user_id]]);

        $capitulos = DB::table(View::V_PTO_CAPITULOS_00);

        // SELECT LIST
        $capitulos = $capitulos->select(DB::raw('*'));

        // WHERE
        $where_array_conditions = [['user_id', '=', $user_id]];
        foreach ($where_array_conditions as $item) {
            $capitulos->where($item[0], $item[1], $item[2]);
        }

        // WHERE TRASHED
        $req = $request->only('search', 'trashed');
        if (isset($req['trashed']) and $req['trashed'] === 'only') {
            $capitulos->whereNotNull('deleted_at');
        }

        // WHERE SEARCH
        if (isset($req['search'])) {
            $capitulos->where('doc_descripcion', 'like', '%' . $req['search'] . '%');
            $capitulos->orWhere('cap_descripcion', 'like', '%' . $req['search'] . '%');
        }
        // dd($req);
        // $capitulos = $capitulos->filter($req);

        // $capitulos = $capitulos->withQueryString();
        // ORDER BY
        $capitulos = $capitulos->orderBy('doc_descripcion');
        $capitulos = $capitulos->orderBy('cap_orden');

        // PAGINATION
        $capitulos = $capitulos->paginate(10);

        return Inertia::render('Capitulos/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'capitulos' => $capitulos,
        ]);

        /*
        return Inertia::render('Organizations/Index', [
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

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        //

        $capitulos = Capitulo::where('id', $request->id)->get();

        /*
        $capitulos = DB::table('pto_capitulos')
            ->select('*')
            ->get();
        */
        /*
        $facturas_ven = DB::table(View::V_GPC_FACTURAS_VEN_01)
            ->orderBy(Col::TC_NUMERO, Cons::ORDER_BY_DESC)
            ->where(Col::TC_CLIENTE_ID, $id)
            ->whereNull(Col::TC_OFERTA_ID)
            ->select('*')
            ->get();
        */

        #$items = $capitulos->paginate(5);
        //dd('PINCO');

        return Inertia::render('Capitulos/Index', [
            'capitulos' => [
                'capitulos' => $capitulos,
                //'capitulos' => capitulos->parrafos()/*->orderByName()*/ ->get()->map->only('id', 'orden', 'descripcion'),
            ],
        ]);


    }

    public function sel(Request $request)
    {

        $documento_id = $request->id;

        $capitulos = DB::table(View::V_PTO_CAPITULOS_00);

        // SELECT LIST
        $capitulos = $capitulos->select(DB::raw('capitulo_id, cap_descripcion'));

        // WHERE
        $where_array_conditions = [['documento_id', '=', $documento_id]];
        foreach ($where_array_conditions as $item) {
            $capitulos->where($item[0], $item[1], $item[2]);
        }
        $capitulos->where('cap_flgact', '=', 1);
        // ORDER BY
        $capitulos = $capitulos->orderBy('cap_orden');

        $capitulos = $capitulos->get();

        $capitulos_response = [];
        foreach ($capitulos as $cap) {
            $capitulos_response[] = ['id' => $cap->capitulo_id, 'descripcion' => $cap->cap_descripcion];
        }
        // dd($capitulos_response);

        return response()->json($capitulos_response);
        /*
        return response()->json([
            ['id' => 1 * $request->id, 'descripcion' => 'Descripcion ' . $request->id],
            ['id' => 2 * $request->id, 'descripcion' => 'Descripcion ' . (2 * $request->id)],
        ]);
        */

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        //
        return Inertia::render('Capitulos/Create', [
            'documento' => [
                'id' => $request->id
            ]]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'orden' => ['nullable', 'max:50'],
            'descripcion' => ['required', 'max:150'],
            // 'publicado' => ['required', 'max:1'],
        ]);

        // EStudiar que significa
        // Auth::user()->documentos()->create($request->all());

        $capitulo = new Capitulo($request->all());
        $capitulo->save();

        return Redirect::route('documentos')->with('success', 'Capitulo creado.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit(Request $request)
    {
        // Selecccion todos los Parrafos de el capitulo id
        $capitulo = Capitulo::findOrFail($request->id);
        //$parrafos = $capitulo->parrafos()->get();

        /*
        dd(['request-id' => $request->id,
            'capitulo' => $capitulo,
            'parrafos' => $capitulo->parrafos()->get()->map->only('id', 'orden', 'descripcion'),
        ]);
        */


        return Inertia::render('Capitulos/Edit', [
            'capitulo' => [
                'id' => $capitulo->id,
                'orden' => $capitulo->orden,
                'descripcion' => $capitulo->descripcion,
                'publicado' => $capitulo->publicado == 1,
                'deleted_at' => $capitulo->deleted_at,
                'parrafos' => $capitulo->parrafos()/*->orderByName()*/ ->get()->map->only('id', 'orden', 'descripcion'),
            ],
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $capitulo = Capitulo::findOrfail($request->id);

        $capitulo->orden = $request->orden;
        $capitulo->descripcion = $request->descripcion;
        $capitulo->publicado = $request->publicado;

        // VALIDAR ANTES

        $capitulo->save();

        return Redirect::back()->with('success', 'Capitulo actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
