<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin\Cars;

use Livewire\Form;
use App\Models\Car;
use Illuminate\Support\Arr;
use App\Services\ImageService;

class CarForm extends Form
{
    public ?int $id = null;


    public string $make = '';

    public string $model = '';
    public string $color = '';

    public string $passengers = '';
    public string $gear = '';

    public string $fuel = '';
    public string $license_type = '';

    public $insurance_policy_number = '';

    public string $details = '';

    public $image = '';
    public string $type = '';

    public float $rent = 0;

    public string $is_featured = '0';
    public string $ac = '';
    public array $swal = [];

    public function rules(): array
    {
        return [
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string','max:200'],
            'insurance_policy_number' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'rent' => ['required', 'numeric'],
            'passengers' => ['required', 'numeric'],
            'gear' => ['required', 'string', 'in:Manual,Automatic'],
            'fuel' => ['required', 'string', 'in:Electric,Petrol,Hybrid,Diesel'],
            'license_type' => ['required', 'string', 'in:Standard,Heavy'],
            'is_featured' => ['required', 'boolean'],
            'ac' => ['required', 'boolean'],
        ];
    }

    /**
     * Save or update the car details.
     */
    public function save(): void
    {
        $validated = $this->validate();

        $rules = $this->rules();
        foreach ($rules as $field => $ruleSet) {
            if (in_array('nullable', $ruleSet) && empty($validated[$field])) {
                $validated[$field] = null;
            }
        }

        $car = Car::query()->findOrNew($this->id);

        $car->fill($validated);

        $car->save();

        if ($this->image !== '') {
            $this->uploadImage($car);
        }

        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Car Updated' : 'Car Saved'
        );
    }

    private function uploadImage($car)
    {
        $image = ImageService::uploadImage($this->image, 'cars', null);

        ImageService::deleteImage($car->image);

        $car->image = $image->filepath;

        $car->save();
    }


    /**
     * Set SweetAlert data with a success message.
     */
    private function setSweetAlertMessage(string $title): void
    {
        $this->swal = [
            'icon' => 'success',
            'title' => $title,
            'text' => $this->id !== null && $this->id !== 0
                ? 'The car has been updated successfully.'
                : 'A new car has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.cars.index')
        ];
    }
}
