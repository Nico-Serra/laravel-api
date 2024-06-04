<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies', 'type')->OrderByDesc('id')->paginate(6);
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function latest()
    {
        $projects = Project::with('technologies', 'type')->orderByDesc('id')->take(3)->get();

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }


    public function show($slug)
    {
        $projects = Project::with('technologies', 'type')->where('slug', $slug)->first();

        // dd($projects);

        if ($projects) {
            return response()->json([
                'success' => true,
                'response' => $projects
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'Error 404 not found'
            ]);
        }
    }
}
