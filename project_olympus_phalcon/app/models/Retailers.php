<?php

use Phalcon\Mvc\Model;

class Retailers extends Model
{
	public $retailer_id;
	public $product_barcode;
	public $retailer_name;
	
	public function initialize()
	{
		$this->belongsTo('product_barcode', 'Products', 'barcode');
	}

}