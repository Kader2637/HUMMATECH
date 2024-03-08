<?php

namespace App\Http\Controllers;

use App\Enums\ProductEnum;
use Illuminate\Http\Request;
use App\Contracts\Interfaces\ProductInterface;
use App\Contracts\Interfaces\CategoryProductInterface;
use App\Models\CategoryProduct;

class HomeProductController extends Controller
{
    private ProductInterface $product;
    private CategoryProductInterface $categoryProduct;

    public function __construct(ProductInterface $product, CategoryProductInterface $categoryProduct)
    {
        $this->product = $product;

        $this->categoryProduct = $categoryProduct;
    }

    public function index()
    {
        $products = $this->product->getByType('company');
        $categories = $this->categoryProduct->get();
        return view('landing.product', compact('products', 'categories'));
    }

    public function productCategory(Request $request, CategoryProduct $category)
    {
        $products = $this->product->where($category->id);
        // dd($products);
        $categories = $this->categoryProduct->get();
        return view('landing.product', compact('products', 'categories'));
    }
}
