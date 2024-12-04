<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PostController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Post/Index');
    }

    public function show()
    {
        // return Inertia::render('Post/Show');
    }
}
