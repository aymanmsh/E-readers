<?php

namespace App\control;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Authenticatable
{
    use SoftDeletes;
    public $table = 'library';
	public $primaryKey = 'id';
	public $fillable =
	[
		'name',
		'image',
		'email',
		'phone',
		'password',
		'token',
	];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



	// Return Category Image Path
	public function getImage()
	{
		if (!$this->image)
			return asset('no_image.png');
		return asset($this->image);
	}

	// Return Category Language
	public function getLang() {
		if( $this->lang == 'ar' )
			return 'Arabic';
		return 'English';
	}
}
