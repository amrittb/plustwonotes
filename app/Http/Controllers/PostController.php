<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PostController extends Controller {
    /**
     * Displays a list of posts for Administrators.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $posts = new \stdClass();

        return view('posts.admin.index',compact('posts'));
    }
}
