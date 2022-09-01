<?php
   namespace Charlsdev\Api\helpers;

   class HttpRouter
   {
      public function __construct() { }

      protected function post($param)
      {
         if(!isset($_POST[$param])) {
            error_log("POST: No existe el parametro $param");
            return ['msg' => 'POST: No existe el parametro ' . $param];
         }

         return $_POST[$param];
      }
      
      protected function get($param)
      {
         if(!isset($_GET[$param])) {
            error_log("GET: No existe el parametro $param");
            return ['msg' => 'GET: No existe el parametro ' . $param];
         }

         return $_GET[$param];
      }
   }