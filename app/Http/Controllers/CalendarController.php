<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/22/2016
 * Time: 1:30 PM
 */

namespace App\Http\Controllers;

use App\User;
use App\Model\EventCalendar;

use Auth;
use Illuminate\Http\Request;

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

    public function retrieveEvents()
    {
        $user = User::with('eventCalendars')->where('id', '=', Auth::user()->id);

        dd($user);

        return $user;
    }

    public function storeEvent(Request $request)
    {
        $user = User::whereId(Auth::user()->id);

        $event = new EventCalendar();

        $event->event_title = $request->input('event_title');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->ext_url = $request->input('ext_url');

        $user->eventCalendars()->save($event);

        return redirect()->route('db.user.calendar.show');
    }
}