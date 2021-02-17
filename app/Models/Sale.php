<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Sale extends Model
{
  use HasFactory;

  protected $table = 'sales', $fillable = [
  	'account_id',
		'user_id',
		'currency_id',
		'discount',
		'taxes',
		'amount',
		'paid',
		'due_date'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class)
    ->where('id', auth()->user()->id);
  }

  public function products(): BelongsToMany
  {
  	return $this->belongsToMany(Product::class)
    ->withPivot('quantity')->withTimestamps();
  }
}
