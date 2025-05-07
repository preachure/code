<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockHistory;




use Illuminate\Http\Request;

class StockController extends Controller
{
    public function dashboard(){
        $stocks = Stock::all();
        $stockIns = StockIn::all();
        $stockOuts = StockOut::all();
        $totalQuantity = $stocks->sum('quantity');
        $lowStockCount = $stocks->where('quantity', '<=', 5)->count();
        $histories = StockHistory::with('stock')->latest()->get();
        return view('dashboard', compact('stocks', 'stockIns', 'stockOuts', 'totalQuantity', 'lowStockCount', 'histories'));

    }
    public function addStock(Request $request){
        $stock = Stock::Create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
        ]);
        return redirect()->back();
    }
    public function stockIn(Request $request){
        $request->validate([
            'stock_id'=>'required|exists:stocks,id',
            'quantity'=>'required|integer|min:1',

        ]);
        $stock = Stock::findOrFail($request->stock_id);
        //UPDATE STOCK QUANTITY
        $stock->quantity += $request->quantity;
        $stock->Save();
        //insert into stock_ins table
        StockHistory::Create([
            'stock_id' => $stock->id,
            'type' => 'in',
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('dashboard')->with('success','Stock added successfully!');
    }
    public function stockOut(Request $request){
        $stock = Stock::findOrFail($request->stock_id);
        if ($stock->quantity < $request->quantity){
            return back()->with('error','Not Enough Stock!');
        }
        $stock->quantity -=$request->quantity;
        $stock->Save();
        StockHistory::Create([
            'stock_id' => $stock->id,
            'type' => 'out',
            'quantity' => $request->quantity,
        ]);
        return redirect()->back()->with('success', 'Stock reduced!');
        
    }
    public function destroy($id)
{
    $stock = Stock::findOrFail($id);
    $stock->delete();
    return redirect()->back()->with('success', 'Product deleted successfully.');
}

public function edit($id)
{
    $stock = Stock::findOrFail($id);
    return view('stock.edit', compact('stock')); // You need to create this view
}

public function update(Request $request, $id)
{
    $stock = Stock::findOrFail($id);
    $stock->product_name = $request->product_name;
    $stock->quantity = $request->quantity;
    $stock->save();

    return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
}
// database/migrations/xxxx_xx_xx_create_stock_histories_table.php
public function up()
{
    Schema::create('stock_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('stock_id')->constrained()->onDelete('cascade');
        $table->enum('type', ['in', 'out']);
        $table->integer('quantity');
        $table->timestamps();
    });
}
public function show($id)
{
    // Fetch the stock from the database
    $stock = Stock::find($id);

    // Check if the stock was found
    if (!$stock) {
        return redirect()->route('stocks.index')->with('error', 'Stock not found');
    }

    // Pass the stock variable to the view
    return view('stocks.show', compact('stock'));
}



}

