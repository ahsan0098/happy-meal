<?php

namespace App\Http\Controllers\Guest;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function stripeSuccess($reference_id, Request $request): RedirectResponse
    {
        try {

            Validator::validate([
                'session_id' => $request->query('session_id'),
            ], [
                'session_id' => 'required|unique:order_transactions,session_id',
            ], [
                'session_id.required' => 'checkout session id not found',
                'session_id.unique'   => 'checkout session already used',
            ]);

            DB::beginTransaction();
            $order = Order::where('reference_id', $reference_id)->firstOrFail();
            $transaction = OrderTransaction::insert([
                'order_id'             => $order->id,
                'session_id'         => $request->query('session_id'),
                'processed'             => true,
                'transferred_amount' => $order->bill,
            ]);


            $order->update([
                'status'      => 'placed',
            ]);

            DB::commit();

            Session::forget('cart');

            // redirect to review page
            return redirect(route('track-order', ['search' => $order->reference_id]));
        } catch (Exception $e) {

            DB::rollBack();
            \Log::error('Stripe success error: ' . $e->getMessage());
            return redirect(route('cart-items'))->with(
                'error',
                'Transaction failed, please try again.'
            );
        }
    }

    public function stripeError($reference_id): RedirectResponse
    {
        \Log::error('Stripe canceled:  '. $reference_id);

        $order = Order::where('reference_id', $reference_id)->firstOrFail();
        $orderTransaction = OrderTransaction::where('order_id', $order->id)->first();
        if ($orderTransaction) {
            $orderTransaction->delete();
        }
        $order->delete();


        return redirect(route('cart-items'))
            ->with('error', 'Transaction failed, please try again.');
    }
}
