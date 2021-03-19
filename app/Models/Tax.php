<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{
  use HasFactory;
	
	protected $table = 'taxes', $fillable = ['company_id', 'name', 'rate'];

  public function company(): BelongsTo
  {
  	return $this->belongsTo(Company::class);
  }

	public function products(): HasMany
	{
		return $this->hasMany(Product::class);
	}    
}
