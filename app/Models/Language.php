<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
  use HasFactory;

	protected $table = 'languages', $fillable = ['abbreviation', 'name'];
	
  public function users(): HasMany
	{
		return $this->hasMany(User::class);
	}  
}
