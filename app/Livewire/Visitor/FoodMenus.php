<?php

namespace App\Livewire\Visitor;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Title('Food Menus')]
#[Layout('layouts.visitor.app')]
class FoodMenus extends Component
{

    #[Computed]
    public function menus()
    {
        return \App\Models\Menu::with(['items' => function ($query) {
            $query->where('is_available', true);
        }])->orderByDesc('is_featured')->get();
    }

    public function addToCart($item)
    {


        $cart = session()->get('cart', []);

        if (isset($cart[$item['id']])) {
            $cart[$item['id']]['quantity']++;
        } else {
            $cart[$item['id']] = [
                ...$item,
                'quantity'=>1
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
        return view('livewire.visitor.food-menus');
    }
}
