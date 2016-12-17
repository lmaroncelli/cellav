<?php

namespace App;
;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
	protected $table = 'tblHomePages';

	protected $fillable = [
	        'seo_title',
	        'seo_description',
	        'content',
	        'listing',
	        'listingCategorie',
	        'listingCaratteristiche',
	        'header_slide_id',
	        'img_magliana',
	        'desc_magliana',
	        'img_cipro',
	        'desc_cipro',
	        'img_tiburtina',
	        'desc_tiburtina',
			];

}
