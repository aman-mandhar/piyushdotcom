<?php

namespace App\Livewire\Directory;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\BusinessDirectory;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class CreateDirectory extends Component
{
    use WithFileUploads;

    public $name, $address, $city_id, $mobile, $email, $video_link;
    public $business_type = []; // Will hold array of selected types


    public function render()
    {
        return view('livewire.directory.create-directory', [
            'cities' => City::all(),
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'business_type' => 'required|array|min:1',
            'video_link' => 'nullable|url|max:255',
        ]);

        BusinessDirectory::create([
            'name' => $this->name,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'business_type' => implode(',', $this->business_type),
            'video_link' => $this->video_link,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Business Directory created successfully.');
        $this->reset(); // Clear fields
        return redirect()->route('directory.index');
    }
}

