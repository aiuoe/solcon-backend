<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
  use HasFactory;

	protected $table = 'accounts', $fillable = [
		'company_id', 
		'currency_id', 
		'description',
		'name',
		'balance',
	];

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
