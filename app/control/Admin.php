<?php

namespace App\control;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use SoftDeletes;
    public $table = 'admin';
	public $primaryKey = 'id';
	public $fillable =
	[
		'name',
		'image',
		'email',
		'phone',
		'password',
		'username',
	];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
}
