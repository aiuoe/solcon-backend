<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
  use HasFactory;

  protected $table = 'emails', $fillable = [
  	'user_id', 
  	'company_id', 
  	'customer_id',
  	'email'
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
