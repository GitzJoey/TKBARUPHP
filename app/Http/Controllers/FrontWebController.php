<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/18/2016
 * Time: 11:09 PM
 */

namespace App\Http\Controllers;


class FrontWebController extends Controller
{
    public function index()
    {
        return view('frontweb.index');
    }
}