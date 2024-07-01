<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateProductRequest",
 *     type="object",
 *     title="Update Product Request",
 *     required={"name", "description"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the product"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="text",
 *         description="Description of the product"
 *     )
 * )
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max: 255'],
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
