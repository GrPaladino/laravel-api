<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
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
            ->paginate(8);

        foreach ($projects as $project) {
            $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
            $project->description = $project->getAbstract(30);
        }
        return response()->json([
            'result' => $projects,
            'success' => true,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::select(['id', 'type_id', 'user_id', 'title', 'description', 'github_url', 'image', 'slug'])
            ->where('slug', $slug)
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->first();

        if (empty($project)) {
            return response()->json([
                'message' => 'project non found',
                'success' => false,
            ]);
        }

        $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;


        return response()->json([
            'result' => $project,
            'success' => true,
        ]);
    }

    /**
     * Display a listing of the resource filtered by technology_id.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectByType($type_id)
    {

        $type = Type::find($type_id);

        if (!$type) {
            return response()->json([
                'message' => 'type non found',
                'success' => false,
            ]);
        }

        $projects = Project::select(['id', 'type_id', 'user_id', 'title', 'description', 'github_url', 'image', 'slug'])
            ->where('type_id', $type_id)
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->orderBy('id', 'DESC')
            ->paginate(8);

        foreach ($projects as $project) {
            $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
            $project->description = $project->getAbstract(30);
        }
        return response()->json([
            'result' => $projects,
            'type' => $type,
            'success' => true,
        ]);
    }
}
