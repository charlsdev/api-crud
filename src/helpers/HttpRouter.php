<?php
   namespace Charlsdev\Api\helpers;

   class HttpRouter
   {
      public function __construct() { }

      protected function post($param)
      {
         if(!isset($_POST[$param])) {
            error_log("POST: No existe el parametro $param" );
            return NULL;
         }
         return $_POST[$param];
      }

      protected function get($param)
      {
         if(!isset($_GET[$param])) {
            error_log("GET: No existe el parametro $param" );
            return NULL;
         }
         return $_GET[$param];
      }
   }