<?php

use Phalcon\Mvc\Model;

class Products extends Model
{
	public function getProductByBarcode($barcode = '123456')
	{
		// var_dump($barcode);
		// try{
		$products = Products::find(
			array(
				'barcode = ?0',
				'bind' => array($barcode),
			)
		);

		// var_dump($products);
		foreach ($products as $product) {
			echo $product->name;
		}

		return $products;
	}
}