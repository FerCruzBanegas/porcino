<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaningRequest;
use App\Reproducer;
use App\Weaning;
use Illuminate\Http\Request;

class WeaningController extends Controller
{
    public function create(Request $request)
    {
        $id = 0;
        if ($request->has('female')) {
            $id = $request->get('female');
        }
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        return view('weaning.create', compact('id', 'females'));
    }

    public function store(WeaningRequest $request)
    {
        if ($request->ajax()) {
            $weaning                = new Weaning;
            $weaning->date          = $request->date;
            $weaning->quantity      = $request->quantity;
            $weaning->weight        = $request->weight;
            $weaning->average       = $request->average;
            $weaning->observation   = $request->observation;
            $weaning->reproducer_id = $request->reproducer;
            $weaning->save();
            return response()->json([
                'success' => true,
                'female'  => $weaning->reproducer_id,
                'message' => message('MSG001'),
            ], 201);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }

    public function edit($id)
    {
        $weaning = Weaning::findOrFail($id);
        $id      = $weaning->reproducer_id;
        $females = Reproducer::orderBy('id', 'DESC')->select('id', 'code')->where('sex', 'HEMBRA')->get();
        $data    = [
            'weaning' => $weaning,
            'females' => $females,
        ];
        return view('weaning.edit', compact('id', 'data'));
    }

    public function update(WeaningRequest $request, $id)
    {
        if ($request->ajax()) {
            $weaning              = Weaning::find($id);
            $weaning->date        = $request->date;
            $weaning->quantity    = $request->quantity;
            $weaning->weight      = $request->weight;
            $weaning->average     = $request->average;
            $weaning->observation = $request->observation;
            $weaning->save();
            return response()->json([
                'success' => true,
                'female'  => $weaning->reproducer_id,
                'message' => message('MSG002'),
            ], 200);
        }
        return response()->json(['message' => message('MSG009')], 401);
    }
}
