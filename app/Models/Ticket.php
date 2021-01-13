<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
  use HasFactory;

	protected $table = 'tickets', $fillable = [
		'title', 
		'message', 
		'priority', 
		'status', 
		'pinned', 
		'public', 
		'channel', 
		'due_date'
	];

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}

  public function users(): BelongsToMany
  {
  	return $this->belongsToMany(User::class)->withTimestamps();
  }
}
