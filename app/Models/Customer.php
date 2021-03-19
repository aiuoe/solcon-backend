<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
  use HasFactory;

	protected $table = 'customers', $fillable = [
		'company_id',
		'name',
		'lastname',
		'dni',
		'rif',
	];

  public function address(): HasMany
	{
		return $this->hasMany(Address::class);
	}

  public function company(): BelongsTo
  {
  	return $this->belongsTo(Company::class);
  } 
  
  public function emails(): HasMany
	{
		return $this->hasMany(Email::class);
	}
  
  public function phones(): HasMany
	{
		return $this->hasMany(Phone::class);
	}

	public function products(): HasManyThrough
	{
		return $this->hasManyThrough(Product::class, 'sales');
	}

  public function sales(): HasMany
	{
		return $this->hasMany(Sale::class);
	}
}
