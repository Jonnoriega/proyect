<!DOCTYPE html>
   <?php
            session_start();
            if(isset($_GET["salir"])){
                session_destroy();
                header("Location: index.php");
            }
          
            ?>
<html>
    <head>
        <title>mobile-centre</title>
        <meta charset="utf-8">
      <link rel="stylesheet" href="css/bootstrap.min.css">
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
            
            ul {
                  list-style-type: none;
                  margin: 0;
                  padding: 0;
                  overflow: hidden;
                  background-color: #333;
                
                
                }

                li {
                  float: left;
                    bottom: 0px;
                    
                }

                li a {
                  display: block;
                  color: white;
                  text-align: center;
                  padding: 14px 16px;
                  text-decoration: none;
                }

                li a:hover:not(.active) {
                  background-color: #111;
                }

                .active {
                  background-color: #4CAF50;
                }
            
			
			div.nav{
				margin: -10px;
                width: 100%;
				background-color:red;
                
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
            
            td{
                width:25%;
            }
            
            
            #nombre{
                margin-right:-32%;
                margin-left:30%;
            }
             #articulos{
                border-style:none;
                background-size:cover;
                width:100%;
                height:100px;
            }
         </style>
    </head>
	 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img src="./images/logoweb.png" style="width:200px;height:100px;" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="articulos.php">Ver articulos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carrito.php">Ver carrito</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?salir=salir">Salir</a>
      </li>
    </ul>
	<form action="#" method="get">
   <?php
                if(isset($_SESSION["usuario"])){
                    $nombre=$_SESSION["usuario"]["nombre"];
                    echo "<h3 class='text-primary' id='nombre'>$nombre</h3>";
                }
            ?>
  </form>
  </div>
  
  
</nav>
    <body>
       
        
         <form action="detalle.php" method="get">
            <?php
                require("funcionConexion.php");
                $con=conexion("tienda");
                if(isset($_GET["id_compra"])){
                    $id=$_GET["id_compra"];
                    $consulta="SELECT nombre,precio from articulos where id='$id'";
                    $respuesta=mysqli_query($con,$consulta);
                    $fila=mysqli_fetch_row($respuesta);
                    $nombre_articulo=$fila[0];
                    $precio=$fila[1];
                    $compra=array("id"=>$id,"nombre"=>$nombre_articulo,"precio"=>$precio);
                    if(!isset($_SESSION["compras"])){
                        $_SESSION["compras"]=array();
                    }
                    $repetido=false;
                    for($k=0;$k<count($_SESSION["compras"]);$k++){
                        if($id===$_SESSION["compras"][$k]["id"])
                            $repetido=true;
                    }
                    if($repetido===false)
                        array_push($_SESSION["compras"],$compra);
                    
                    echo "<pre>".print_r($_SESSION["compras"])."</pre>";
                    
                }
                
                $consulta="SELECT id,nombre,descripcion,precio,foto FROM articulos WHERE disponible='S'";
                $respuesta=mysqli_query($con,$consulta);
                echo "<table>";
                
               for ($row = 0; $row < 5; $row ++) { 
                    echo "<tr>";
                   while($fila=mysqli_fetch_row($respuesta)){
                   
                    
                        echo "<td><input type='submit' id='articulos' name='id' value='$fila[0]' style='font-size:0px;background-image:url(\"images/$fila[4]\")'><br/>
                        $fila[1] $fila[2]<br/>
                        Precio:$fila[3]<br/>
                        
                        </td>";
                        
                        //echo "<form action='detalle.php' method='GET'>";
               } }
                        //echo "</form>";
                    echo "</tr>";
                                                
                echo "</table>";
            ?>

            </form>
    </body>
</html>