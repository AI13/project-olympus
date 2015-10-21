<?php

use Phalcon\Mvc\Model;

class Products extends Model
{
	public $barcode;
	public $name;

	public function initialize()
	{
		$this->hasMany('barcode', 'Retailers', 'product_barcode');
		$this->hasMany('barcode', 'ProductAttributes', 'product_barcode');
	}

	public function getProductByBarcode($barcode)
	{
		$products = Products::find(
			array(
				'barcode = ?0',
				'bind' => array($barcode),
				'limit' => 1,
			)
		);

		// var_dump($products->getFirst()->toArray());
		// foreach ($products->retailers as $product) {
		// 	echo $product->retailer_name;
		// }
		// var_dump($products[0]->countRetailers(array('limit' => 1)));
		// var_dump($products[0]->getRetailers(array('limit' => 1))->toArray());exit;

		return $products[0]->toArray();
	}

}