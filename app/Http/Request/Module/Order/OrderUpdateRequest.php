<?php

declare(strict_types=1);

namespace App\Http\Request\Module\Order;

use App\Module\Order\Entity\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class OrderUpdateRequest
 * @package App\Module\Order\Request
 */
class OrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_email' => 'required|email',
            'partner_id' => 'required|exists:partners,id',
            'status' => ['required', Rule::in(array_keys(Order::$statusMap))],
        ];
    }
}
