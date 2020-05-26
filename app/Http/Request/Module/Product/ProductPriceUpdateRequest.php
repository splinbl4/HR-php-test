<?php

declare(strict_types=1);

namespace App\Http\Request\Module\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductPriceUpdateRequest
 * @package App\Http\Request\Module\Product
 */
class ProductPriceUpdateRequest  extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|integer|min:1',
        ];
    }
}
