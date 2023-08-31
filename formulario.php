<?php
include('conexion.php');//incluimos el archivo de conexion y asi podemos usar las variables creadas en este documento  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php

        $nit="";
        $nombre="";
        $direccion="";
        $telefono="";
        $fecha_ingreso="";
        $cupo_credito="";
        $foto="";
    if(isset($_POST['buscar'])){

        $nitbuscar=$_POST['buscarcc'];
        $consulta=$conexion->query("select * from cliente where nit='$nitbuscar'");
        while($resultadoconsulta=$consulta->fetch_array()){
            $nit=$resultadoconsulta[0];
            $nombre=$resultadoconsulta[1];
            $direccion=$resultadoconsulta[2];
            $telefono=$resultadoconsulta[3];
            $fecha_ingreso=$resultadoconsulta[4];
            $cupo_credito=$resultadoconsulta[5];
            $foto=$resultadoconsulta[6];
            
        }

    }

    ?>
</head>
<body>
    <center>
        <h2>Manipulacion de datos con php</h2>
        <form action="" method="post" enctype="multipart/form-data"> <!--  atributo que indica que manipula rchivos multiemdiacon esto ultimo le informamos al formulairo que trabajaremos con archivos multimedia  -->
        <label for="">Buscar</label>
        <!-- en el input el name corresponde a una columna en la bd -->
        <input type="text" name="buscarcc" id=""  placeholder="buscar cliente">
        <input type="submit"  name="buscar" value="buscar" >
        <hr>

        <label for="">Nit o CC</label>
        <input type="text" name="nit" id=""placeholder="ingrese el nit o cc del nuevo cliente" value="<?php echo $nit ?>">
        <br><br>

        <label for="">Nombres</label>
        <input type="text" name="nombre" id=""placeholder="ingrese el nombre completo" value="<?php echo $nombre ?>">
        <br><br>

        <label for="">Direccion</label>
        <input type="text" name="direccion" id=""placeholder="ej cll 39#23-12" value="<?php echo $direccion ?>">
        <br><br>

        <label for="">Telefono</label>
        <input type="text" name="telefono" id=""placeholder="32141451" value="<?php echo $telefono ?>">
        <br><br>
        
        <label for="">cupo del credito</label>
        <input type="number" name="cupo_credito" id=""placeholder="valor en pesos $" value="<?php echo $cupo_credito ?>">
        <br><br>
        
        <label for="">Fecha ingreso</label>
        <input type="date" name="fecha_ingreso" id="" value="<?php echo $fecha_ingreso ?>">
        <br><br>

        <label for="">subir foto</label>
        <input type="file" name="foto" id="" >
        <br><br>

        <label for="">foto</label>
        <img src="<?php echo $foto ?>" alt="" width="80" height="80">
        <br><br>

        <input type="submit" value="guardar nuevo cliente" name="guardar">
        <input type="submit" value="listar todos los clientes" name="listar">
        <input type="submit" value="actualizar cliente" name="actualizar">
        <input type="submit" value="eliminar cliente" name="borrar">

    </form>
        
        
    </center>
        <?php
            if(isset($_POST['guardar'])){
                //los datos de entrada almacenados en variables 
                $nit=$_POST['nit'];
                $nombre=$_POST['nombre'];
                $direccion=$_POST['direccion'];
                $telefono=$_POST['telefono'];
                $cupo_credito=$_POST['cupo_credito'];
                $fecha_ingreso=$_POST['fecha_ingreso'];
                
               /*  manejo de archivos */
               /* en archivos tipo file siempre traemos el archivo y luego el name como atributo */
               $nombre_foto=$_FILES['foto']['name']; /* nombre foto */
               $ruta=$_FILES['foto']['tmp_name'];/*  ruta o path  archivo */   /* TPM_NAME nombre de la ruta */
               $foto='foto/'.$nombre_foto; /* ruta y nombre archivo*/
               copy($ruta,$foto); /* guarda el archivo en una ruta especifica */

               //verificar que no existan valores duplicados para el campo de nit o cedula 

               $sqlbuscar="SELECT nit FROM cliente WHERE nit='$nit' ";

               if($resultado=mysqli_query($conexion,$sqlbuscar)){
                $nroregistros=mysqli_num_rows($resultado);
                if($nroregistros>0){
                    echo "ese nit ya existe";
                }else{
                    mysqli_query($conexion, "INSERT INTO cliente (nit,nombre,direccion,telefono,fecha_ingreso,cupo_credito,foto) VALUES ('$nit','$nombre','$direccion','$telefono','$fecha_ingreso','$cupo_credito','$foto')");
                    echo "datos guardados";
                }
               }

            }





        ?>

</body>
</html>