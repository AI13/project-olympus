<?php

$router =  new Phalcon\Mvc\Router(false);

// $router->notFound(array(
//     'controller' => 'index',
//     'action' => 'route404',
// ));
// $router->add('/feedback/summary/rating', 'ApiSummary::getRating');
// $router->add('/feedback/summary', 'ApiSummary::getIndex');
// $router->add('/v1/feedback/add', 'Index::test');
//$router->addPost('/v1/feedback/add', 'ApiFeedback::postAdd');
// $router->add('/feedback/time/expired', 'ApiFeedbackTime::getExpired');
$router->add('/product/test', 'Product::getDetailByBarcode');


return $router;