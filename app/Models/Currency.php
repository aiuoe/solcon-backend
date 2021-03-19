<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
  use HasFactory;

	protected $table = 'currencies', $fillable = ['name', 'abbreviation'];

 //  public function accounts(): HasMany
	// {
	// 	return $this->hasMany(Account::class);
	// }

 //  public function products(): HasMany
	// {
	// 	return $this->hasMany(Product::class);
	// }

 //  public function sales(): HasMany
	// {
	// 	return $this->hasMany(Sale::class);
	// }
}
