<?php

use Phalcon\Http\Response;
use Phalcon\DI;

class ProductController extends ControllerBase
{

	public function getDetailByBarcodeAction($barcode = 123456)
	{
		$barcode = 123456;
		$response = new Phalcon\Http\Response;
		$request = $this->di->getShared('request');

		$barcode = $request->get('barcode');
		$product = new Products;
		var_dump($barcode);
		$res = $product->getProductByBarcode($barcode);

		//case response is correct
		$response->setStatusCode(200);
		var_dump($res);exit;

		if(empty($res))
		{
			$response->setJsonContent(
				array(
					$barcode => 'product not found'
				)
			);
		} else {
			$response->setJsonContent($res);
		}
		

		return $response;
	}
}