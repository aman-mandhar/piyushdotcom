<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessDirectory;
use App\Models\Property;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\City;
use App\Models\Call;
use App\Models\CallProgress;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::with(['user', 'property', 'vehicle', 'directory', 'city'])
                     ->latest()
                     ->get();
        
        return view('calls.index', compact('calls'));
    }

    public function myCalls()
    {
        $calls = Call::with(['user', 'property', 'vehicle', 'directory', 'city'])
                     ->where('user_id', auth()->id())
                     ->latest()
                     ->get();
        
        return view('calls.my-calls', compact('calls'));
    }    
    
    public function propertyCalls()
    {
        $calls = Call::with(['user', 'property', 'city'])
                     ->whereNotNull('property_id')
                     ->latest()
                     ->get();
    
        return view('calls.property-index', compact('calls'));
    }
    
    public function vehicleCalls()
    {
        $calls = Call::with(['user', 'vehicle', 'city'])
                     ->whereNotNull('vehicle_id')
                     ->latest()
                     ->get();
    
        return view('calls.vehicle-index', compact('calls'));
    }
    
    public function directoryCalls()
    {
        $calls = Call::with(['user', 'directory', 'city'])
                     ->whereNotNull('directory_id')
                     ->latest()
                     ->get();
    
        return view('calls.directory-index', compact('calls'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'city_id' => 'nullable|exists:cities,id',
            'property_id' => 'nullable|exists:properties,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'directory_id' => 'nullable|exists:business_directories,id',
            'mobile' => 'required|string|max:20',
        ]);
    
        Call::create($request->only([
            'user_id', 'property_id', 'vehicle_id', 'directory_id', 'city_id'
        ]));
    
        return view('calls.dial', ['mobile' => $request->mobile]);
    }

    public function show($id)
    {
        $call = Call::with(['property', 'vehicle', 'directory', 'city', 'user'])->findOrFail($id);
        return view('calls.show', compact('call'));
    }

    public function employeeCalls()
    {
        $calls = Call::with(['user', 'property', 'vehicle', 'directory', 'city'])
                     ->orderBy('created_at', 'desc')
                     ->get();
        return view('calls.employee-calls', compact('calls'));
    }

    public function callProgress(Request $request)
    {
        $request->validate([
            'call_id' => 'required|exists:calls,id|unique:call_progress,call_id',
            'call_details' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
    
        $callProgress = new CallProgress();
        $callProgress->call_id = $request->call_id;
        $callProgress->call_details = $request->call_details;
        $callProgress->user_id = $request->user_id;
        $callProgress->save();
    
        return redirect()->route('employee.calls.index')->with('success', 'Call progress updated successfully.');
    }
    

    public function employeePropertyCalls()
    {
        $calls = Call::with(['user', 'property', 'city'])
                     ->where('user_id', auth()->id())
                     ->whereNotNull('property_id')
                     ->latest()
                     ->get();
    
        return view('calls.employee-property-index', compact('calls'));
    }
    public function employeeVehicleCalls()
    {
        $calls = Call::with(['user', 'vehicle', 'city'])
                     ->where('user_id', auth()->id())
                     ->whereNotNull('vehicle_id')
                     ->latest()
                     ->get();
    
        return view('calls.employee-vehicle-index', compact('calls'));
    }
    public function employeeDirectoryCalls()
    {
        $calls = Call::with(['user', 'directory', 'city'])
                     ->where('user_id', auth()->id())
                     ->whereNotNull('directory_id')
                     ->latest()
                     ->get();
    
        return view('calls.employee-directory-index', compact('calls'));
    }
}
