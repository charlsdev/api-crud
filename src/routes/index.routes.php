<?php
   use Charlsdev\Api\controllers\IndexCtrl;

   $router = new \Bramus\Router\Router();

   $router->get('/', function() {
      \error_log("GET User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->index();
      
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->get('/allUsers', function () {
      \error_log("ALL User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->allData();

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->get('/oneUser', function () {
      \error_log("ONE User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->oneData($_GET);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });
   
   $router->post('/saveUser', function () {
      \error_log("POST User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->saveData($_POST);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->post('/deleteUser', function () {
      \error_log("DELETE User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->deleteData($_POST);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->post('/updateUser', function () {
      \error_log("PUT User");

      $ctrl = new IndexCtrl();
      $res = $ctrl->updateData($_POST);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($res);
   });

   $router->run();