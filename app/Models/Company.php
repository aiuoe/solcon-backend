<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
  use HasFactory;

	protected $table = 'companies', $fillable = [
		'user_id', 
		'name', 
		'rif', 
		'fyc'
	];

  public function accounts(): HasMany
	{
		return $this->hasMany(Account::class);
	}

  public function address(): HasMany
	{
		return $this->hasMany(Address::class);
	}

	public function emails(): HasMany
	{
		return $this->hasMany(Email::class);
	}

  public function phones(): HasMany
	{
		return $this->hasMany(Phone::class);
	}

	public function products(): HasMany
	{
		return $this->hasMany(Product::class);
	}

	public function taxes(): HasMany
	{
		return $this->hasMany(Tax::class);
	}

	public function user(): BelongsTo
  {
  	return $this->belongsTo(User::class);
  }
}
