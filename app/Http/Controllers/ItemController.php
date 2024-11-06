<?php


// namespace App\Http\Controllers;

// use App\Models\Item;
// use App\Models\Category;
// use Illuminate\Http\Request;

// class ItemController extends Controller
// {
//     public function index(Request $request)
//     {
//         $categories = Category::all(); // Retrieve all categories from the database
//         $items = Item::query();

//         // Filter items by category if a category ID is provided
//         if ($request->has('category')) {
//             $items->where('category_id', $request->category);
//         }

//         $items = $items->get(); // Execute the query

//         return view('items.index', compact('items', 'categories'));
//     }

//     public function create()
//     {
//         // Define the categories you want to display
//         $categories = Category::all(); // Retrieve all categories
//         return view('items.create', compact('categories')); // Pass to view
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'price' => 'required|numeric',
//             'description' => 'nullable',
//             'quantity' => 'required|integer',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
//             'category_id' => 'required|exists:categories,id' // Ensure category exists
//         ]);

//         $item = new Item;
//         $item->name = $request->name;
//         $item->price = $request->price;
//         $item->description = $request->description;
//         $item->quantity = $request->quantity;
//         $item->category_id = $request->category_id;

//         // Handle image upload
//         if ($request->hasFile('image')) {
//             $imageName = time() . '.' . $request->image->extension();  // Generate a unique file name
//             $request->image->move(public_path('images'), $imageName);  // Move image to public/images
//             $item->image = $imageName;  // Save image file name in the database
//         }

//         $item->save();

//         return redirect()->route('items.index')->with('success', 'Item created successfully');
//     }
// }


namespace App\Http\Controllers;

use App\Models\Item;
// use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
{
    // Method to show the form for creating a new item
    public function create()
    {
        return view('items.create');
    }
    // {
    //     $categories = Category::all(); // Retrieve all categories
    //     return view('items.create', compact('categories')); // Pass categories to the view
    // }
    
    // Method to store the newly created item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        ]);
    
        $item = new Item;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  // Generate a unique file name
            $request->image->move(public_path('images'), $imageName);  // Move image to public/images
            $item->image = $imageName;  // Save image file name in the database
        }
    
        $item->save();
    
        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }
//     public function store(Request $request)
// {
//     $request->validate([
//         'name' => 'required',
//         'price' => 'required|numeric',
//         'description' => 'nullable',
//         'quantity' => 'required|integer',
//         'category_id' => 'required|exists:categories,id', // Validate category ID
//         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//     ]);

//     $item = new Item;
//     $item->name = $request->name;
//     $item->price = $request->price;
//     $item->description = $request->description;
//     $item->quantity = $request->quantity;
//     $item->category_id = $request->category_id; // Save the selected category ID

//     // Handle image upload
//     if ($request->hasFile('image')) {
//         $imageName = time() . '.' . $request->image->extension();
//         $request->image->move(public_path('images'), $imageName);
//         $item->image = $imageName;
//     }

//     $item->save();

//     return redirect()->route('items.index')->with('success', 'Item created successfully');
// }

    
    public function show($id)
{
    $item = Item::find($id);

    if (!$item) {
        return redirect()->route('items.index')->with('error', 'Item not found.');
    }

    return view('items.show', compact('item'));
}
public function index()
{
    // Kunin ang lahat ng mga item mula sa database
    $items = Item::all();

    // I-render ang view kasama ang mga item
    return view('items.index', compact('items'));
}

public function destroy($id)
{
    // Hanapin ang item gamit ang ID
    $item = Item::findOrFail($id);

    // Tanggalin ang item
    $item->delete();

    // I-redirect pabalik sa item list na may success message
    return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
}



}


