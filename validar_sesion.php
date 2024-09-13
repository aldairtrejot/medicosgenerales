<?php
    
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (isset($_SESSION['id_postulantes']) && isset($_SESSION['curp']) && isset($_SESSION['postulante']) && isset($_SESSION['id_estatus'])){

}else {
    header('Location: ../../authentication-login.php');
}
