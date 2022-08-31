<?php
   namespace Charlsdev\Api\config;

   class Constants
   {
      static public string $TPDB = $_ENV['TPDB'];
      static public string $HOST = $_ENV['HOST'];
      static public string $DB = $_ENV['DB'];
      static public string $USER = $_ENV['USER'];
      static public string $PASSWORD = $_ENV['PASSWORD'];
      static public string $PORT = $_ENV['PORT'];
   }