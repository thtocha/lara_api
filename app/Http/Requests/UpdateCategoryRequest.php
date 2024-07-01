<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateCategoryRequest",
 *     required={"name"},
 *     @OA\Property(
 *         property="name",
 *         description="Category name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *          property="description",
 *          description="Category description",
 *          type="text"
 *      )
 * )
 */
class UpdateCategoryRequest extends FormRequest
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
            'description' => ['required', 'string'],
        ];
    }
}
