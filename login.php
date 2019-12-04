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
            p{
                text-align:center;
            }
            #caja{
                margin-top:2.5em;
            }
            #nombre{
                margin-right:-32%;
                margin-left:30%;
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
       
        <form action="#" method="POST">
            <div id="caja">
                <p><strong>Correo electrónico</strong><input type="text" name="email"></p>
                <p><strong>Contraseña </strong><input type="password" name="contrasena"></p>
                <p><input type="submit" value="Entrar" name="entrar"></p>
                </div>
                <?php
                if(isset($_POST["entrar"])){
                    $email=$_POST["email"];
                    $erroresValidacion="";
                    $contrasena=$_POST["contrasena"];
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
					if($email="admin"){
						 $erroresValidacion="";
						
					}
										
                     else if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
                        //es incorrecto el email
                        $erroresValidacion="  <p>Error de validacion del email</p>";

                    } 

                    if($erroresValidacion===""){
                        require("funcionConexion.php");
                        $con=conexion("tienda");
                        $consulta="select id,nombre,hashpass from clientes where email='$email'";
                        $respuesta=mysqli_query($con,$consulta)or die("Error consulta");
                        $fila=mysqli_fetch_row($respuesta);
                        $id=$fila[0];
                        $nombre=$fila[1];
                        $hash=$fila[2];
                        if(password_verify($contrasena,$hash)){
                            $usuario=array("id"=>$id,"nombre"=>$nombre);
                            $_SESSION["usuario"]=$usuario;
                            $_SESSION["compras"]=array();
                            header("Location: articulos.php");
                            
                        }else{
                            echo "<p>Los datos no son correctos</p>";
                        }
                            


                        
                            
                        }else{
                        echo $erroresValidacion;
                    }
                }
                    

                ?>

        </form> 

    </body>
	 <script  type="text/javascript" src="js/jquery-3.4.1.slim.min.js"></script>
<script  type="text/javascript" src="js/bootstrap.min.js"></script>
<script  type="text/javascript" src="js/popper.min.js"ss></script>
</html>