<?php

namespace App\Livewire\Visitor\Partials;

use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FeaturedItems extends Component
{

    #[Computed]
    public function items()
    {
        return Item::orderByDesc('is_featured')->limit(9)->get();
    }

    public function addToCart($item)
    {


        $cart = session()->get('cart', []);

        if (isset($cart[$item['id']])) {
            $cart[$item['id']]['quantity']++;
        } else {
            $cart[$item['id']] = [
                ...$item,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Item Added to Cart',
        ]);
    }
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
        return view('livewire.visitor.partials.featured-items');
    }
}
