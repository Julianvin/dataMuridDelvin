<?php 
    session_start();
    
    if (!empty($_SESSION['dataSiswa'] && isset($_GET['i']))) {
        unset($_SESSION['dataSiswa'][$_GET['i']]);
        header('Location: index.php');
        exit;
    }
    
    header("Location: index.php");
?>