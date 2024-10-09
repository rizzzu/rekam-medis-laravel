<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function indexMedicalRecords()
    {
        $medicalRecords = MedicalRecord::where('doctor_id', Auth::id())->with('patient')->get();
        return view('doctor.medical_records.index', compact('medicalRecords'));
    }

    public function createMedicalRecord()
    {
        $patients = Patient::all();
        return view('doctor.medical_records.create', compact('patients'));
    }

    public function storeMedicalRecord(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
        ]);

        MedicalRecord::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
        ]);

        return redirect()->route('doctor.medical_records.index')->with('success', 'Medical record created successfully.');
    }
}
