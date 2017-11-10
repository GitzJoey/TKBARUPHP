<?php
/**
 * Created by PhpStorm.
 * User: gitzj
 * Date: 11/9/2017
 * Time: 12:15 PM
 */

namespace App\Http\Controllers;

use Request;

class DailyLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('daily_log.index');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }
}