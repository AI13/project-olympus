<?php

use Phalcon\Http\Response;
use Phalcon\DI;

class ProductController extends ControllerBase
{

	public function getDetailByBarcodeAction($barcode = 123456)
	{
		$response = new Phalcon\Http\Response;
		$request = $this->di->getShared('request');

		$barcode = $request->get('barcode');
		$product = $this->di->getShared('product_model');//new Products;
		$res = $product->getProductByBarcode($barcode);

		//case response is correct
		$response->setStatusCode(200);

		if(!empty($res) && isset($res['barcode']))
		{
			$result[$barcode] = $res;
			
		}
		else
		{
			$result[$barcode] = 'product not found';
		}

		$response->setJsonContent($result);
		

		return $response;
	}
}