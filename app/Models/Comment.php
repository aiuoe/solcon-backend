<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  use HasFactory;

  protected $table = 'comments', $fillable = ['user_id', 'ticket_id', 'message'];

	public function ticket(): BelongsTo
  {
  	return $this->belongsTo(Ticket::class);
  }

	public function user(): BelongsTo
  {
  	return $this->belongsTo(User::class);
  }
}
