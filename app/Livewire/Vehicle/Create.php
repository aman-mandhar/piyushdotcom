<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $owner_name, $owner_mobile, $owner_email, $owner_address, $city_id;

    public $brand, $model, $variant, $registration_number, $registration_year, $km_driven;
    public $fuel_type, $transmission, $no_of_owners, $insurance_status, $description, $price;

    public $any_accident = false, $accident_detail;
    public $loan_running = false, $loan_bank_name, $pending_emis, $emi_amount;

    public $featured_image;

    public function mount()
    {
        $user = Auth::user();
        $this->owner_name = $user->name ?? '';
        $this->owner_mobile = $user->mobile ?? '';
        $this->owner_email = $user->email ?? '';
    }

    public function save()
    {
        $this->validate([
            'owner_name' => 'required|string|max:255',
            'owner_mobile' => 'required|string|max:15',
            'owner_email' => 'nullable|email',
            'owner_address' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',

            'brand' => 'required|string',
            'model' => 'required|string',
            'variant' => 'nullable|string',
            'registration_number' => 'nullable|string',
            'registration_year' => 'nullable|digits:4',
            'km_driven' => 'nullable|integer',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'no_of_owners' => 'nullable|integer',
            'insurance_status' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',

            'accident_detail' => 'required_if:any_accident,true',
            'loan_bank_name' => 'required_if:loan_running,true',
            'pending_emis' => 'nullable|integer',
            'emi_amount' => 'nullable|numeric',

            'featured_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->featured_image?->store('vehicles', 'public');

        Vehicle::create([
            'user_id' => Auth::id(),
            'owner_name' => $this->owner_name,
            'owner_mobile' => $this->owner_mobile,
            'owner_email' => $this->owner_email,
            'owner_address' => $this->owner_address,
            'city_id' => $this->city_id,

            'brand' => $this->brand,
            'model' => $this->model,
            'variant' => $this->variant,
            'registration_number' => $this->registration_number,
            'registration_year' => $this->registration_year,
            'km_driven' => $this->km_driven,
            'fuel_type' => $this->fuel_type,
            'transmission' => $this->transmission,
            'no_of_owners' => $this->no_of_owners,
            'insurance_status' => $this->insurance_status,
            'description' => $this->description,
            'price' => $this->price,

            'any_accident' => $this->any_accident,
            'accident_detail' => $this->accident_detail,

            'loan_running' => $this->loan_running,
            'loan_bank_name' => $this->loan_bank_name,
            'pending_emis' => $this->pending_emis,
            'emi_amount' => $this->emi_amount,

            'featured_image' => $imagePath,
        ]);

        session()->flash('success', 'Vehicle added successfully!');
        return redirect()->route('vehicles.my-vehiclesdashboard');
    }

    public function render()
    {
        return view('livewire.vehicle.create', [
            'cities' => City::orderBy('name')->get(),
        ]);
    }
}

