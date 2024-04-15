<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select(['id', 'type_id', 'user_id', 'title', 'description', 'github_url', 'image', 'slug'])
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->orderBy('id', 'DESC')
            ->paginate();

        foreach ($projects as $project) {
            $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
            $project->description = $project->getAbstract(30);
        }
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::select(['id', 'type_id', 'user_id', 'title', 'description', 'github_url', 'image', 'slug'])
            ->where('id', $id)
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->first();

        $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
        // $project->author = "graziano";


        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
