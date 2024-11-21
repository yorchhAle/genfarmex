<?php
session_start();
require_once __DIR__ . '/../models/modeloUsuario.php';

class AuthController {
    public function login($usuario, $contrasena) {
        $usuarioModel = new Usuario();
        $usuarioData = $usuarioModel->obtenerPorUsuario($usuario);

        if ($usuarioData) {
            if ($contrasena == $usuarioData['pass']) { 
                session_start();
                $_SESSION['usuario'] = $usuarioData['usuario'];
                $_SESSION['tipoUsuario'] = $usuarioData['tipoUsuario'];

                // Role-based redirection
                if ($_SESSION['tipoUsuario'] == 'admin') {
                    header("Location: panel.php"); 
                } elseif ($_SESSION['tipoUsuario'] == 'cliente') {
                    header("Location:catalogo.php"); 
                } elseif ($_SESSION['tipoUsuario'] == 'cliente')  {
                    header("Location:catalogo.php"); 
                }else{
                    header("Location: login.php");
                }
                exit;
            } else {
                echo "<script>alert('Contraseña incorrecta.'); window.location.href='../views/inicioSesion.html';</script>";
            }
        } else {
            echo "<script>alert('Usuario no encontrado.'); window.location.href='../views/inicioSesion.html';</script>";
        }
    }
}



?>
