<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 4/8/2017
 * Time: 8:51 PM
 */

namespace App\Http\Controllers;


class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $result = null;

        if (!is_null($request->query('term'))) {

        }

        return view('search.result', compact('result'));
    }
}