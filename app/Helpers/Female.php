<?php
namespace App\Helpers;

use App\Reproducer;
use Illuminate\Support\Facades\DB;

class Female
{
    public static function getFemales()
    {
        $available = 0;

        $data = DB::table('reproducers as r')
            ->join('weanings as w', 'r.id', '=', 'w.reproducer_id')
            ->select('r.id', 'r.code', 'w.id as weaning', 'w.date', 'w.quantity')
            ->where('w.state', 'PENDING')
            ->get();
        $females = [];
        foreach ($data as $key => $value) {
            $suma    = 0;
            $weaning = DB::table('weanings as w')
                ->join('group_weaning as p', 'w.id', '=', 'p.weaning_id')
                ->join('groups as g', 'p.group_id', '=', 'g.id')
                ->select('p.females', 'p.males')
                ->where('w.id', $value->weaning)
                ->get();
            if ($weaning->count() > 0) {
                foreach ($weaning as $v) {
                    $suma += $v->females + $v->males;
                }
                $available = $value->quantity - $suma;
            } else {
                $available = $value->quantity;
            }
            $females[$key] = [
                'id'        => $value->id,
                'code'      => $value->code,
                'weaning'   => $value->weaning,
                'date'      => $value->date,
                'quantity'  => $value->quantity,
                'available' => $available,
            ];
        }
        return collect($females);
    }

    public static function getEventsFemale($request)
    {
        $data = Reproducer::with([
            'genetics:id,name',
            'location',
            'inseminations' => function ($query) {
                $query->select('*', DB::raw('"inseminations" as type'), DB::raw('"bg-blue-500" as color'));
                $query->with([
                    'semen:id,code',
                ]);
            },
            'weaning'       => function ($query) {
                $query->select('*', DB::raw('"weanings" as type'), DB::raw('"bg-indigo-500" as color'));
            },
            'abortions'     => function ($query) {
                $query->select('*', DB::raw('"abortions" as type'), DB::raw('"bg-orange-500" as color'));
            },
            'death'         => function ($query) {
                $query->select('*', DB::raw('"deaths" as type'), DB::raw('"bg-red-500" as color'));
            },
            'births'        => function ($query) {
                $query->select('*', DB::raw('"births" as type'), DB::raw('"bg-green-500" as color'));
            },
        ])->findOrFail($request->get('id'));
        $events          = collect($data->inseminations)->merge($data->weaning)->merge($data->abortions)->merge([$data->death])->merge($data->births);
        $flattenedEvents = $events->flatten();
        $sortedEvents    = $flattenedEvents->sortByDesc('date');
        return $sortedEvents->values()->paginate(5);
    }

    public static function getLatestEventFemale($request)
    {
        $female = Reproducer::findOrFail($request->get('id'));
        $data   = Reproducer::with([
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
        ])->findOrFail($request->get('id'));

        $events = collect($data->inseminations)->merge($data->weaning)->merge($data->abortions)->merge([$data->death])->merge($data->births)->flatten();

        $maxDate = 0;
        $latest  = null;

        foreach ($events as $event) {
            if ($event !== null) {
                $curDate = strtotime($event->date);
                if ($curDate > $maxDate) {
                    $maxDate = $curDate;
                    $latest  = $event;
                }
            }
        }
        return array('latest' => $latest, 'female' => $female);
    }
}
