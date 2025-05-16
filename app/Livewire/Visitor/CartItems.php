<?php

namespace App\Livewire\Visitor;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Cart Items')]
#[Layout('layouts.visitor.app')]
class CartItems extends Component
{

    public function removeFromCart(Item $item)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            unset($cart[$item->id]);
            session()->put('cart', $cart);
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'Item Removed from Cart',
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.visitor.cart-items');
    }
}
