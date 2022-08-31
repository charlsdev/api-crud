<?php
   use Charlsdev\Api\controllers\IndexCtrl;

   $router = new \Bramus\Router\Router();

   $router->get('/', function() {
      $ctrl = new IndexCtrl();
      $res = $ctrl->index();

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->run();