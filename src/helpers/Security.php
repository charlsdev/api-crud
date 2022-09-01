<?php
   namespace Charlsdev\Api\helpers;

   use PDOException;

   class Security
   {
      static function getHashedPassword($password){
         return password_hash($password, \PASSWORD_BCRYPT, ['cost' => 10]);
      }
   
      static function comparePasswords($passText, $passEncrypt){
         try{
            return password_verify($passText, $passEncrypt);
         }catch(PDOException $e){
            \error_log($e);
            
            return NULL;
         }
      }
   }
   