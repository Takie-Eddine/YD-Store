<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','store'])->paginate();

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $product = Product::find($id);
        $tags = implode(',' , $product->tags()->pluck('name')->toArray());

        if (!$product) {
            return redirect()->route('dashboard.products.index')->with(['toast_error' => 'Not found']);
        }


        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $product->update($request->except('tags'));

        $tags = explode(',' , $request->tags);
        $tags_ids = [];
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag = Tag::where('slug' , $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $t_name,
                    'slug' => $slug ,
                ]);
                $tags_ids[] = $tag->id;
            }
        }
        $product->tags()->sync($tags_ids);

        return redirect()->route('dashboard.products.index')->with(['toast_success' => 'Product updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
