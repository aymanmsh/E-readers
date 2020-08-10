<?php

namespace App\control;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
	use SoftDeletes;
    public $table = 'categories';
	public $primaryKey = 'id';
	public $fillable =
	[
		'image',
		'name',
		'lang',
	];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];


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
