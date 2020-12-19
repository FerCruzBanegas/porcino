<?php

namespace App\Http\Controllers;

use App\Abortion;
use App\Http\Requests\AbortionRequest;
use App\Reproducer;
use Illuminate\Http\Request;

class AbortionController extends Controller
{
    public function create(Request $request)
    {
        $id = 0;
        if ($request->has('female')) {
            $id = $request->get('female');
        }
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        return view('abortions.create', compact('id', 'females'));
    }

    public function store(AbortionRequest $request)
    {
        if ($request->ajax()) {
            $abortion                = new Abortion;
            $abortion->date          = $request->date;
            $abortion->reason        = $request->reason;
            $abortion->observation   = $request->observation;
            $abortion->reproducer_id = $request->reproducer;
            $abortion->save();
            return response()->json([
                'success' => true,
                'female'  => $abortion->reproducer_id,
                'message' => message('MSG001'),
            ], 201);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }

    public function edit($id)
    {
        $abortion = Abortion::findOrFail($id);
        $id       = $abortion->reproducer_id;
        $females  = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        $data     = [
            'abortion' => $abortion,
            'females'  => $females,
        ];
        return view('abortions.edit', compact('id', 'data'));
    }

    public function update(AbortionRequest $request, $id)
    {
        if ($request->ajax()) {
            $abortion              = Abortion::find($id);
            $abortion->date        = $request->date;
            $abortion->reason      = $request->reason;
            $abortion->observation = $request->observation;
            $abortion->save();
            return response()->json([
                'success' => true,
                'female'  => $abortion->reproducer_id,
                'message' => message('MSG002'),
            ], 200);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }
}
