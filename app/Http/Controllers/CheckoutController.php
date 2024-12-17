<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    public function processCheckout(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        try {
            // Retrieve the user's cart
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();

            // Prepare Stripe line items
            $lineItems = $cart->items->map(function ($item) {
                if (!$item->product) {
                    throw new \Exception("Product not found for cart item.");
                }
                return [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => ['name' => $item->product->name],
                        'unit_amount' => $item->product->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
            })->toArray();

            // Create a Stripe Checkout session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart.show'),
                'metadata' => array_merge($validatedData, ['user_id' => Auth::id()]),
            ]);

            // Store session ID for later verification
            session(['stripe_checkout_session_id' => $session->id]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function handleSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        try {
            $session = Session::retrieve($sessionId);

            if ($session->id !== session('stripe_checkout_session_id')) {
                return redirect()->route('cart.show')->with('error', 'Invalid checkout session.');
            }

            // Retrieve user's cart
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();

            // Create an order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $session->amount_total / 100, // Convert to major currency
                'payment_status' => 'paid',
                'payment_method' => 'stripe',
                'transaction_id' => $session->payment_intent,
                'shipping_name' => $session->metadata->customer_name,
                'shipping_phone' => $session->metadata->mobile_number,
                'shipping_address' => $session->metadata->address,
                'shipping_city' => $session->metadata->city,
                'shipping_postal_code' => $session->metadata->postal_code,
            ]);

            // Save order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);
            }

            // Clear the cart
            $cart->items()->delete();

            // Clear session data
            session()->forget('stripe_checkout_session_id');

            return redirect()->route('orders.dashboard')->with('success', 'Payment successful! Your order has been placed.');
        } catch (\Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    public function getUserOrders()
    {
        try {
            $orders = Order::where('user_id', Auth::id())
                ->with('orderItems.product')
                ->get();

            return view('orders.dashboard', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to fetch orders: ' . $e->getMessage());
        }
    }
}
