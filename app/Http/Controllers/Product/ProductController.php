<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Request\Module\Product\ProductPriceUpdateRequest;
use App\Module\Product\Entity\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['vendor'])->orderBy('name')->paginate(25);

        return view('product.index', compact('products'));
    }

    public function updatePrice(ProductPriceUpdateRequest $request, int $id) : JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json(['message' => 'Product price has been updated!', 'price' => $product->price]);
    }
}
