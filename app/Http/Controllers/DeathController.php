<?php

namespace App\Http\Controllers;

use App\Death;
use App\Http\Requests\DeathRequest;
use App\Reproducer;
use Illuminate\Http\Request;

class DeathController extends Controller
{
    public function create(Request $request)
    {
        $id = 0;
        if ($request->has('female')) {
            $id = $request->get('female');
        }
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        return view('deaths.create', compact('id', 'females'));
    }

    public function store(DeathRequest $request)
    {
        if ($request->ajax()) {
            $death                = new Death;
            $death->date          = $request->date;
            $death->reason        = $request->reason;
            $death->weight        = $request->weight;
            $death->observation   = $request->observation;
            $death->reproducer_id = $request->reproducer;
            $death->save();
            return response()->json([
                'success' => true,
                'female'  => $death->reproducer_id,
                'message' => message('MSG001'),
            ], 201);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }

    public function edit($id)
    {
        $death   = Death::findOrFail($id);
        $id      = $death->reproducer_id;
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        $data    = [
            'death'   => $death,
            'females' => $females,
        ];
        return view('deaths.edit', compact('id', 'data'));
    }

    public function update(DeathRequest $request, $id)
    {
        if ($request->ajax()) {
            $death              = Death::find($id);
            $death->date        = $request->date;
            $death->reason      = $request->reason;
            $death->weight      = $request->weight;
            $death->observation = $request->observation;
            $death->save();
            return response()->json([
                'success' => true,
                'female'  => $death->reproducer_id,
                'message' => message('MSG002'),
            ], 200);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }
}
