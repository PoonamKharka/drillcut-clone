<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use Carbon\Carbon;

class ProductController extends Controller
{   
    /**
     * Show products list
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Product::select(['sku', 'title', 'price', 'status' , 'image_url' , 'created_at'])->orderBy('created_at' , 'DESC');
            return DataTables::of($data)
                ->addColumn('image', function ($row) {
                    $link = url('images/'.$row->image_url);
                    if( $row->image_url === null) {
                        $notFoundImg = url('images/Not_Found/ProductPlaceholder.jpg');
                        return '<img alt="product image" style="width:50px;height:50px" class="table-avatar" src="'. $notFoundImg .'">';
                    }
                    if(filter_var($row->image_url, FILTER_VALIDATE_URL)) {
                        return '<img alt="product image" style="width:50px;height:50px" class="table-avatar" src="'. $row->image_url .'">';
                    } else {
                        return '<img alt="product image" style="width:50px;height:50px" class="table-avatar" src="'.$link.'">';
                    }
                   
                })
                ->addColumn('product_price', function ($row) {
                   return '$'. ' '. $row->price;
                })
                ->addColumn('date', function ($row) {
                    return Carbon::parse($row['createdAt'])->toDayDateTimeString();
                 })
                ->addColumn('product_status', function ($row) {
                    if ($row->status == 1) {
                        return '<h5><span class="badge badge-success">Active</a></h5>';
                       
                    } else {
                        return '<h5><span class="badge badge-warning">Draft</a></h5>';
                    }
                })
                ->rawColumns(['product_status', 'image' , 'product_price' , 'date'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * This function is show products add form
     */
    public function create() {
        if(Gate::allows('add-product')) {
            return view('admin.product.create'); 
        }
    }
   
    /**
     * For storing products into the database
     * @return
     */
    public function store(StoreProductRequest $request) {
        
        $prodData = $request->validated(); 
        $randomNumber = mt_rand(1000000000000, 9999999999999); 
        $prodData['sid'] = "$randomNumber";
        $custom = hexdec(uniqid());
        $prodData['product_id'] = "$custom";
        $prodData['extrafields'] = "[]";
        $prodData['variant'] = "Default Title";
        if( $request->productImage ){
            $imageName = time().'.'.$request->productImage->extension();
            $request->productImage->move(public_path('images'), $imageName);
            $prodData['image_url'] = $imageName;
        }
        $prodData['status'] = $request->status;
        $insert = Product::create($prodData);
        if($insert) {
            return redirect()->route('products.index')->with('success', 'Product Added!');
        }
    }
}

?>
