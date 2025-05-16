<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin\Reviews;

use Livewire\Form;
use App\Models\Review;
use App\Services\ImageService;

class ReviewForm extends Form
{
    public ?int $id = null;


    public string $name = '';

    public string $email = '';
    public string $message = '';

    public string $rating = '';
    public $image = '';
    public string $status = 'pending';
    public array $swal = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'numeric', 'max:5', 'min:1'],
            'message' => ['required', 'string'],
            'status' => ['required', 'string', 'in:approved,pending,rejected'],
        ];
    }

    /**
     * Save or update the review details.
     */
    public function save(): void
    {
        $validated = $this->validate();

        $review = Review::query()->findOrNew($this->id);

        $review->fill($validated);

        $review->save();

        if ($this->image !== '') {
            $this->uploadImage($review);
        }

        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Review Updated' : 'Review Saved'
        );
    }

    private function uploadImage($review)
    {
        $image = ImageService::uploadImage($this->image, 'reviews', null);

        ImageService::deleteImage($review->image);

        $review->image = $image->filepath;

        $review->save();
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
                ? 'The review has been updated successfully.'
                : 'A new review has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.reviews.index')
        ];
    }
}
