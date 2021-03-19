<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  protected $table = 'transactions', $fillable = [
  	'account_id', 
  	'sale_id',
  	'amount'
  ];

  public function account(): Belongsto
  {
  	return $this->belongsTo(Account::class);
  }

  public function sale(): BelongsTo
  {
  	return $this->belongsTo(Sale::class);
  }
}
