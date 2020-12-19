<?php

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

Route::get('/', 'Auth\LoginController@ShowLoginForm');

Route::get('test', function () {
    // $females = \Female::getFemales();
    // //dd($females);
    // $weaningId = 2;
    // $weaning   = \App\Weaning::whereHas('groups', function ($q) use ($weaningId) {
    //     $q->where('weanings.id', $weaningId);
    // })->get();
    // $female = \App\Reproducer::findOrFail(1);
    // $female->load('weaning');
    // $female->load('inseminations');

    // $data = \App\Reproducer::with([
    //     'genetics:id,name',
    //     'location',
    //     'inseminations' => function ($query) {
    //         $query->select('*', DB::raw('"inseminations" as type'));
    //         $query->with([
    //             'semen:id,code',
    //         ]);
    //     },
    //     'weaning'       => function ($query) {
    //         $query->select('*', DB::raw('"weaning" as type'));
    //     },
    //     'death'         => function ($query) {
    //         $query->select('*', DB::raw('"death" as type'));
    //     },
    //     'births'        => function ($query) {
    //         $query->select('*', DB::raw('"births" as type'));
    //     },
    // ])->findOrFail(1);
    // $events          = collect($data->inseminations)->merge($data->weaning)->merge($data->death)->merge($data->births);
    // $flattenedEvents = $events->flatten();
    // $sortedEvents    = $flattenedEvents->sortByDesc('date');

    // return $events;
    // $data = \App\Reproducer::with([
    //     'genetics:id,name',
    //     'location',
    //     'inseminations' => function ($query) {
    //         $query->select('*', DB::raw('"inseminations" as type'), DB::raw('"bg-blue-500" as color'));
    //         $query->with([
    //             'semen:id,code',
    //         ]);
    //     },
    //     'weaning'       => function ($query) {
    //         $query->select('*', DB::raw('"weanings" as type'), DB::raw('"bg-indigo-500" as color'));
    //     },
    //     'abortions'     => function ($query) {
    //         $query->select('*', DB::raw('"abortions" as type'), DB::raw('"bg-orange-500" as color'));
    //     },
    //     'death'         => function ($query) {
    //         $query->select('*', DB::raw('"deaths" as type'), DB::raw('"bg-red-500" as color'));
    //     },
    //     'births'        => function ($query) {
    //         $query->select('*', DB::raw('"births" as type'), DB::raw('"bg-green-500" as color'));
    //     },
    // ])->findOrFail(1);
    // $events          = collect($data->inseminations)->merge($data->weaning)->merge($data->abortions)->merge([$data->death])->merge($data->births);
    // $flattenedEvents = $events->flatten();
    // $sortedEvents    = $flattenedEvents->sortByDesc('date');
    // return $sortedEvents->values()->paginate(5);
    //$female = Reproducer::findOrFail(2);
    $data = \App\Reproducer::with([
        'inseminations' => function ($query) {
            $query->select('*', DB::raw('"Inseminación" as type'));
            $query->orderBy('date', 'desc')->orderBy('id', 'DESC')->first();
        },
        'weaning'       => function ($query) {
            $query->select('*', DB::raw('"Destete" as type'));
            $query->orderBy('date', 'desc')->orderBy('id', 'DESC')->first();
        },
        'abortions'     => function ($query) {
            $query->select('*', DB::raw('"Aborto" as type'));
            $query->orderBy('date', 'desc')->orderBy('id', 'DESC')->first();
        },
        'death'         => function ($query) {
            $query->select('*', DB::raw('"Baja" as type'));
            $query->orderBy('date', 'desc')->orderBy('id', 'DESC')->first();
        },
        'births'        => function ($query) {
            $query->select('*', DB::raw('"Parto" as type'));
            $query->orderBy('date', 'desc')->orderBy('id', 'DESC')->first();
        },
    ])->findOrFail(2);

    $events = collect($data->inseminations)->merge($data->weaning)->merge($data->abortions)->merge([$data->death])->merge($data->births)->flatten();
    return $events;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('reporte', 'SemenController@reporte');

Route::middleware(['auth'])->group(function () {
    //Permissions
    Route::get('permissions', 'UserController@permissions')->name('permissions');

    //Genetics
    Route::get('genetics', 'GeneticsController@index')->name('genetics.index')
        ->middleware('permission:genetics.index');
    Route::get('genetics/list', 'GeneticsController@listGenetics')->name('genetics.list')
        ->middleware('permission:genetics.index');
    Route::get('genetics/create', 'GeneticsController@create')->name('genetics.create')
        ->middleware('permission:genetics.create');
    Route::post('genetics/store', 'GeneticsController@store')->name('genetics.store')
        ->middleware('permission:genetics.create');
    Route::get('genetics/{id}/edit', 'GeneticsController@edit')->name('genetics.edit')
        ->middleware('permission:genetics.edit');
    Route::put('genetics/{id}', 'GeneticsController@update')->name('genetics.update')
        ->middleware('permission:genetics.edit');
    Route::delete('genetics/{id}', 'GeneticsController@destroy')->name('genetics.destroy')
        ->middleware('permission:genetics.destroy');

    //Phases
    Route::get('phases', 'PhaseController@index')->name('phases.index')
        ->middleware('permission:phases.index');
    Route::get('phases/list', 'PhaseController@listPhases')->name('phases.list')
        ->middleware('permission:phases.index');
    Route::get('phases/create', 'PhaseController@create')->name('phases.create')
        ->middleware('permission:phases.create');
    Route::post('phases/store', 'PhaseController@store')->name('phases.store')
        ->middleware('permission:phases.create');
    Route::get('phases/{id}/edit', 'PhaseController@edit')->name('phases.edit')
        ->middleware('permission:phases.edit');
    Route::put('phases/{id}', 'PhaseController@update')->name('phases.update')
        ->middleware('permission:phases.edit');
    Route::delete('phases/{id}', 'PhaseController@destroy')->name('phases.destroy')
        ->middleware('permission:phases.destroy');

    //Locations
    Route::get('locations', 'LocationController@index')->name('locations.index')
        ->middleware('permission:locations.index');
    Route::get('locations/list', 'LocationController@listLocations')->name('locations.list')
        ->middleware('permission:locations.index');
    Route::get('locations/create', 'LocationController@create')->name('locations.create')
        ->middleware('permission:locations.create');
    Route::post('locations/store', 'LocationController@store')->name('locations.store')
        ->middleware('permission:locations.create');
    Route::get('locations/{id}/edit', 'LocationController@edit')->name('locations.edit')
        ->middleware('permission:locations.edit');
    Route::put('locations/{id}', 'LocationController@update')->name('locations.update')
        ->middleware('permission:locations.edit');
    Route::delete('locations/{id}', 'LocationController@destroy')->name('locations.destroy')
        ->middleware('permission:locations.destroy');

    //Reproducers
    Route::get('females', 'ReproducerController@index')->name('females.index')
        ->middleware('permission:females.index');
    Route::get('females/list', 'ReproducerController@listFemales')->name('females.list')
        ->middleware('permission:females.show');
    Route::get('females/events-female', 'ReproducerController@getEventsFemale')->name('females.events')
        ->middleware('permission:females.index');
    Route::get('females/latest-event', 'ReproducerController@getLatestEventFemale')->name('females.latest')
        ->middleware('permission:females.create');
    Route::get('females/create', 'ReproducerController@create')->name('females.create')
        ->middleware('permission:females.create');
    Route::post('females/store', 'ReproducerController@store')->name('females.store')
        ->middleware('permission:females.create');
    Route::get('females/{id}', 'ReproducerController@show')->name('females.show')
        ->middleware('permission:females.show');
    Route::get('females/{id}/edit', 'ReproducerController@edit')->name('females.edit')
        ->middleware('permission:females.edit');
    Route::put('females/{id}', 'ReproducerController@update')->name('females.update')
        ->middleware('permission:females.edit');
    Route::delete('females/{id}', 'ReproducerController@destroy')->name('females.destroy')
        ->middleware('permission:females.destroy');

    //Inseminations
    Route::get('inseminations/create', 'InseminationController@create')->name('inseminations.create')
        ->middleware('permission:inseminations.create');
    Route::post('inseminations/store', 'InseminationController@store')->name('inseminations.store')
        ->middleware('permission:inseminations.create');
    Route::get('inseminations/{id}/edit', 'InseminationController@edit')->name('inseminations.edit')
        ->middleware('permission:inseminations.edit');
    Route::put('inseminations/{id}', 'InseminationController@update')->name('inseminations.update')
        ->middleware('permission:inseminations.edit');
    Route::delete('inseminations/{id}', 'InseminationController@destroy')->name('inseminations.destroy')
        ->middleware('permission:inseminations.destroy');

    //Adoptions
    Route::get('adoptions/create', 'AdoptionController@create')->name('adoptions.create')
        ->middleware('permission:adoptions.create');
    Route::post('adoptions/store', 'AdoptionController@store')->name('adoptions.store')
        ->middleware('permission:adoptions.create');
    Route::get('adoptions/{id}/edit', 'AdoptionController@edit')->name('adoptions.edit')
        ->middleware('permission:adoptions.edit');
    Route::put('adoptions/{id}', 'AdoptionController@update')->name('adoptions.update')
        ->middleware('permission:adoptions.edit');
    Route::delete('adoptions/{id}', 'AdoptionController@destroy')->name('adoptions.destroy')
        ->middleware('permission:adoptions.destroy');

    //Transfers
    Route::get('transfers/create', 'TransferController@create')->name('transfers.create')
        ->middleware('permission:transfers.create');
    Route::post('transfers/store', 'TransferController@store')->name('transfers.store')
        ->middleware('permission:transfers.create');
    Route::get('transfers/{id}/edit', 'TransferController@edit')->name('transfers.edit')
        ->middleware('permission:transfers.edit');
    Route::put('transfers/{id}', 'TransferController@update')->name('transfers.update')
        ->middleware('permission:transfers.edit');
    Route::delete('transfers/{id}', 'TransferController@destroy')->name('transfers.destroy')
        ->middleware('permission:transfers.destroy');

    //Extractions
    Route::get('extractions/create', 'ExtractionController@create')->name('extractions.create')
        ->middleware('permission:extractions.create');
    Route::post('extractions/store', 'ExtractionController@store')->name('extractions.store')
        ->middleware('permission:extractions.create');
    Route::get('extractions/{id}/edit', 'ExtractionController@edit')->name('extractions.edit')
        ->middleware('permission:extractions.edit');
    Route::put('extractions/{id}', 'ExtractionController@update')->name('extractions.update')
        ->middleware('permission:extractions.edit');
    Route::delete('extractions/{id}', 'ExtractionController@destroy')->name('extractions.destroy')
        ->middleware('permission:extractions.destroy');

    //Semen
    Route::get('semen', 'SemenController@index')->name('semen.index')
        ->middleware('permission:semen.index');
    Route::get('semen/list', 'SemenController@listSemen')->name('semen.list')
        ->middleware('permission:semen.index');
    Route::get('semen/create', 'SemenController@create')->name('semen.create')
        ->middleware('permission:semen.create');
    Route::post('semen/store', 'SemenController@store')->name('semen.store')
        ->middleware('permission:semen.create');
    Route::get('semen/{id}', 'SemenController@show')->name('semen.show')
        ->middleware('permission:semen.show');
    Route::get('semen/{id}/edit', 'SemenController@edit')->name('semen.edit')
        ->middleware('permission:semen.edit');
    Route::put('semen/{id}', 'SemenController@update')->name('semen.update')
        ->middleware('permission:semen.edit');
    Route::delete('semen/{id}', 'SemenController@destroy')->name('semen.destroy')
        ->middleware('permission:semen.destroy');

    //Weanings
    Route::get('weanings/create', 'WeaningController@create')->name('weanings.create')
        ->middleware('permission:weanings.create');
    Route::post('weanings/store', 'WeaningController@store')->name('weanings.store')
        ->middleware('permission:weanings.create');
    Route::get('weanings/{id}/edit', 'WeaningController@edit')->name('weanings.edit')
        ->middleware('permission:weanings.edit');
    Route::put('weanings/{id}', 'WeaningController@update')->name('weanings.update')
        ->middleware('permission:weanings.edit');
    Route::delete('weanings/{id}', 'WeaningController@destroy')->name('weanings.destroy')
        ->middleware('permission:weanings.destroy');

    //Abortions
    Route::get('abortions/create', 'AbortionController@create')->name('abortions.create')
        ->middleware('permission:abortions.create');
    Route::post('abortions/store', 'AbortionController@store')->name('abortions.store')
        ->middleware('permission:abortions.create');
    Route::get('abortions/{id}/edit', 'AbortionController@edit')->name('abortions.edit')
        ->middleware('permission:abortions.edit');
    Route::put('abortions/{id}', 'AbortionController@update')->name('abortions.update')
        ->middleware('permission:abortions.edit');
    Route::delete('abortions/{id}', 'AbortionController@destroy')->name('abortions.destroy')
        ->middleware('permission:abortions.destroy');

    //Deaths
    Route::get('deaths/create', 'DeathController@create')->name('deaths.create')
        ->middleware('permission:deaths.create');
    Route::post('deaths/store', 'DeathController@store')->name('deaths.store')
        ->middleware('permission:deaths.create');
    Route::get('deaths/{id}/edit', 'DeathController@edit')->name('deaths.edit')
        ->middleware('permission:deaths.edit');
    Route::put('deaths/{id}', 'DeathController@update')->name('deaths.update')
        ->middleware('permission:deaths.edit');
    Route::delete('deaths/{id}', 'DeathController@destroy')->name('deaths.destroy')
        ->middleware('permission:deaths.destroy');

    //DeathsBreeding
    Route::get('deathsbreeding/create', 'DeathBreendingController@create')->name('deathsbreeding.create')
        ->middleware('permission:deathsbreeding.create');
    Route::post('deathsbreeding/store', 'DeathBreendingController@store')->name('deathsbreeding.store')
        ->middleware('permission:deathsbreeding.create');
    Route::get('deathsbreeding/{id}/edit', 'DeathBreendingController@edit')->name('deathsbreeding.edit')
        ->middleware('permission:deathsbreeding.edit');
    Route::put('deathsbreeding/{id}', 'DeathBreendingController@update')->name('deathsbreeding.update')
        ->middleware('permission:deathsbreeding.edit');
    Route::delete('deathsbreeding/{id}', 'DeathBreendingController@destroy')->name('deathsbreeding.destroy')
        ->middleware('permission:deathsbreeding.destroy');

    //Births
    Route::get('births/create', 'BirthController@create')->name('births.create')
        ->middleware('permission:births.create');
    Route::post('births/store', 'BirthController@store')->name('births.store')
        ->middleware('permission:births.create');
    Route::get('births/{id}/edit', 'BirthController@edit')->name('births.edit')
        ->middleware('permission:births.edit');
    Route::put('births/{id}', 'BirthController@update')->name('births.update')
        ->middleware('permission:births.edit');
    Route::delete('births/{id}', 'BirthController@destroy')->name('births.destroy')
        ->middleware('permission:births.destroy');

    //Treatments
    Route::get('treatments/create', 'TreatmentController@create')->name('treatments.create')
        ->middleware('permission:treatments.create');
    Route::post('treatments/store', 'TreatmentController@store')->name('treatments.store')
        ->middleware('permission:treatments.create');
    Route::get('treatments/{id}/edit', 'TreatmentController@edit')->name('treatments.edit')
        ->middleware('permission:treatments.edit');
    Route::put('treatments/{id}', 'TreatmentController@update')->name('treatments.update')
        ->middleware('permission:treatments.edit');
    Route::delete('treatments/{id}', 'TreatmentController@destroy')->name('treatments.destroy')
        ->middleware('permission:treatments.destroy');

    //Groups
    Route::get('groups', 'GroupController@index')->name('groups.index')
        ->middleware('permission:groups.index');
    Route::get('groups/list', 'GroupController@listReproducers')->name('groups.list')
        ->middleware('permission:groups.index');
    Route::get('groups/create', 'GroupController@create')->name('groups.create')
        ->middleware('permission:groups.create');
    Route::post('groups/store', 'GroupController@store')->name('groups.store')
        ->middleware('permission:groups.create');
    Route::get('groups/{id}', 'GroupController@show')->name('groups.show')
        ->middleware('permission:groups.show');
    Route::get('groups/{id}/edit', 'GroupController@edit')->name('groups.edit')
        ->middleware('permission:groups.edit');
    Route::put('groups/{id}', 'GroupController@update')->name('groups.update')
        ->middleware('permission:groups.edit');
    Route::delete('groups/{id}', 'GroupController@destroy')->name('groups.destroy')
        ->middleware('permission:groups.destroy');

    //GroupTreatments
    Route::get('grouptreatments/create', 'GroupTreatmentController@create')->name('grouptreatments.create')
        ->middleware('permission:grouptreatments.create');
    Route::post('grouptreatments/store', 'GroupTreatmentController@store')->name('grouptreatments.store')
        ->middleware('permission:grouptreatments.create');
    Route::get('grouptreatments/{id}/edit', 'GroupTreatmentController@edit')->name('grouptreatments.edit')
        ->middleware('permission:grouptreatments.edit');
    Route::put('grouptreatments/{id}', 'GroupTreatmentController@update')->name('grouptreatments.update')
        ->middleware('permission:grouptreatments.edit');
    Route::delete('grouptreatments/{id}', 'GroupTreatmentController@destroy')->name('grouptreatments.destroy')
        ->middleware('permission:grouptreatments.destroy');

    //DeathsGroup
    Route::get('deathsgroup/create', 'DeathGroupController@create')->name('deathsgroup.create')
        ->middleware('permission:deathsgroup.create');
    Route::post('deathsgroup/store', 'DeathGroupController@store')->name('deathsgroup.store')
        ->middleware('permission:deathsgroup.create');
    Route::get('deathsgroup/{id}/edit', 'DeathGroupController@edit')->name('deathsgroup.edit')
        ->middleware('permission:deathsgroup.edit');
    Route::put('deathsgroup/{id}', 'DeathGroupController@update')->name('deathsgroup.update')
        ->middleware('permission:deathsgroup.edit');
    Route::delete('deathsgroup/{id}', 'DeathGroupController@destroy')->name('deathsgroup.destroy')
        ->middleware('permission:deathsgroup.destroy');

    //Relocations
    Route::get('relocations', 'RelocationController@index')->name('relocations.index')
        ->middleware('permission:relocations.index');
    Route::get('relocations/create', 'RelocationController@create')->name('relocations.create')
        ->middleware('permission:relocations.create');
    Route::post('relocations/store', 'RelocationController@store')->name('relocations.store')
        ->middleware('permission:relocations.create');
    Route::get('relocations/{id}/edit', 'RelocationController@edit')->name('relocations.edit')
        ->middleware('permission:relocations.edit');
    Route::put('relocations/{id}', 'RelocationController@update')->name('relocations.update')
        ->middleware('permission:relocations.edit');
    Route::delete('relocations/{id}', 'RelocationController@destroy')->name('relocations.destroy')
        ->middleware('permission:relocations.destroy');

    //Roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
        ->middleware('permission:roles.create');
    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('permission:roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('permission:roles.create');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('permission:roles.edit');
    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('permission:roles.show');
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('permission:roles.destroy');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('permission:roles.edit');

    //Users
    Route::get('users', 'UserController@index')->name('users.index')
        ->middleware('permission:users.index');
    Route::get('products/create', 'ProductController@create')->name('products.create')
        ->middleware('permission:products.create');
    Route::post('products/store', 'ProductController@store')->name('products.store')
        ->middleware('permission:products.create');
    Route::put('users/{user}', 'UserController@update')->name('users.update')
        ->middleware('permission:users.edit');
    Route::get('users/{user}', 'UserController@show')->name('users.show')
        ->middleware('permission:users.show');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
        ->middleware('permission:users.destroy');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
        ->middleware('permission:users.edit');
});
