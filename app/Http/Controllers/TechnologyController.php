<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $projects = Project::all();
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies', 'projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Technology $technology)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreTechnologyRequest $request)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        $request->validated();
        $data = $request->all();
        $technology = new Technology;
        $technology->fill($data);

        $technology->save();
        return redirect()->route('admin.technologies.show', compact('technology'))->with('message-class', 'alert-success')->with('message', 'Tecnologia inserita correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function show(Technology $technology)
    {
        if (Auth::user()->role != 'admin') {
            $projects = Project::where('user_id', '=', Auth::user()->id)->paginate(10);
        } else {
            $projects = Project::paginate(10);

        }


        return view('admin.technologies.show', compact('technology', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function edit(Technology $technology)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        $request->validated();
        $data = $request->all();
        $technology->update($data);
        return redirect()->route('admin.technologies.show', $technology)->with('message-class', 'alert-success')->with('message', 'Tecnologia modificata correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function destroy(Technology $technology)
    {
        if (Auth::user()->role != "admin")
            abort(403);

        foreach ($technology->projects as $project) {
            $project->delete();
        }

        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message-class', 'alert-danger')->with('message', 'Tecnologia eliminata correttamente.');
    }
}
