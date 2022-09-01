<?php
   namespace Charlsdev\Api\controllers;

   use Charlsdev\Api\helpers\HttpRouter;
   use Charlsdev\Api\helpers\Validation;
   use Charlsdev\Api\models\User;

   class IndexCtrl extends HttpRouter
   {
      function __construct()
      {
         parent::__construct();
      }

      public function index()
      {
         return ['msg' => 'Welcome to API - PHP/PostgreSQL'];
      }

      public function allData()
      {
         $res = User::allUsers();
         return $res;
      }

      public function oneData()
      {
         $cedula = $this->get('cedula');

         $res = User::oneUser($cedula);
         return $res;
      }

      public function saveData()
      {
         $cedula = $this->post('cedula');
         $apellidos = $this->post('apellidos');
         $nombres = $this->post('nombres');
         $email = $this->post('email');
         $privilegio = $this->post('privilegio');
         $password = $this->post('password');

         if (
            empty($cedula) ||
            empty($apellidos) ||
            empty($nombres) ||
            empty($email) ||
            empty($privilegio) ||
            empty($password)
         ) {
            return ['msg' => 'Los campos están vacios.'];
         } else {
            if (!Validation::cedula($cedula)) {
               return ['msg' => 'Cédula no válida'];
            }

            if (!Validation::letterSpace($apellidos)) {
               return ['msg' => 'Apellidos no válidos'];
            }

            if (!Validation::letterSpace($nombres)) {
               return ['msg' => 'Nombres no válidos'];
            }

            if (!Validation::email($email)) {
               return ['msg' => 'Correo no válido'];
            }

            if (!Validation::letters($privilegio)) {
               return ['msg' => 'Privilegio no válido'];
            }

            $user = new User($cedula, $apellidos, $nombres, $email, $privilegio, $password);

            if (User::existUser($cedula)) {
               return ['msg' => 'Usuario ya registrado'];
            } else {
               if ($user->saveUser()) {
                  return ['msg' => 'Usuario registrado con éxito'];
               } else {
                  return ['msg' => 'No se ha podido registrar el usuario'];
               }
            }
         }
      }

      public function deleteData()
      {
         $cedula = $this->post('cedula');

         if (
            empty($cedula)
         ) {
            return ['msg' => 'Los campos están vacios.'];
         } else {
            if (!Validation::cedula($cedula)) {
               return ['msg' => 'Cédula no válida'];
            }

            if (!User::existUser($cedula)) {
               return ['msg' => 'Usuario no registrado'];
            } else {
               if (User::deleteUser($cedula)) {
                  return ['msg' => 'Usuario eliminado con éxito'];
               } else {
                  return ['msg' => 'No se ha podido eliminar al usuario'];
               }
            }
         }
      }

      public function updateData()
      {
         $cedula = $this->post('cedula');
         $apellidos = $this->post('apellidos');
         $nombres = $this->post('nombres');
         $email = $this->post('email');
         $privilegio = $this->post('privilegio');

         if (
            empty($cedula) ||
            empty($apellidos) ||
            empty($nombres) ||
            empty($email) ||
            empty($privilegio)
         ) {
            return ['msg' => 'Los campos están vacios.'];
         } else {
            if (!Validation::cedula($cedula)) {
               return ['msg' => 'Cédula no válida'];
            }

            if (!Validation::letterSpace($apellidos)) {
               return ['msg' => 'Apellidos no válidos'];
            }

            if (!Validation::letterSpace($nombres)) {
               return ['msg' => 'Nombres no válidos'];
            }

            if (!Validation::email($email)) {
               return ['msg' => 'Correo no válido'];
            }

            if (!Validation::letters($privilegio)) {
               return ['msg' => 'Privilegio no válido'];
            }

            if (!User::existUser($cedula)) {
               return ['msg' => 'El usuario a editar no se encuentra registrado'];
            } else {
               return User::updateUser($cedula, $apellidos, $nombres, $email, $privilegio);
            }
         }
      }
   }
