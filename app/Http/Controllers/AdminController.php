<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.dashboard', compact('users'));
    }

    public function loadAllUsers()
    {
        $users = User::all();  // Fetch all users again for this view
        return view('admin.dashboard', compact('users')); // Ensure view name is correct
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('fail', $e->getMessage());
        }
    }

    public function getAllOrders()
    {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->get();
        
        // Optional: Log any orders without a user
        $ordersWithoutUser = $orders->filter(function($order) {
            return $order->user === null;
        });
        
        if ($ordersWithoutUser->count() > 0) {
            \Log::warning('Found ' . $ordersWithoutUser->count() . ' orders without a user', 
                $ordersWithoutUser->pluck('id')->toArray());
        }
        
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:Pending,Delivered,Cancelled'
        ]);

        try {
            $order = Order::findOrFail($orderId);
            $order->order_status = $request->input('status');
            $order->save();

            return redirect()->route('admin.orders')
                ->with('success', "Order #{$order->id} status updated to {$order->order_status}");
        } catch (\Exception $e) {
            return redirect()->route('admin.orders')
                ->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }
}
