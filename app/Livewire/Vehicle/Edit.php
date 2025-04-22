<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $vehicle;
    public $vehicleId;

    public $owner_name, $owner_mobile, $owner_email, $owner_address, $city_id;
    public $brand, $model, $variant, $registration_number, $registration_year, $km_driven;
    public $fuel_type, $transmission, $no_of_owners, $insurance_status, $description, $price;
    public $any_accident = false, $accident_detail;
    public $loan_running = false, $loan_bank_name, $pending_emis, $emi_amount;
    public $featured_image, $new_image;

    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
        $this->vehicleId = $vehicle->id;

        $this->fill($vehicle->only([
            'owner_name', 'owner_mobile', 'owner_email', 'owner_address', 'city_id',
            'brand', 'model', 'variant', 'registration_number', 'registration_year',
            'km_driven', 'fuel_type', 'transmission', 'no_of_owners', 'insurance_status',
            'description', 'price', 'any_accident', 'accident_detail',
            'loan_running', 'loan_bank_name', 'pending_emis', 'emi_amount',
        ]));

        $this->featured_image = $vehicle->featured_image;
    }

    public function update()
    {
        $this->validate([
            'owner_name' => 'required',
            'owner_mobile' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required|numeric',
            'city_id' => 'required|exists:cities,id',
            'accident_detail' => 'required_if:any_accident,true',
            'loan_bank_name' => 'required_if:loan_running,true',
            'new_image' => 'nullable|image|max:2048',
        ]);

        if ($this->new_image) {
            $imagePath = $this->new_image->store('vehicles', 'public');
        } else {
            $imagePath = $this->featured_image;
        }

        $this->vehicle->update([
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

        session()->flash('success', 'Vehicle updated successfully!');
        return redirect()->route('vehicles.index');
    }

    public function render()
    {
        return view('livewire.vehicle.edit', [
            'cities' => City::orderBy('name')->get(),
        ]);
    }
}

