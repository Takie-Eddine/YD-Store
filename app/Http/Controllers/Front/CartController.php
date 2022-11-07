<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    protected $cart ;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$repository = new CartModelRepository();
        //$repository = App::make('cart');


        return view('front.cart' ,[
            'cart' => $this->cart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required' , 'int' , 'exists:products,id'],
            'quantity' => ['nullable' , 'int' , 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);
        //$repository = new CartModelRepository();
        //$repository->add($product , $request->quantity);
        $cart->add($product , $request->quantity);

        return redirect()->route('cart.index')->with(['toast_error' => 'Product add to cart']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required' , 'int' , 'exists:products,id'],
            'quantity' => ['nullable' , 'int' , 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);
        // $repository = new CartModelRepository();
        // $repository->update($product , $request->quantity);
        $cart->update($product , $request->quantity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartRepository $cart , $id)
    {

        $product = Product::findOrFail($id);
        // $repository = new CartModelRepository();
        // $repository->delete($id);
        $cart->delete($id);
    }
}
