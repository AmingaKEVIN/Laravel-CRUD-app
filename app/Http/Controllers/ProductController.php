<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function edit($id){
        $categories=Product::pluck('category');
        $products= Product::findOrFail($id);
        return view('products.edit')-> with('products', $products)
                                    ->with('categories', $categories);
        ;

    }
    //
    public function index(Request $request){
        $categories=Product::pluck('category');
        $keyword = $request->get('search');
        $perpage=5;
        if(!empty($keyword)){
            $products=Product::where('name','LIKE',"%$keyword%")
                               ->orwhere('category','LIKE',"%$keyword%")
                               ->latest()->paginate($perpage);
        }else{
            $products = Product::latest()->paginate($perpage);
        }
        $products =Product::orderby('created_at')->get();
        return view('products.index')->with('products', $products)
                                    ->with('categories', $categories);
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        $product = new Product;

        $file_name = time() . '.' .request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'),$file_name);
        $product ->name = $request->name;
        $product -> description = $request->description;
        $product->image= $file_name;
        $product->category =$request->category;
        $product->quantity=$request->quantity;
        $product->price= $request->price;

        $product->save();
        return redirect()->route('products.index')-> with('success','Product added successfully');


    }
    public function update(Request $request ,Product $product){
        $request -> validate([
            'name'=>'required',
            ]);
           
        $product = Product::find($request->hidden_id);
        $file_name= $request->hidden_product_image;
        if ($request->image != ''){
            $file_name = time() . '.' .request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'),$file_name);
        }
        $product ->name = $request->name;
        $product -> description = $request->description;
        $product->image= $file_name;
        $product->category =$request->category;
        $product->quantity=$request->quantity;
        $product->price= $request->price;

        $product->save();

        return redirect()-> route('products.index')->with('success', 'Product has been updated successfully');
                                               

    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $imagepath=public_path()."/Images/";
        $image = $imagepath. $product->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
        return redirect('products')->with('success', 'Product deleted');

    }
  
}
