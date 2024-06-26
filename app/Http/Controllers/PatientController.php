<?php

namespace App\Http\Controllers;

use App\Models\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Patient/Index',
        [
            'patientinfo'=>Patient::with('doctors')->latest()->get(),
            'doctorinfo'=>Doctor::get()
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
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'dob'=>'required|date',
            'contact_no'=>'required|integer',
            'medical_condition'=>'required|string',
        
        ]);
        $patient = Patient::create(["name"=>$request->name,"dob"=>$request->dob,"contact_no"=>$request->contact_no,"medical_condition"=>$request->medical_condition,]);
        $patient->doctors()->sync($request->doctors);
        return redirect(route('patient.index'));
    }

    /**
     * Display the specified resouprce.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, Patient $patient)
    {
       
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
    }
}
