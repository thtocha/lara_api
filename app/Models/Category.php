<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Category",
 *     required={"name"},
 *     @OA\Property(
 *         property="id",
 *         description="Category ID",
 *         type="integer",
 *         format="int64"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         description="Category name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         description="Category description",
 *         type="text"
 *     )
 * )
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}
