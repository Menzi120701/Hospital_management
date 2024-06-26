<?php

namespace App\Http\Controllers;

use App\Models\Medical_Condition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Medical_Condition/Index',[
            'medical_conditions'=> Medical_Condition::latest()->get()
        ]);
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
        $validated=$request->validate([
            'medical_condition'=>'required|string|max:255',
        ]);
        $medical_condition = Medical_Condition::create(["medical_condition"=>$request->medical_condition]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medical_Condition $medical_Condition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medical_Condition $medical_Condition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medical_Condition $medical_Condition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medical_Condition $medical_condition)
    {
        $medical_condition->delete();
    }
}
