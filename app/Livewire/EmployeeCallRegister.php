<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class EmployeeCallRegister extends Component
{
    public $callRegister;
    public $call;
    
    public function mount()
    {
        $this->call = session('call', []);
        $userId = collect($this->call)->pluck('user_id')->toArray();

        $this->callRegister = DB::table('call_progress')
            ->join('calls', 'call_progress.call_id', '=', 'calls.id')
            ->join('users', 'calls.user_id', '=', 'users.id')
            ->leftJoin('properties', 'calls.property_id', '=', 'properties.id')
            ->leftJoin('vehicles', 'calls.vehicle_id', '=', 'vehicles.id')
            ->leftJoin('business_directories', 'calls.directory_id', '=', 'business_directories.id')
            ->leftJoin('cities', 'calls.city_id', '=', 'cities.id')
            ->select(
                'call_progress.call_details',
                'calls.id as call_id',
                'calls.created_at as call_date',
                'users.name as user_name',
                'users.mobile_number',
                'properties.property_title',
                'vehicles.model as vehicle_model',
                'business_directories.name as directory_name',
                'cities.name as city_name'
            )
            ->where('calls.user_id', $this->call->user_id)
            ->orderBy('call_progress.created_at', 'desc')
            ->get();
    }

    
    public function render()
    {
        return view('livewire.employee-call-register');
    }
}
