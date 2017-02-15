<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface GiroService
{

    /**
     * Get all giros that will be due in given number of days.
     *
     * @param int $dayToDue number of days before giro is due.
     * @return Collection
     */
    public function getDueGiro($dayToDue = 1);
}