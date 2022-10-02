<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        // $request->validate([

        //     'name' => 'required|string|min:3|max:255|unique:categories,name',
        //     'parent_id' => [
        //         'nullable' , 'int' , 'exists:categories,id'
        //     ],
        //     'image' => [
        //         'image' , 'max:2000000' , 'dimensions:min_width=100,min_height=100',
        //     ],
        //     'status' => 'in:active,archived'

        // ]);


        $path= null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads','public');
        }



        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'image' => $path,
            'status' =>$request->status,
        ]);
        return redirect()->route('dashboard.categories.index')->with(['toast_success' => 'Category created!']);
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
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.categories.index')->with(['toast_error' => 'Not found']);
        }

        $categories = Category::where('id','<>',$id)
            ->where(function($query) use($id){
                $query->whereNull('parent_id')
                ->orWhere('parent_id','<>',$id);
            })->get();

        return view('dashboard.categories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        // $request->validate([

        //     'name' => 'required|string|min:3|max:255|unique:categories,name',
        //     'parent_id' => [
        //         'nullable' , 'int' , 'exists:categories,id'
        //     ],
        //     'image' => [
        //         'image' , 'max:2000000' , 'dimensions:min_width=100,min_height=100',
        //     ],
        //     'status' => 'in:active,archived'

        // ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.categories.index')->with(['toast_error' => 'Not found']);
        }


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads','public');

            $old_image = $category->image;

            if ($old_image) {
                Storage::disk('public')->delete($old_image);
            }


            $category->image = $path;
            $category->save();
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'status' =>$request->status,
        ]);

        return redirect()->route('dashboard.categories.index')->with(['toast_success' => 'Category updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        //Category::destroy($id);

        if (!$category) {
            return redirect()->route('dashboard.categories.index')->with(['toast_error' => 'Not found']);
        }
        $category->delete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with(['toast_success' => 'Category deleted!']);
    }
}
