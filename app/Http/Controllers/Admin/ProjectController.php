<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $formData = $request->validated();
        //CREATE SLUG
        $slug = Project::getSlug($formData['title']);
        //add slug to formData
        $formData['slug'] = $slug;
        //prendiamo l'id dell'utente loggato
        $userId = Auth::id();
        //dd($userId);
        //aggiungiamo l'id dell'utente
        $formData['user_id'] = $userId;


        if ($request->hasFile('preview')) {
            $img_path = Storage::put('images', $request->preview);
            $formData['preview'] = $img_path;
        }
        $project = Project::create($formData);
        return redirect()->route('admin.projects.show', $project->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $formData = $request->validated();
        //CREATE SLUG
        if ($project->title !== $formData['title']) {
            $slug = Project::getSlug($formData['title']);

        }
        //add slug to formData
        $formData['slug'] = $slug;
        if ($request->hasFile('preview')) {
            if ($project->preview) {
                Storage::delete($project->preview);
            }
            $img_path = Storage::put('images', $formData['preview']);
            $formData['preview'] = $img_path;
        }

        //aggiungiamo l'id dell'utente proprietario del post
        $formData['user_id'] = $project->user_id;

        $project->update($formData);
        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('message', "$project->title eliminato con successo");
    }
}
