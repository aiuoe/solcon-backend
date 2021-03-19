<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable implements JWTSubject
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'relp_id', 
		'name', 
		'lastname', 
		'email',
		'sex',
		'dni', 
		'rif', 
		'dob',
		'sos',
		'refd', 
		'org_id',
		'ext',
		'language_id',
		'password', 
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return ['role' => $this->role];
	}

	public function addresses(): HasMany
	{
		return $this->hasMany(Address::class);
	}

	public function companies(): HasMany
	{
		return $this->hasMany(Company::class);
	}

	public function company_accounts(): HasManyThrough
	{
		return $this->hasManyThrough(Account::class, Company::class);
	}

	public function company_addresses(): HasManyThrough
	{
		return $this->hasManyThrough(Address::class, Company::class);
	}

	public function company_emails(): HasManyThrough
	{
		return $this->hasManyThrough(Email::class, Company::class);
	}

	public function company_phones(): HasManyThrough
	{
		return $this->hasManyThrough(Phone::class, Company::class);
	}

	public function company_products(): HasManyThrough
	{
		return $this->hasManyThrough(Product::class, Company::class);
	}

	public function company_taxes(): HasManyThrough
	{
		return $this->hasManyThrough(Tax::class, Company::class);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}

	public function emails(): HasMany
	{
		return $this->hasMany(Email::class);
	}

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}

	public function origin(): BelongsTo
	{
		return $this->belongsTo(Origin::class);
	}

	public function phones(): HasMany
	{
		return $this->hasMany(Phone::class);
	}

	public function purchases(): HasMany
	{
		return $this->hasMany(Sale::class);
	}
	
	public function relationship(): BelongsTo
	{
		return $this->belongsTo(Relationship::class);
	}

	public function tickets(): BelongsToMany
	{
		return $this->belongsToMany(Ticket::class)
		->withPivot('created_by', 'updated_by', 'closed_by')
		->orderBy('pinned', 'desc')
		->orderBy('status', 'desc')
		->orderBy('created_at', 'desc')
		->withTimestamps();
	}
}
