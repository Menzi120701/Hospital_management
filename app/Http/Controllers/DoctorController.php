<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia :: render('Doctor/Index',
        [
           'doctorinfo' => Doctor::with(['department','patients'])->latest()->get(),
           'departmentinfo' => Department::get(),
           'patientinfo'=> Patient::latest()->get()
           
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
            'name' => 'required|string|max:255',
            'contact_no' =>'required|integer',
            'department_id'=>'required|exists:departments,id',
           
        ]);
 
        // $request->user()->department()->create($validated);
        $doctorinfo = Doctor::create(["name"=>$request->name,"contact_no"=>$request->contact_no,"department_id"=>$request->department_id]);
        $doctorinfo->patients()->attach($request->patients);
 
        return redirect(route('doctor.index'));  
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
    }
}
