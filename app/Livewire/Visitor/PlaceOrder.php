<?php

namespace App\Livewire\Visitor;

use Exception;
use Stripe\Stripe;
use Livewire\Component;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Checkout')]
#[Layout('layouts.visitor.app')]
class PlaceOrder extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $delivery_time = '';
    public string $status = 'pending';
    public string $bill = '';
    public string $comments = '';
    public string $reference_id = '';

    public function mount()
    {
        $total = 0.00;

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart-items');
        }
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $delivery = config('setting.site_general_delivery_charges', 0);
        $bill = $total + $delivery;

        if ($bill < 150) {

            return redirect()->route('cart-items')->with([
                'error' => 'The minimum order amount must be at least ₨150 due to payment gateway restrictions.',
            ]);
        }

        $this->name = auth()->user()?->name ?? '';
        $this->bill = number_format($bill, 2);
    }


    protected function rules(): array
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

    public function save()
    {
        try {
            $validated = $this->validate();

            // Ensure nullable fields are null if empty
            foreach (['delivery_time', 'comments'] as $nullableField) {
                if (empty($validated[$nullableField])) {
                    $validated[$nullableField] = null;
                }
            }

            // Create a new Order
            $order = new Order();
            $this->reference_id = $order->reference_id = uniqid('order_');
            $order->fill($validated);
            $order->save();

            // Attach order items from cart
            $arr = [];
            foreach (session('cart', []) as $item) {
                $arr[] = ['order_id' => $order->id, 'item_id' => $item['id']];
            }

            OrderItem::upsert($arr, ['order_id', 'item_id']);

            // Stripe checkout
            Stripe::setApiKey(config('services.stripe.secret'));
            $lineItems = [];

            foreach (session('cart', []) as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'pkr',
                        'product_data' => ['name' => $item['name']],
                        'unit_amount' => $item['price'] * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $this->dispatch('swal:alert', [
                'icon' => 'info',
                'title' => 'Wait',
                'text' => 'You are being redirected to payment gateway',
            ]);

            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', $this->reference_id) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel', $this->reference_id),
            ]);

            return redirect($checkoutSession->url);
        } catch (Exception $e) {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => $e->getMessage(),
                'timer' => 5000,
                'bar' => true,
                'reload' => true,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.visitor.place-order');
    }
}
