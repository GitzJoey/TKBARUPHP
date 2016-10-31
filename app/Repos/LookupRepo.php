<?php

namespace App\Repos;

use Illuminate\Support\Facades\Cache;
use App\Model\Lookup;

class LookupRepo
{
    public function findByCategory($category)
    {
    	$lookups = Cache::remember('lookups_by_category_'.$category, 10, function() use($category) {
		    return Lookup::where('category', '=', $category)->get()->pluck('description', 'code');
		});
    	return $lookups;
    }
}
