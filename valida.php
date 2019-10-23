<?php
date_default_timezone_set('America/Sao_Paulo');
  session_start();
  if (!isset($_SESSION['usuario'])) {
      header("location:info.php");
  }
  if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade'] > 3600)) {

    // última atividade foi mais de 60 minutos atrás
    session_unset();     // unset $_SESSION  
    session_destroy();   // destroindo session data 
    echo "<script>alert('Sua sessão expirou')</script>";
    header("location:info.php");
}
$_SESSION['ultima_atividade'] = time();
