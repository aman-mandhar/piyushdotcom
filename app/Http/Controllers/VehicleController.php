<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Call;
use App\Models\CallProgress;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Show the form for creating a new vehicle (Livewire loaded via Blade).
     */
    public function create()
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login to post a vehicle.');
        }
        return view('vehicles.create');
    }


    /**
     * Show all vehicles posted by the logged-in user.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show My vehicles of customers.
     */
    public function myVehicles()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->latest()->paginate(15);
        return view('vehicles.my-vehicles', compact('vehicles'));
    }

    /**
     * Show a single vehicle by slug (for public view).
     */
    public function show($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->firstOrFail();
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show all vehicles (for public view).
     */
    public function showAll($id)
    {
        $callProgress = CallProgress::where('call_id', $id)->first(); // Use first(), not firstOrFail()
    
        if ($callProgress) {
            return redirect()->back()->with('error', 'Call has already been made.');
        }
    
        // Forget session call
        $call = session('call', []);
        // Get New call
        $call = Call::where('id', $id)->firstOrFail();
        // Put call in session
        session(['call' => $call]);
        $vehicle = Vehicle::where('id', $call->vehicle_id)->firstOrFail();
    
        return view('vehicles.show-all', compact('call', 'vehicle'));
    }
    

    /**
     * Admin: View all vehicles.
     */
    public function adminIndex()
    {
        $vehicles = Vehicle::latest()->paginate(15);
        return view('vehicles.admin-index', compact('vehicles'));
    }

    /**
     * Admin: Approve vehicle.
     */
    public function approve(Vehicle $vehicle)
    {
        $vehicle->status = 'approved';
        $vehicle->is_verified = true;
        $vehicle->save();

        return redirect()->back()->with('success', 'Vehicle approved.');
    }

    /**
     * Admin: Reject vehicle.
     */
    public function reject(Vehicle $vehicle)
    {
        $vehicle->status = 'rejected';
        $vehicle->save();

        return redirect()->back()->with('error', 'Vehicle rejected.');
    }

    public function edit($id)
    {
        $vehicle = \App\Models\Vehicle::findOrFail($id);

        if ($vehicle->user_id !== auth()->id()) {
            abort(403); // Unauthorized
        }

        return view('vehicles.edit', compact('vehicle'));
    }

    public function destroy($id)
    {
        $vehicle = \App\Models\Vehicle::findOrFail($id);

        if ($vehicle->user_id !== auth()->id()) {
            abort(403); // Unauthorized
        }

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}