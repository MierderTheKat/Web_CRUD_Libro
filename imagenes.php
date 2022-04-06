<?php
    require "iconeimagenes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.6.0.js"></script>

</head>
<body>
    <br><br><br><br><br>
    <div class="container">

        <form action="imagen_procesar.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-3">
                    <label class="form-label">Titulo</label>
                    <input type="text" name="titulo" value="" REQUIRED>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="autor" value="" REQUIRED>
                </div>
            </div>
            <br><br>
            <label class="form-label">Portada: </label>
            <input type="file" name="portada" REQUIRED>

            <br><br>
            <div>
                <input class="btn btn-success" type="submit" value="Guardar">
                <a class="btn btn-warning" type="button" href="imagen_mostrar.php" value="Guardar">Regresar</a>
            </div>
        </form>
    </div>

</body>
</html>
<!--
    <script>
        $("#btnEditar").on("click",function(evento){

            evento.preventDefault();

            var vTitulo = $("#Titulo").val();
            var vAutor = $("#Autor").val();
            var vPortada = $("#Portada").val();
            var vAccion = "Editar";
            console.log(vTitulo, vAutor, vAccion);

            $.ajax({
                url:"imagen_procesar.php",
                method:"POST",
                enctype: "multipart/form-data",
                dataType: "json",
                data:{
                    titulo: vTitulo,
                    autor: vAutor,
                    portada: vPortada,
                    accion: vAccion
                }
            }).done(function(datos){
                var json = JSON.parse(datos);
                
                if(json.clave == 0){
                    $("#feedback").text(json.texto);
                }
                else if (json.clave == 1){
                    $("#feedback").text(json.texto);
                }
                console.log(json);
            });

        });
    </script>
    
-->
    