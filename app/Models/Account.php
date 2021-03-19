<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;

class Account extends Model
{
  use HasFactory;

	protected $table = 'accounts', $fillable = [
		'parent_id',
		'company_id', 
		'currency_id', 
		'description',
		'name',
		'balance',
		'type',
	];

	// public function fill()
	// {
	// 	return 
	// }

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}

	public function currency(): BelongsTo
	{
		return $this->belongsTo(Currency::class);
	}

	public function transactions(): HasMany
	{
		return $this->hasMany(Transaction::class);
	}
}
