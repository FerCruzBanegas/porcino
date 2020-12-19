<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use App\Weaning;
use Illuminate\Support\Facades\DB;

//use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function checkQuantityWeaning($quantity, $available, $females, $males)
    {
        $diff    = $quantity - $available;
        $piglets = $females + $males;
        $total   = $diff + $piglets;
        if ($total == $quantity) {
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        $females = \Female::getFemales();
        return view('groups.create', compact('females'));
    }

    public function store(GroupRequest $request)
    {
        DB::beginTransaction();
        try {
            $group = Group::create([
                'date'        => $request->date,
                'code'        => $request->code,
                'observation' => $request->observation,
                'location_id' => $request->location,
            ]);

            $weaning = array();
            foreach ($request->items as $key => $value) {
                $weaning[$value['weaning']] = ['females' => $value['females'], 'males' => $value['males']];

                $check = $this->checkQuantityWeaning($value['quantity'], $value['available'], $value['females'], $value['males']);
                if ($check) {
                    $update        = Weaning::find($value['weaning']);
                    $update->state = 'ADMITTED';
                    $update->save();
                }
            }
            $group->weaning()->attach($weaning);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => message('MSG010')], 500);
        }
        return response()->json([
            'success' => true,
            'group'   => $group->id,
            'message' => message('MSG001'),
        ], 201);
    }

    public function edit($id)
    {
        $group = Group::find($id);
        return view('groups.edit', compact('post', 'categories', 'tags'));
    }
}
