<?php

namespace App\Http\Controllers;

use App\Models\entities;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       $entidades = entities::all();
       return view('entidades.index', compact('entidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
