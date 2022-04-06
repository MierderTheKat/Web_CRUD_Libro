<?php
    require "iconeimagenes.php";

    $Titulo = $_POST['titulo'];
    $Autor = $_POST['autor'];

    $Portada = addslashes(file_get_contents($_FILES['portada']['tmp_name']));
        
    $stmt = $mysqli->prepare("INSERT INTO libros(titulo, autor, imagen) VALUES('$Titulo','$Autor','$Portada')");
    
    $stmt->execute();
    $stmt->close();
    
    echo " $Titulo --- $Autor --- ";

    echo json_encode("{\"texto\":\" se agrego correctamente\"}");

    unset($_POST);
    unset($_REQUEST);
    header('Location: imagenes.php');
?>