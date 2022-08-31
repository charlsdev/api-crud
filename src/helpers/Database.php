<?php
   namespace Charlsdev\Api\helpers;

   use Charlsdev\Api\config\Constants;
   use PDO;
   use PDOException;

   class Database
   {

      private $tipdb;
      private $host;
      private $db;
      private $user;
      private $password;
      private $port;

      public function __construct(){
         $this->tipdb = Constants::$TPDB;
         $this->host = Constants::$HOST;
         $this->db = Constants::$DB;
         $this->user = Constants::$USER;
         $this->password = Constants::$PASSWORD;
         $this->port = Constants::$PORT;
      }

      function connect(){
         try{
            // ⇝ MySQL (mysql) && PostgreSQL (pgsql)
            $connection = $this->tipdb . ":host=" . $this->host . ";dbname=" . $this->db . ";port=" . $this->port;

            $options = [
                  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            
            return $pdo;
         }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
         }
      }
   }