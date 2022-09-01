<?php
   namespace Charlsdev\Api\models;

   use Charlsdev\Api\helpers\Database;
   use Charlsdev\Api\helpers\Security;
   use Charlsdev\Api\helpers\ModelDB;
   use PDO;
   use PDOException;

   class User extends ModelDB
   {
      public function __construct(
         private string $cedula,
         private string $apellidos, 
         private string $nombres, 
         private string $email, 
         private string $privilegio, 
         private string $password
      ) {
         parent::__construct();
      }

      public static function existUser($cedula)
      {
         try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT cedula FROM users WHERE cedula = :cedula');

            $query->execute(['cedula' => $cedula]);
            
            if($query->rowCount() > 0){
               return true;
            }else{
               return false;
            }
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }
   
      public function saveUser()
      {
         try{
            $query = $this->prepare('INSERT INTO users (cedula, apellidos, nombres, email, privilegio, password) VALUES(:cedula, :apellidos, :nombres, :email, :privilegio, :password)');

            $query->execute([
               'cedula'  => $this->cedula, 
               'apellidos'  => $this->apellidos,
               'nombres'  => $this->nombres,
               'email'  => $this->email,
               'privilegio'  => $this->privilegio,
               'password'  => Security::getHashedPassword($this->password),
            ]);

            return true;
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }

      public static function deleteUser($cedula)
      {
         try{
            $db = new Database();

            $query = $db->connect()->prepare('DELETE FROM users WHERE cedula = :cedula');

            $query->execute([
               'cedula'  => $cedula
            ]);

            return true;
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }

      public static function allUsers()
      {
         try{
            $db = new Database();

            $query = $db->connect()->query('SELECT cedula, apellidos, nombres, email, privilegio FROM users');
            $res = $query->fetchAll(\PDO::FETCH_ASSOC);

            if ($res) {
               return $res;
            } else {
               return ['msg' => 'No existen usuarios registrados en la DB.'];
            }
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }

      public static function oneUser($cedula)
      {
         try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT cedula, apellidos, nombres, email, privilegio FROM users WHERE cedula = :cedula');

            $query->execute([
               'cedula'  => $cedula
            ]);
            
            $res = $query->fetch(\PDO::FETCH_ASSOC);

            if ($res) {
               return $res;
            } else {
               return ['msg' => 'Usuario no registrado en la DB.'];
            }
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }

      public static function updateUser($cedula, $apellidos, $nombres, $email, $privilegio)
      {
         try{
            $db = new Database();

            $query = $db->connect()->prepare('UPDATE users SET apellidos = :apellidos, nombres = :nombres, email = :email, privilegio = :privilegio WHERE cedula = :cedula');

            $query->execute([
               'cedula'  => $cedula, 
               'apellidos'  => $apellidos,
               'nombres'  => $nombres,
               'email'  => $email,
               'privilegio'  => $privilegio
            ]);

            \error_log($query->rowCount());

            if ($query->rowCount()) {
               return ['msg' => 'Usuario actualizado con éxito.'];
            } else {
               return ['msg' => 'No se ha podido actualizar al usuario.'];
            }
            
         }catch(PDOException $e){
            exit($e->getMessage());

            return false;
         }
      }
      
      // * All GET and SET initials CLASS
      public function getCedula()
      {
         return $this->cedula;
      }
      
      public function setCedula($cedula)
      {
         $this->cedula = $cedula;
      }
      
      public function getApellidos()
      {
         return $this->apellidos;
      }
      
      public function setApellidos($apellidos)
      {
         $this->apellidos = $apellidos;
      }
      
      public function getNombres()
      {
         return $this->nombres;
      }
      
      public function setNombres($nombres)
      {
         $this->nombres = $nombres;
      }
      
      public function getEmail()
      {
         return $this->email;
      }
      
      public function setEmail($email)
      {
         $this->email = $email;
      }
      
      public function getPrivilegio()
      {
         return $this->privilegio;
      }
      
      public function setPrivilegio($privilegio)
      {
         $this->privilegio = $privilegio;
      }
      
      public function getPassword()
      {
         return $this->password;
      }
      
      public function setPassword($password)
      {
         $this->password = $password;
      }
   }