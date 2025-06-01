<?php
namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }
    public function index()
    {
        $Products = Products::get();
        $sections = Sections::get();
        return view('products.index', compact('Products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        try {
            // Check if a product with the same name and section already exists
            $existingProduct = Products::where('name', $request->name)
                                       ->where('section_id', $request->section_id)
                                       ->first();

            if ($existingProduct) {
                session()->flash('error', 'المنتج موجود بالفعل في هذا القسم!');
                return redirect()->back();
            }

            // Create the product if it doesn't already exist
            Products::create([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'description' => $request->description,
            ]);

            session()->flash('add', 'تم اضافة المنتج بنجاح ');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء إضافة البيانات!'. $e->getMessage());
        }

        return redirect()->route('Products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $pro_id = $request->id;
            // Find the product by ID
            $product = Products::findOrFail($pro_id);

            // Check if another product with the same name and section already exists
            $existingProduct = Products::where('name', $request->name)
                                       ->where('section_id', $request->section_id)
                                       ->where('id', '!=', $pro_id)
                                       ->first();

            if ($existingProduct) {
                session()->flash('error', 'المنتج موجود بالفعل في هذا القسم!');
                return redirect()->back();
            }

            // Update the product
            $product->update([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'description' => $request->description,
            ]);

            session()->flash('edit', 'تم تعديل المنتج بنجاح ');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء تعديل البيانات!'. $e->getMessage());
        }

        return redirect()->route('Products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // Ensure the product ID is passed correctly
            $id = $request->pro_id; // Use 'pro_id' as the key from the modal's hidden input field

            if (!$id) {
                session()->flash('error', 'المنتج غير موجود!');
                return redirect()->route('Products.index');
            }

            $product = Products::find($id);

            if ($product) {
                $product->delete();
                session()->flash('delete', 'تم حذف المنتج بنجاح');
            } else {
                session()->flash('error', 'المنتج غير موجود!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء حذف المنتج!'. $e->getMessage());
        }

        return redirect()->route('Products.index');
    }

}
