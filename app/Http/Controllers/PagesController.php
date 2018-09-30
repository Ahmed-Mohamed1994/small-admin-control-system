<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPageRequest;
use App\Http\Requests\updatePageRequest;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        return view('pages.create');
    }

    public function store(AddPageRequest $request){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        Pages::create(['name' => $request->name]);
        return redirect()->route('pages')->with(['message' => 'Page successfully created!']);
    }

    public function index(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $pages = Pages::all();
        return view('pages.index',compact('pages'));
    }

    public function edit(Pages $page)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        return view('pages.update', compact('page'));
    }

    public function update(Pages $page, updatePageRequest $request)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $page->update([
            'name' => $request->name
        ]);

        return redirect()->route('pages')->with(['message' => 'Page Successfully Updated!']);
    }

    public function destroy(Pages $page)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $page->groups()->detach();
        $page->delete();

        return redirect()->route('pages')->with(['message' => 'Page Successfully deleted!']);
    }
}
