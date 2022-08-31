<?php
   namespace Charlsdev\Api\models;

   use Charlsdev\Api\helpers\Database;
   use Charlsdev\Api\helpers\Encription;
   use Charlsdev\Api\helpers\Model;
   use PDO;
   use PDOException;

   class User extends Model
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

      public static function existUser($cedula){
         try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT cedula FROM usuarios WHERE cedula = :cedula');

            $query->execute( ['cedula' => $cedula]);
            
            if($query->rowCount() > 0){
               return true;
            }else{
               return false;
            }
         }catch(PDOException $e){
            echo $e;
            return false;
         }
      }
   
      public function saveUser(){
         try{
            $query = $this->prepare('INSERT INTO usuarios (cedula, apellidos, nombres, email, privilegio, password) VALUES(:cedula, :apellidos, :nombres, :email, :privilegio, :password)');

            $query->execute([
               'cedula'  => $this->cedula, 
               'apellidos'  => $this->apellidos,
               'nombres'  => $this->nombres,
               'email'  => $this->email,
               'privilegio'  => $this->privilegio,
               'password'  => Encription::getHashedPassword($this->password),
            ]);

            return true;
         }catch(PDOException $e){
            error_log($e);
            return false;
         }
      }

      public static function getUserAuth($cedula):User {
         try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE cedula = :cedula');
            $query->execute(['cedula' => $cedula]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data) {
               $user = new User(
                  $data['cedula'],
                  $data['apellidos'],
                  $data['nombres'],
                  $data['email'],
                  $data['privilegio'],
                  $data['password']
               );

               $user->setCedula($data['cedula']);
               $user->setApellidos($data['apellidos']);
               $user->setNombres($data['nombres']);
               $user->setEmail($data['email']);
               $user->setPrivilegio($data['privilegio']);
               $user->setPassword($data['password']);

               return $user;
            } else {
               return false;
            }

         }catch(PDOException $e){
            return false;
         }
      }
      
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