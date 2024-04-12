<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $projects = Project::all();

        $types = Type::paginate(10);
        return view('admin.types.index', compact('types', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Type $type)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        return view('admin.types.form', compact('type'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        $request->validated();
        $data = $request->all();
        $type = new Type;
        $type->fill($data);

        $type->save();
        return redirect()->route('admin.types.show', compact('type'))->with('message-class', 'alert-success')->with('message', 'Tipologia inserita correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {

        if (Auth::user()->role != 'admin') {
            $projects = Project::where('user_id', '=', Auth::user()->id)->paginate(10);
        } else {
            $projects = Project::paginate(10);

        }


        return view('admin.types.show', compact('type', 'projects'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        return view('admin.types.form', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(Request $request, Type $type)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        $request->validated();
        $data = $request->all();
        $type->update($data);
        return redirect()->route('admin.types.show', $type)->with('message-class', 'alert-success')->with('message', 'Tipologia modificata correttamente.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     */
    public function destroy(Type $type)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        foreach ($type->projects as $project) {
            $project->delete();
        }

        $type->delete();
        return redirect()->route('admin.projects.index')->with('message-class', 'alert-danger')->with('message', 'Progetto eliminato correttamente.');

    }
}