<?php

namespace App\Http\Controllers;

use App\Models\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $entidades = Entities::with('user')->get();
       return view('entidades.index', compact('entidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:entities,name',
            'entity' => 'required|in:public,private',
            'administrative_unit' => 'nullable|string|max:255',
            'producer_office' => 'nullable|string|max:255',
        ]);

        Entities::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'entity' => $request->entity,
            'administrative_unit' => $request->administrative_unit,
            'producer_office' => $request->producer_office,
        ]);

        return redirect()->route('entidades.index')->with('success', 'Entidad creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(entities $entities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(entities $entities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, entities $entities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(entities $entities)
    {
        //
    }
}
