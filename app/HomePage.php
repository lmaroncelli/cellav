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
	        'gm_nome',
					'gm_indirizzo',
					'gm_lat',
					'gm_long',
					'gm_info',
					'gm_lat2',
					'gm_long2',
					'gm_info2',
					'gm_lat3',
					'gm_long3',
					'gm_info3',
			];

}
