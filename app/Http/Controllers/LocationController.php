<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations.index');
    }

    public function listLocations(Request $request)
    {
        if (true) {
            $users = User::select(['id', 'name', 'email', 'password', 'created_at', 'updated_at']);

            return Datatables::of($users)
                ->rawColumns(['show', 'action', 'events'])
                ->addColumn('show', function ($user) {
                    return view('reproducers.females.datatables.show', compact('user'));
                })
                ->addColumn('action', function ($user) {
                    return view('reproducers.females.datatables.actions', compact('user'));
                })
                ->addColumn('events', function ($user) {
                    return view('reproducers.females.datatables.events', compact('user'));
                })
                ->make(true);
        }
    }
}
