<?php

namespace App\Livewire\Visitor;

use Exception;
use Stripe\Stripe;
use Livewire\Component;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\Visitor\Orders\OrderForm;

#[Title('Checkout')]
#[Layout('layouts.visitor.app')]
class PlaceOrder extends Component
{

    public OrderForm $form;

    public function mount(){
        $total = 0.00;

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart-items');
        }
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }


        $this->form->bill = number_format($total + config('setting.site_general_delivery_charges', 0), 2);
         
    }
    
    public function save()
    {
        try {
            $this->form->validate();

            $this->form->save();

            $cart = session('cart', []);

            Stripe::setApiKey(config('services.stripe.secret'));

            $lineItems = [];

            foreach ($cart as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'pkr',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $item['price'] * 100, // in cents
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
                'success_url' => route('checkout.success', $this->form->reference_id) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel', $this->form->reference_id),
            ]);


            return redirect($checkoutSession->url);
        } catch (Exception $e) {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 
                $e->getMessage(),
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
