<?php

namespace App\Services\Implementation;

use App\Model\Giro;

use App\Services\GiroService;

use Carbon\Carbon;

class GiroServiceImpl implements GiroService
{

    /**
     * Get all giros that will be due in given number of days.
     *
     * @param int $dayToDue number of days before giro is due.
     * @return Collection
     */
    public function getDueGiro($dayToDue = 1)
    {
        $avaiableGiros = Giro::with('bank')->where('status', '<>', 'GIROSTATUS.R')->get();

        $targetDate = Carbon::today()->addDays($dayToDue);

        $almostDueGiros = $avaiableGiros->filter(function($giro, $key) use ($targetDate){
            return $targetDate->gte(Carbon::parse($giro->effective_date));
        });

        return $almostDueGiros;
    }
}