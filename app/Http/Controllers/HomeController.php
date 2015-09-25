<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Index action for home page.
     *
     * @return \Illuminate\View\View
     */
	public function index(){
        return view('home.index');
    }

    /**
     * About action for about page.
     *
     * @return \Illuminate\View\View
     */
    public function about(){
        return view('home.about');
    }

}
