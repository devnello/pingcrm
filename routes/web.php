<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

//
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;

//
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//
use App\Models\Capitulo;
use \App\Models\Parrafo;

// PathTofree
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CapituloController;
use App\Http\Controllers\ParrafoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');
/*
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');
*/
// Users
Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations
Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts
Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports
Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

//
// WEB - Frontend
//

/*
Route::get('/', [CapituloController::class, 'index'])
    ->name('capitulo');
*/

Route::get('/', function () {
    return Inertia::render('Capitulo/Index', [
        'capitulos' => Capitulo::all(),
    ]);
});


Route::get('/capitulo/{id}', function ($id) {
    return Inertia::render('Capitulo/Show', [
        'capitulos' => Capitulo::find($id),
    ]);
});

Route::get('/capitulo/{id}/parrafo', function ($id) {
    return Inertia::render('Parrafo/Index', [
        'data' => [
            'capitulo' => Capitulo::find($id),
            'parrafos' => Capitulo::find($id)->parrafos,
        ]
    ]);
});

/*
 *
 *
 *  BACK-END
 *
 *
 *
 */

// Documentos

Route::get('documentos', [DocumentoController::class, 'index'])
    ->name('documentos')
    ->middleware('auth');

Route::get('documentos/create', [DocumentoController::class, 'create'])
    ->name('documentos.create')
    ->middleware('auth');

Route::post('documentos', [DocumentoController::class, 'store'])
    ->name('documentos.store')
    ->middleware('auth');

Route::get('documentos/{id}/edit', [DocumentoController::class, 'edit'])
    ->name('documentos.edit')
    ->middleware('auth');

Route::put('documentos/{id}', [DocumentoController::class, 'update'])
    ->name('documentos.update')
    ->middleware('auth');

Route::delete('documentos/{id}', [DocumentoController::class, 'destroy'])
    ->name('documentos.destroy')
    ->middleware('auth');

Route::put('documentos/{id}/restore', [DocumentoController::class, 'restore'])
    ->name('documentos.restore')
    ->middleware('auth');

//
// Capitulo
//
Route::get('capitulos', [CapituloController::class, 'index_all'])
    ->name('capitulos')
    ->middleware('auth');

Route::get('capitulos/{id}/index', [CapituloController::class, 'index'])
    ->name('capitulos.index')
    ->middleware('auth');

Route::get('capitulos/{id}/sel', [CapituloController::class, 'sel'])
    ->name('capitulos.sel')
    ->middleware('auth');

Route::get('capitulos/{id}/create', [CapituloController::class, 'create'])
    ->name('capitulos.create')
    ->middleware('auth');

Route::post('capitulos', [CapituloController::class, 'store'])
    ->name('capitulos.store')
    ->middleware('auth');

Route::get('capitulos/{documento_id}/{capitulo_id}/edit', [CapituloController::class, 'edit'])
    ->name('capitulos.edit')
    ->middleware('auth');

/*Route::post('capitulos/{documento_id}/{capitulo_id}/upload', [CapituloController::class, 'upload'])
    ->name('capitulos.upload')
    ->middleware('auth');*/

Route::post('capitulos/{documento_id}/{capitulo_id}/upload', [CapituloController::class, 'upload'])
    ->name('capitulos.upload')
    ->middleware('auth');

Route::put('capitulos/{id}', [CapituloController::class, 'update'])
    ->name('capitulos.update')
    ->middleware('auth');

Route::delete('capitulos/{id}', [CapituloController::class, 'destroy'])
    ->name('capitulos.destroy')
    ->middleware('auth');

Route::put('capitulos/{id}/restore', [CapituloController::class, 'restore'])
    ->name('capitulos.restore')
    ->middleware('auth');

// Parrafo
Route::get('parrafos', [ParrafoController::class, 'index_all'])
    ->name('parrafos')
    ->middleware('auth');

// Parraforos dosumento capitulo
Route::get('parrafos', [ParrafoController::class, 'index_all'])
    ->name('parrafos')
    ->middleware('auth');

Route::get('parrafos/{documento_id}/{capitulo_id}/index', [ParrafoController::class, 'index'])
    ->name('parrafos')
    ->middleware('auth');

Route::get('parrafos/create', [ParrafoController::class, 'create'])
    ->name('parrafos.create')
    ->middleware('auth');

Route::post('parrafos', [ParrafoController::class, 'store'])
    ->name('parrafos.store')
    ->middleware('auth');

Route::get('parrafos/{id}/edit', [ParrafoController::class, 'edit'])
    ->name('parrafos.edit')
    ->middleware('auth');

Route::put('parrafos/{id}', [ParrafoController::class, 'update'])
    ->name('parrafos.update')
    ->middleware('auth');

Route::delete('parrafos/{id}', [ParrafoController::class, 'destroy'])
    ->name('parrafos.destroy')
    ->middleware('auth');

Route::put('parrafos/{id}/restore', [ParrafoController::class, 'restore'])
    ->name('parrafos.restore')
    ->middleware('auth');
