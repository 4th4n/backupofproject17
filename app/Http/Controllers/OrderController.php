<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $order = session()->get('order', []);

        // Calculate total amount
        $totalAmount = collect($order)->sum(function($details) {
            return $details['price'] * $details['quantity'];
        });

        return view('kiosk.index', compact('items', 'order', 'totalAmount'));
    }

    public function addToOrder(Request $request)
    {
        $item = Item::find($request->item_id);
    
        // Check if the item exists and is not out of stock
        if (!$item || $item->quantity <= 0) {
            return redirect()->back()->with('error', 'Item is out of stock.');
        }
    
        // Get current order from session
        $order = session()->get('order', []);
    
        // Add item or update quantity
        if (isset($order[$item->id])) {
            // Check if the new quantity exceeds the available stock
            if ($order[$item->id]['quantity'] + 1 > $item->quantity) {
                return redirect()->back()->with('error', 'Not enough stock available for this item.');
            }
            $order[$item->id]['quantity']++;
        } else {
            $order[$item->id] = [
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => 1
            ];
        }
    
        session()->put('order', $order);
    
        return redirect()->back()->with('success', 'Item added to order.');
    }
    public function removeFromOrder(Request $request)
    {
        $order = session()->get('order');

        if(isset($order[$request->item_id])) {
            unset($order[$request->item_id]);
            session()->put('order', $order);
        }

        return redirect()->back()->with('success', 'Item removed from order.');
    }

    public function checkout()
{
    // Get order from session
    $orderData = session('order');

    if (!$orderData) {
        return redirect()->route('kiosk.index')->with('error', 'Walang order na available.');
    }

    // Calculate total price
    $totalPrice = collect($orderData)->sum(function($details) {
        return $details['price'] * $details['quantity'];
    });

    // Save order to database
    $newOrder = Order::create(['total_price' => $totalPrice]);

    foreach ($orderData as $itemId => $details) {
        // Save each item in the OrderItem table
        OrderItem::create([
            'order_id' => $newOrder->id,
            'item_id' => $itemId,
            'quantity' => $details['quantity'],
            'price' => $details['price'],
        ]);

        // Update item quantity in the inventory
        $item = Item::find($itemId);

        if ($item) {
            $item->quantity -= $details['quantity'];

            // Ensure quantity is not negative
            if ($item->quantity < 0) {
                return redirect()->route('kiosk.index')->with('error', 'Ang order ay hindi pwedeng magpatuloy dahil sa kakulangan ng stock.');
            }

            $item->save();
        }
    }

    // Clear session
    Session::forget('order');

    // Redirect to main menu after checkout
    return redirect()->route('kiosk.index')->with('success', 'Order na-save, naka-checkout na, at nabawas na ang stock!');
}


    public function viewOrders()
    {
        // Get all orders with items
        $orders = Order::with('items')->get();

        return view('admin.orders', compact('orders'));
    }

    public function update(Request $request)
    {
        $order = session()->get('order');

        if ($order) {
            $itemId = $request->input('item_id');
            $quantity = $request->input('quantity');

            // Ensure quantity is valid
            if ($quantity > 0) {
                $order[$itemId]['quantity'] = $quantity;
                session()->put('order', $order);
            }
        }

        return redirect()->back();
    }
 
    
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->completed = request()->has('completed');
        $order->save();
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    
    public function orderHistory()
    {
        // Fetch all orders from the database
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
    
        return view('admin.history', compact('orders'));
    }
    
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Item;
// use App\Models\Order;
// use App\Models\OrderItem;
// use Illuminate\Support\Facades\Session;

// class OrderController extends Controller
// {
//     public function index()
//     {
//         $items = Item::all();
//         $order = session()->get('order', []);

//         // Calculate total amount
//         $totalAmount = collect($order)->sum(function($details) {
//             return $details['price'] * $details['quantity'];
//         });

//         return view('kiosk.index', compact('items', 'order', 'totalAmount'));
//     }

//     public function addToOrder(Request $request)
//     {
//         $item = Item::find($request->item_id);

//         // Get current order from session
//         $order = session()->get('order', []);

//         // Add item or update quantity
//         if(isset($order[$item->id])) {
//             $order[$item->id]['quantity']++;
//         } else {
//             $order[$item->id] = [
//                 "name" => $item->name,
//                 "price" => $item->price,
//                 "quantity" => 1
//             ];
//         }

//         session()->put('order', $order);

//         return redirect()->back()->with('success', 'Item added to order.');
//     }

//     public function removeFromOrder(Request $request)
//     {
//         $order = session()->get('order');

//         if(isset($order[$request->item_id])) {
//             unset($order[$request->item_id]);
//             session()->put('order', $order);
//         }

//         return redirect()->back()->with('success', 'Item removed from order.');
//     }

//     public function checkout()
//     {
//         // Get order from session
//         $orderData = session('order');

//         if (!$orderData) {
//             return redirect()->route('kiosk.index')->with('error', 'Walang order na available.');
//         }

//         // Calculate total price
//         $totalPrice = collect($orderData)->sum(function($details) {
//             return $details['price'] * $details['quantity'];
//         });

//         // Save order to database
//         $newOrder = Order::create(['total_price' => $totalPrice, 'completed' => false]);

//         foreach ($orderData as $itemId => $details) {
//             OrderItem::create([
//                 'order_id' => $newOrder->id,
//                 'item_id' => $itemId,
//                 'quantity' => $details['quantity'],
//                 'price' => $details['price'],
//             ]);
//         }

//         // Clear session
//         Session::forget('order');

//         // Redirect to main menu after checkout
//         return redirect()->route('kiosk.index')->with('success', 'Order na-save at naka-checkout na!');
//     }

//     public function viewOrders()
//     {
//         // Query for orders where 'completed' is false (0)
//         $orders = Order::where('completed', false)->get();
    
//         return view('admin.orders', compact('orders'));
//     }
    

//     public function update(Request $request)
//     {
//         $order = session()->get('order');

//         if ($order) {
//             $itemId = $request->input('item_id');
//             $quantity = $request->input('quantity');

//             // Ensure quantity is valid
//             if ($quantity > 0) {
//                 $order[$itemId]['quantity'] = $quantity;
//                 session()->put('order', $order);
//             }
//         }

//         return redirect()->back();
//     }

//     public function completeOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->completed = request()->has('completed');
//         $order->save();

//         return redirect()->back()->with('success', 'Order status updated successfully.');
//     }

//     public function orderHistory()
//     {
//         // Fetch only completed orders from the database
//         $orders = Order::with('items')->where('completed', true)->orderBy('created_at', 'desc')->get();

//         return view('admin.history', compact('orders'));
//     }
    
// }
