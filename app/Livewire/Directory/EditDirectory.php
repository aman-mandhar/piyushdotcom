<?php

namespace App\Livewire\Directory;

use Livewire\Component;
use App\Models\BusinessDirectory;
use App\Models\City;
use App\Models\User;

class EditDirectory extends Component
{
    public $directoryId;
    public $name, $address, $city_id, $mobile, $email, $video_link;
    public $business_type = []; // array for multi-checkbox
    
    public function mount($id)
    {
        $directory = BusinessDirectory::findOrFail($id);
        $this->directoryId = $directory->id;

        $this->name = $directory->name;
        $this->address = $directory->address;
        $this->city_id = $directory->city_id;
        $this->mobile = $directory->mobile;
        $this->email = $directory->email;
        $this->video_link = $directory->video_link;
        $this->business_type = explode(',', $directory->business_type); // key line for checkboxes
    }

    public function update()
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

        $directory = BusinessDirectory::findOrFail($this->directoryId);

        $directory->update([
            'name' => $this->name,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'video_link' => $this->video_link,
            'business_type' => implode(',', $this->business_type),
        ]);

        session()->flash('success', 'Business Directory updated successfully.');
        return redirect()->route('directory.index');
}


    public function render()
    {
        return view('livewire.directory.edit-directory');
    }
}
