<!DOCTYPE html>
<html>
    <head>
        <title>Tienda de antigüedades</title>
        <meta charset="utf-8">
        <meta name="author" content="Pon tu nombre y apellidos">
        <style>
            .cabecera{
                /*background-color: #f1f1f1;*/
                width: 100%;
                text-align: center;
                color: #747474;
                margin: auto;
                font-size: 30px;
                padding: 3px;
            }
            .barra{
                width: 100%;
                text-align: center;
                background-color: #747474;
                padding: 3px;
            }
            .barra a{
                color: white;
                font-size: 20px;
                text-decoration: none;
                margin-right: 5px;
                padding: 2px;
            }
            .barra a:hover{
                background-color: #A9A9A9;
                color: white;
            }
			.imagen{
                width: 40%;
                margin-left: 30%;
            }
			table{
                width: 100%;
                text-align: center;
				font-size: 20px;
                margin: auto;
                background-color: white;
                color: black;
                border-collapse: collapse;
            }
            td , th{
                border: 1px solid grey;
            }
            #nombre{
                margin-right:-32%;
                margin-left:30%;
            }
            img{
                margin-left:43%;
            }
            h2{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <form action="#" method="get">
        <!--<div class="cabecera">-->
            <?php
            session_start();
            if(isset($_GET["salir"])){
                session_destroy();
                header("Location: index.php");
            }
            if(isset($_COOKIE["color"])){
                $color=$_COOKIE["color"];
            }else{
                $color="#F1F1F1";
            }
            if(isset($_GET["cambio_color"])){
                $color="#".$_GET["colores"];
                setcookie("color",$color,time()+3600*24*30);
                
            }
            echo "<div class='cabecera' style='background-color:$color'>"
            ?>
            <h1>Tienda de antigüedades</h1>
        </div>
        <div class="barra">
            <a href="login.php">Login</a>
            <a href="articulos.php">Ver articulos</a>
            <a href="carrito.php">Ver carrito</a>
            <a href="?salir=salir">Salir</a>
            <br><select name="colores">
                <option value="F1F1F1">Gris</option>
                <option value="7FB5B5">Azul</option>
                <option value="C19CE1">Morado</option>
            </select>
            <input type="submit" value="Cambiar de color" name="cambio_color">
            <?php
                if(isset($_SESSION["usuario"])){
                    $nombre=$_SESSION["usuario"]["nombre"];
                    echo "<a id='nombre'>$nombre</a>";
                }
            ?>
        </div>
        </form> 
        <?php
        require("funcionConexion.php");
        $con=conexion("tienda");

        





        if(isset($_GET["id"])){
            $id=$_GET["id"];
            
            $consulta="SELECT nombre,descripcion,precio,foto FROM articulos where id='$id'";
            $respuesta=mysqli_query($con,$consulta);
            $num_filas=mysqli_num_rows($respuesta);
            if($num_filas===0){
                echo "<h2>No hay articulos con este id</h2>";
            }else{
                $fila=mysqli_fetch_row($respuesta);
                $nombre=$fila[0];
                $descripcion=$fila[1];
                $precio=$fila[2];
                $foto=$fila[3];
                echo "<h2>$nombre</h2>";
                echo "<h2>$descripcion</h2>";
                echo "<h2>$precio</h2>";
                echo "<img src='images/$foto' width='200' height='300'>";
                echo "<h2><a href='articulos.php?id_compra=$id'>Meter al carrito</h2>";
                echo "<h2><a href='articulos.php'>Volver al listado</h2>";

                
            }
        }else{
            echo "<h2>No hay articulos con este id</h2>";
        }
            
            
        ?>
    </body>
</html>