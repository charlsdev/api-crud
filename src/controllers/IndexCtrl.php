<?php
   namespace Charlsdev\Api\controllers;

   use Charlsdev\Api\helpers\HttpRouter;

   class IndexCtrl extends HttpRouter
   {
      function __construct() { }

      public function index()
      {
         return ['msg' => 'Welcome to API - PHP/PostgreSQL'];
      }
   }
   