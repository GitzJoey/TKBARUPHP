<?php

namespace App\Repos;

use Doctrine\Common\Collections\Collection;
use Illuminate\Support\Facades\Cache;

use App\Model\Lookup;

class LookupRepo
{
    /**
     * Get a list of values in lookups table which have the given category from a cache,
     * fetch a new one from db if not cached yet.
     *
     * @param string $category category of the lookup
     * @return Collection a collection containing the description and code
     */
    public static function findByCategory($category)
    {
        $lookups = Cache::remember('lookups_by_category_' . $category, 10, function () use ($category) {
            return Lookup::where('category', '=', $category)->get(['code', 'description']);
        });
        return $lookups;
    }
}
