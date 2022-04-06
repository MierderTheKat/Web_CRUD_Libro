<?php
include "iconeimagenes.php";

if(isset($_POST["submit"])){
    $opcion = $_POST["submit"];

    if($opcion == "agregar"){

        $Titulo = $_POST['titulo'];
        $Autor = $_POST['autor'];
        $Portada = addslashes(file_get_contents($_FILES['Portada']['tmp_name']));
        
        $stmt = $mysqli->prepare("INSERT INTO libros(titulo, autor, imagen) VALUES(?,?,'$Portada')");
        $stmt->bind_param("ss",$Titulo,$Autor);
        
        $stmt->execute();
    }
    else if($opcion == "eliminar"){

        $id = $_POST["id_eliminar"];

        $stmt = $mysqli->prepare("DELETE FROM libros WHERE id = ?");
        $stmt->bind_param("i",$id);

        $stmt->execute();
    }
    else if($opcion == "editar"){
        
        $id = $_POST["id_editar"];
        $Titulo = $_POST['titulo'];
        $Autor = $_POST['autor'];
        $Portada = addslashes(file_get_contents($_FILES['Portada']['tmp_name']));

        if($Portada==""){
            $stmt = $mysqli->prepare("UPDATE libros SET titulo='$Titulo', autor='$Autor' WHERE id='$id'");
            $stmt->execute();
        }
        else{
            $stmt = $mysqli->prepare("UPDATE libros SET titulo='$Titulo', autor='$Autor', imagen='$Portada' WHERE id='$id'");
            $stmt->execute();
        }
    }
    unset($_POST);
    unset($_REQUEST);
    header('Location: imagen_mostrar.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Base de Datos</title>
    <link rel="stylesheet" href="css/img.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    
    <script src="js/bootstrap.bundle.js"></script>
</head>
<body>

    <?php
        $resultado = $mysqli->query("SELECT * FROM libros");
    ?>

    <div class="container" type>

        <br><br>
        <!-- Button Agregar-->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#MyModal-Agregar">
        <i class="fas fa-plus"></i> Agregar</i></button>
        <!-- Modal -->
        <div class="modal fade" id="MyModal-Agregar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Libro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        
                    <form action="imagen_mostrar.php" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Titulo</label>
                                <input type="text" name="titulo" class="form-control" placeholder="Escribe el Titulo del Libro" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Autor</label>
                                <input type="text" name="autor" class="form-control" placeholder="Escribe el Autor del Libro" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Portada</label>
                                <input type="file" name="Portada" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                            <button class="btn btn-success" name="submit" value="agregar" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Titulo del libro</th>
                <th>Autor</th>
                <th>Portada</th>
                <th>Acción</th>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado ->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $fila[id];?></td>
                    <td><?php echo $fila[titulo];?></td>
                    <td><?php echo $fila[autor];?></td>
                    
                    <td><img class="imagen_portada" src="data:image/jpg;base64,<?php echo base64_encode($fila[imagen]); ?>"></td>
                    
                    <td class="Botones">
                        <div class="d-flex tabla_btn">
                            <!-- Button Editar-->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#MyModal-Editar<?php echo $fila[id];?>">
                            <i class="fas fa-pencil-alt"></i></i></button>
                            <!-- Modal -->
                            <div class="modal fade" id="MyModal-Editar<?php echo $fila[id];?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Informacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            
                                        <form action="imagen_mostrar.php" method="POST" enctype="multipart/form-data">

                                            <input type="hidden" name="id_editar" value="<?php echo $fila[id];?>">

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="form-label"><strong>Portada</strong></label>
                                                        <img class="imagen_portada" src="data:image/jpg;base64,<?php echo base64_encode($fila[imagen]); ?>">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Titulo</strong></label>
                                                            <input type="text" name="titulo" class="form-control" placeholder="Escribe el Titulo del Libro" value="<?php echo $fila[titulo];?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Autor</strong></label>
                                                            <input type="text" name="autor" class="form-control" placeholder="Escribe el Autor del Libro" value="<?php echo $fila[autor];?>" required>
                                                        </div>
                                                    
                                                        <div class="mb-3">
                                                            <input type="file" name="Portada" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                                <button class="btn btn-warning" name="submit" value="editar" type="submit">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Eliminar-->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#MyModal-Eliminar<?php echo $fila[id];?>">
                            <i class="fas fa-trash-alt"></i></i></button>
                            <!-- Modal -->
                            <div class="modal fade" id="MyModal-Eliminar<?php echo $fila[id];?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar Libro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            
                                        <form action="imagen_mostrar.php" method="POST" enctype="multipart/form-data">

                                            <input type="hidden" name="id_eliminar" value="<?php echo $fila[id];?>">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="form-label"><strong>Portada</strong></label>
                                                        <img class="imagen_portada" src="data:image/jpg;base64,<?php echo base64_encode($fila[imagen]); ?>">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="mb-3">
                                                            <label><strong>Titulo</strong></label>
                                                            <input type="text" class="form-control" value="<?php echo $fila[titulo];?>" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label><strong>Autor</strong></label>
                                                            <input type="text" class="form-control" value="<?php echo $fila[autor];?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                                <button class="btn btn-danger" name="submit" value="eliminar" type="submit">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        
    </div>


<script>


</script>

</body>
</html>