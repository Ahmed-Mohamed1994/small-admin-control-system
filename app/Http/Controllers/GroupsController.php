<?php

namespace App\Http\Controllers;

use App\groups;
use App\Http\Requests\addGroupRequest;
use App\Http\Requests\updateGroupRequest;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        return view('groups.create');
    }

    public function store(addGroupRequest $request){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        groups::create(['name' => $request->name]);
        return redirect()->route('groups')->with(['message' => 'Group successfully created!']);
    }

    public function index(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $groups = groups::all();
        return view('groups.index',compact('groups'));
    }

    public function edit(groups $group)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        return view('groups.update', compact('group'));
    }

    public function update(groups $group, updateGroupRequest $request)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $group->update([
            'name' => $request->name
        ]);

        return redirect()->route('groups')->with(['message' => 'Group Successfully Updated!']);
    }

    public function destroy(groups $group)
    {
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $group->pages()->detach();
        $group->delete();

        return redirect()->route('groups')->with(['message' => 'Group Successfully deleted!']);
    }

    public function assign(groups $group){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $pages = Pages::all();
        return view('groups.assign',compact(['pages','group']));
    }

    public function storeAssign(groups $group,Request $request){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $this->validate($request,['checked_pages' => 'required']);
        $group->pages()->sync($request->checked_pages);
        return redirect()->route('groups')->with(['message' => 'Group Successfully Assigned!']);
    }
}
