<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Visitor\Orders;

use Livewire\Form;
use App\Models\Order;
use App\Models\OrderItem;

class OrderForm extends Form
{
    public ?int $id = null;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $delivery_time = '';
    public string $status = 'pending';
    public string $bill = '';
    public string $comments = '';
    public string $reference_id = '';
    public array $swal = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'delivery_time' => ['nullable', 'string', 'max:255'],
            'bill' => ['required', 'numeric'],
            'comments' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'string', 'in:pending,rejected'],
        ];
    }

    /**
     * Save or update the order details.
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
        $order = Order::query()->findOrNew($this->id);
        $this->reference_id = $order->reference_id = $this->id !== null && $this->id !== 0
            ? $order->reference_id
            : uniqid('order_');

        $order->fill($validated);

        $order->save();

        $arr = [];
        foreach (session()->get('cart', []) as $item) {
            $arr[] = ['order_id' => $order->id, 'item_id' => $item['id']];
        }

        OrderItem::upsert(
            $arr,
            ['order_id', 'item_id'], // unique constraint columns
            [] // no columns to update on conflict
        );


        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Order Updated' : 'Order Request Submitted'
        );
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
                ? 'The order request has been updated successfully.'
                : 'Your order request submitted successfully. We will contact you soon. Have a nice day :)',
            'timer' => 3000,
            'bar' => true,
            'url' => route('home')
        ];
    }
}
