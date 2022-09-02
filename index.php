<?php
   date_default_timezone_set('America/Guayaquil');

   error_reporting(E_ALL);

   ini_set('ignore_repeated_errors', TRUE);

   ini_set('display_errors', FALSE);

   ini_set('log_errors', TRUE);

   ini_set("error_log", "php-error.log");
   
   error_log("Inicio de la APP - CharlsDEV!");

   require '/vendor/autoload.php';

   // Ejecucion de las variables de entorno
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();

   require '/src/routes/index.routes.php';