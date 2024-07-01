<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *      schema="User",
 *      title="User",
 *      required={"name", "email"},
 *      @OA\Property(property="name", type="string", example="John Doe"),
 *      @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *      @OA\Property(property="password", type="string", format="password", example="hashed_password"),
 *      @OA\Property(property="email_verified_at", type="string", format="date-time", example="2023-01-01T00:00:00Z"),
 *      @OA\Property(property="remember_token", type="string", example="remember_token"),
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
