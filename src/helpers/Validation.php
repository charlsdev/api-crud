<?php
   namespace Charlsdev\Api\helpers;

   class Validation
   {
      static public function cedula(string $cedula)
      {
         $rgx = "/^[0-9]+$/";

         return (\preg_match($rgx, $cedula)) ? \true : \false ;
      }

      static public function letterSpace(string $text)
      {
         $rgx = "/^[A-Zá-ü ]+$/i";

         return (\preg_match($rgx, $text)) ? \true : \false ;
      }

      static public function email(string $email)
      {
         $rgx = "/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i";

         return (\preg_match($rgx, $email)) ? \true : \false ;
      }

      static public function letters(string $text)
      {
         $rgx = "/^[A-Z]+$/i";

         return (\preg_match($rgx, $text)) ? \true : \false ;
      }
   }
   