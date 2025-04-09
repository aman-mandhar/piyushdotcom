<?php
namespace App\Livewire;

use App\Models\City;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class SearchProperty extends Component
{
    use WithPagination;

    // Form Filters
    public $title, $property_type, $listing_type, $city_id, $location;
    public $min_price, $max_price, $min_area, $max_area;
    public $bedrooms, $bathrooms, $furnishing_status, $facing;
    public $negotiable_price, $court_case, $with_image;

    public function render()
    {
        $query = Property::query()->latest();

        // Keyword search
        if ($this->title) {
            $query->where('property_title', 'like', '%' . $this->title . '%');
        }

        if ($this->property_type) {
            $query->where('property_type', $this->property_type);
        }

        if ($this->listing_type) {
            $query->where('listing_type', $this->listing_type);
        }

        if ($this->city_id) {
            $query->where('city_id', $this->city_id);
        }

        if ($this->location) {
            $query->where('location', 'like', '%' . $this->location . '%');
        }

        if ($this->min_price) {
            $query->where('price', '>=', $this->min_price);
        }

        if ($this->max_price) {
            $query->where('price', '<=', $this->max_price);
        }

        if ($this->min_area) {
            $query->whereRaw("CAST(REPLACE(area, ' ', '') AS UNSIGNED) >= ?", [$this->min_area]);
        }

        if ($this->max_area) {
            $query->whereRaw("CAST(REPLACE(area, ' ', '') AS UNSIGNED) <= ?", [$this->max_area]);
        }

        if ($this->bedrooms) {
            $query->where('bedrooms', '>=', $this->bedrooms);
        }

        if ($this->bathrooms) {
            $query->where('bathrooms', '>=', $this->bathrooms);
        }

        if ($this->furnishing_status) {
            $query->where('furnishing_status', $this->furnishing_status);
        }

        if ($this->facing) {
            $query->where('facing', $this->facing);
        }

        if ($this->negotiable_price !== null && $this->negotiable_price !== '') {
            $query->where('negotiable_price', $this->negotiable_price);
        }

        if ($this->court_case !== null && $this->court_case !== '') {
            $query->where('court_case', $this->court_case);
        }

        if ($this->with_image !== null && $this->with_image !== '') {
            $this->with_image
                ? $query->whereNotNull('image')
                : $query->whereNull('image');
        }

        return view('livewire.search-property', [
            'properties' => $query->paginate(10),
            'cities' => City::orderBy('name')->get(),
        ]);
    }

    public function updating($field)
    {
        $this->resetPage(); // Reset pagination when filters change
    }

    public function search()
    {
        // Optional: trigger if needed
    }
}

