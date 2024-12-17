<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Exception;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        try {
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
            $product = Product::findOrFail($request->product_id);

            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($newQuantity > 0) {
                    $cartItem->quantity = $newQuantity;
                    $cartItem->save();
                } else {
                    return redirect()->route('cart.show')->with('error', 'Quantity must be positive.');
                }
            } else {
                if ($request->quantity > 0) {
                    $cart->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $request->quantity,
                    ]);
                } else {
                    return redirect()->route('cart.show')->with('error', 'Quantity must be positive.');
                }
            }

            return redirect()->route('cart.show')->with('success', 'Product added to cart successfully.');
        } catch (Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Failed to add product to cart.');
        }
    }

    public function show()
    {
        try {
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
            
            $total = $cart->items->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            return view('cart.show', [
                'cart' => $cart,
                'total' => $total
            ]);
        } catch (Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Failed to retrieve cart.');
        }
    }

    public function removeProduct(Request $request)
    {
        try {
            $cart = Cart::where('user_id', auth()->id())->firstOrFail();
            $cartItem = $cart->items()->where('product_id', $request->product_id)->firstOrFail();

            $cartItem->delete();

            return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully.');
        } catch (Exception $e) {
                    return redirect()->route('cart.show')->with('error', 'Failed to remove product from cart.');
                }
            }

    public function updateQuantity(Request $request)
    {
        try {
            $cart = Cart::where('user_id', auth()->id())->firstOrFail();
            $cartItem = $cart->items()->where('product_id', $request->product_id)->firstOrFail();

            if ($request->quantity > 0) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();

                return redirect()->route('cart.show')->with('success', 'Cart item quantity updated successfully.');
            } else {
                return redirect()->route('cart.show')->with('error', 'Quantity must be positive.');
            }
        } catch (Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Failed to update cart item quantity.');
        }
    }
}