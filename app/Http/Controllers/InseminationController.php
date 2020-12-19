<?php

namespace App\Http\Controllers;

use App\Http\Requests\InseminationRequest;
use App\Insemination;
use App\Reproducer;
use App\Semen;
use Illuminate\Http\Request;

class InseminationController extends Controller
{
    public function create(Request $request)
    {
        $id = 0;
        if ($request->has('female')) {
            $id = $request->get('female');
        }
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        $semen   = Semen::orderBy('id', 'DESC')->select('id', 'code')->get();
        $data    = [
            'females' => $females,
            'semen'   => $semen,
        ];
        return view('inseminations.create', compact('id', 'data'));
    }

    public function store(InseminationRequest $request)
    {
        if ($request->ajax()) {
            $insemination                = new Insemination;
            $insemination->date          = $request->date;
            $insemination->time          = $request->time;
            $insemination->dose          = $request->doses;
            $insemination->observation   = $request->observation;
            $insemination->reproducer_id = $request->reproducer;
            $insemination->semen_id      = $request->semen;
            $insemination->save();
            return response()->json([
                'success' => true,
                'female'  => $insemination->reproducer_id,
                'message' => message('MSG001'),
            ], 201);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }

    public function edit($id)
    {
        $insemination = Insemination::findOrFail($id);
        $id           = $insemination->reproducer_id;
        $females      = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        $semen        = Semen::orderBy('id', 'DESC')->select('id', 'code')->get();
        $data         = [
            'insemination' => $insemination,
            'females'      => $females,
            'semen'        => $semen,
        ];
        return view('inseminations.edit', compact('id', 'data'));
    }

    public function update(InseminationRequest $request, $id)
    {
        if ($request->ajax()) {
            $insemination              = Insemination::find($id);
            $insemination->date        = $request->date;
            $insemination->time        = $request->time;
            $insemination->dose        = $request->dose;
            $insemination->observation = $request->observation;
            $insemination->semen_id    = $request->semen;
            $insemination->save();
            return response()->json([
                'success' => true,
                'female'  => $insemination->reproducer_id,
                'message' => message('MSG002'),
            ], 200);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }
}
