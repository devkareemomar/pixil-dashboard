<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:cart-read|cart-create|cart-update|cart-delete', ['only' => ['index']]);
        $this->middleware('permission:cart-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cart-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cart-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $carts = Cart::filter()->paginate();
        $users = User::select('name', 'id')->get();
        return view('carts.index',   compact('carts', 'users'));
    }

    public function create(){
        return view('carts.create');
    }

    public function store(CartRequest $request){
        Cart::create($request->validated());
        return redirect()->route('carts.index')->with('success',  __('Cart created successfully.'));
    }

    public function show(Cart $cart){
        return view('carts.show', compact('cart'));
    }

    public function edit(Cart $cart){
        $users = User::select('name', 'id')->get();
        return view('carts.edit', compact('cart', 'users'));
    }

    public function update(CartRequest $request, Cart $cart){
        $cart->update($request->validated());
        return redirect()->route('carts.index')->with('success',  __('Cart updated successfully.'));
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return redirect()->route('carts.index')->with('success',  __('Cart deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Cart::class,$selectedRows);
        return back()->with('success',  __('Cart deleted successfully.'));

    }
    public function export()
    {
        $array = [
            '#',
            __('User ID'),
            __('Session ID'),
            __('Total Amount'),
            __('Client Notes'),
            __('Admin Notes'),
            __('Created At')
        ];
        $data = Cart::select('id','user_id','session_id','total_amount','client_notes','admin_notes','created_at')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Carts.csv');
    }
}
