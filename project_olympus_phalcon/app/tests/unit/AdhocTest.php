<?php

namespace Test;

use \Phalcon\Http\Request;
use Phalcon\DI;

class AdhocTest extends \UnitTestCase
{
    public function testTestCase()
    {
        $this->assertEquals('works',
            'works',
            'This is OK'
        );

        // $this->assertEquals('works',
        //     'works1',
        //     'This will fail'
        // );
    }

    public function testGetProductDetailByBarcodeReturnNotFound()
    {
        $barcode = '123456';

        $mock = $this->getMock('Request', array('get'));
        $mock->expects($this->any())
            ->method('get')
            ->will($this->returnValue($barcode));
        $mockProduct = $this->getMock('Products', array('getProductByBarcode'));
        $mockProduct->expects($this->any())
            ->method('getProductByBarcode')
            ->will($this->returnValue(array($barcode => null)));

        $this->di->setShared('request', $mock);
        $this->di->setShared('product_model', $mockProduct);

        $product = new \ProductController();

        $detail = $product->getDetailByBarcodeAction($barcode);
        $content = json_decode($detail->getContent(), true);

        $this->assertEquals('200 OK', $detail->getStatusCode(), 'Status code is not 200 OK.');
        $this->assertEquals('product not found', $content[$barcode], 'Content incorrect.');
    }

    public function testGetProductDetailByBarcodeReturnDetail()
    {
        $barcode = '123456';
        $productName = 'Test first product';
        $basePrice = 30.25;
        $returnResult = json_decode(
            '{"barcode":"123456","name":"'.$productName.'","base_price":'.$basePrice.'}', 
            true
        );

        $mock = $this->getMock('Request', array('get'));
        $mock->expects($this->any())
            ->method('get')
            ->will($this->returnValue($barcode));
        $mockProduct = $this->getMock('Products', array('getProductByBarcode'));
        $mockProduct->expects($this->any())
            ->method('getProductByBarcode')
            ->will($this->returnValue($returnResult));

        $this->di->setShared('request', $mock);
        $this->di->setShared('product_model', $mockProduct);

        $product = new \ProductController();

        $detail = $product->getDetailByBarcodeAction($barcode);
        $content = json_decode($detail->getContent(), true);
        // var_dump($content);exit;
        $this->assertEquals('200 OK', $detail->getStatusCode(), 'Status code is not 200 OK.');
        $this->assertEquals($productName, $content[$barcode]['name'], 'Product name incorrect.');
        $this->assertEquals($basePrice, $content[$barcode]['base_price']);
    }

}