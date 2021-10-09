<?php

namespace App\Http\Controllers;

use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Posts::orderByDesc('created_at')->get();
        $posts = DB::table('posts')
            ->orderByDesc('created_at')
            ->select('id',
                    'title',
                    'description',
                    DB::raw('(SELECT COUNT(id) FROM likes WHERE post_id=posts.id) AS Likes'))
            ->get();

        return view('home', ['posts' => $posts]);
    }
}
