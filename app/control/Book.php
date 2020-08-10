<?php

namespace App\control;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    public $table = 'books';
	public $primaryKey = 'id';
	public $fillable =
	[
		'category_id',
		'library_id',
		'image',
		'title',
		'author',
		'writer',
		'publisher',
		'isbn',
		'publish_date',
	];
	protected $dates = ['publish_date', 'created_at', 'updated_at', 'deleted_at'];


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
