<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
  use HasFactory;

  protected $table = 'phones', $fillable = [
  	'user_id', 
  	'company_id', 
  	'customer_id', 
  	'label', 
  	'phone'
  ];

  public function company(): BelongsTo
  {
  	return $this->belongsTo(Company::class);
  }

  public function customer(): BelongsTo
  {
  	return $this->belongsTo(Customer::class);
  }

  public function user(): BelongsTo
  {
  	return $this->belongsTo(User::class);
  }
}
