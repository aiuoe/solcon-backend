<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
  use HasFactory;	

  protected $table = 'addresses', $fillable = [
  	'company_id', 
  	'customer_id', 
  	'user_id', 
  	'label', 
  	'address', 
  	'city', 
  	'state', 
  	'province', 
  	'country', 
  	'zip_code'
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
  	return $this->belongsTo(User::class)
    ->where('id', auth()->user()->id);
  }
}
