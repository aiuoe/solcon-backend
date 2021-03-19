<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  use HasFactory;

  protected $table = 'products', $fillable = [
		'company_id',
		'currency_id',
		'tax_id',
		'name',
		'description',
		'price',
  ];

  public function company(): BelongsTo
  {
  	return $this->belongsTo(Company::class);
  }

  public function currency(): BelongsTo
  {
  	return $this->belongsTo(Currency::class);
  }

  public function tax(): BelongsTo
  {
  	return $this->belongsTo(Tax::class);
  }
}
