<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function all()
    {
        $tags = Tag::all();
        return view('tag/all', compact('tags'));
    }

    public function index()
    {
        $tags = Tag::all();
        return view('tag/index', compact('tags'));
    }
    
    public function destroy($id)
    {
        $video = Tag::findOrFail($id);
        $video->delete();

        return redirect("/tag");
    }
}