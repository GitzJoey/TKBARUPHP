<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/22/2016
 * Time: 1:30 PM
 */

namespace App\Http\Controllers;

use App\Model\EventCalendar;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('calendar.index');
    }
}