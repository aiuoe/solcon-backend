<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
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
	];

	public function get_accounts(Builder $builder, int $company_id): Builder
	{
		if (User::find(auth()->user()->id)->companies->contains($company_id))
	    return $builder->where('company_id', $company_id);
	  else
	  	throw new AuthorizationException("Unauthorized");
	}

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
