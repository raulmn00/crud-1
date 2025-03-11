<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'email_is_verified',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'id',
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
      'email_is_verified' => 'boolean',
    ];
  }

  /**
   * Boot function to handle model events
   */
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($user) {
      $user->secure_id = Str::uuid();
    });
  }

  /**
   * Get the products associated with the user
   */
  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }

  /**
   * Associate a product with a user
   */
  public function associateProduct($productId, $userId = null)
  {
    $product = Product::find($productId);

    if (!$product) {
      throw new \Exception('Produto não encontrado');
    }

    $user = $userId ? User::find($userId) : $this;
    if (!$user) {
      throw new \Exception('Usuário não encontrado');
    }

    $product->user_id = $user->id;
    $product->save();

    return $product;
  }
}
