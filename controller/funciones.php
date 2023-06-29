<?php
require '../db/sql.php';
session_start();

switch ($_POST['funcion']) {
    case "ingreso":
        $correo_usuario = $_POST['correo_usuario'];
        $contrasena_usuario = $_POST['contrasena_usuario'];

        $consulta_sql = "SELECT * FROM ib_usuario WHERE correo_usuario ='" . $correo_usuario . "' AND contrasena_usuario='" . $contrasena_usuario . "'";
        $query = $conn->query($consulta_sql);

        $row = $query->fetch_row();

        if ($row == true) {
            $rol = $row[4];
            $nombre = $row[1];

            $_SESSION['rol'] = $rol;
            $_SESSION['nombre_usuario'] = $row[1];

            switch ($rol) {
                case 0:
                    $_SESSION["correo_usuario"] = $correo_usuario;
                    $_SESSION["contrasena_usuario"] = $contrasena_usuario;
                    header("Location: ../views/index.php");
                    break;
                case 1:
                    $_SESSION["correo_usuario"] = $correo_usuario;
                    $_SESSION["contrasena_usuario"] = $contrasena_usuario;
                    header("Location: ../views/gestor.php");
                    break;
                default:
                    // Rol desconocido
                    header("Location: ../views/index.php");
            }
        } else {
            // No existe el usuario o las credenciales son incorrectas
            header("Location: ../views/index.php");
        }
        break;
    default:
        // Función desconocida
        header("Location: ../views/index.php");

        

    

		break;
    
    case "recuperar":
    $correo_usuario = $_POST['correo_usuario'];
    $consulta_sql = "SELECT correo_usuario, id_usuario FROM `ib_usuario` WHERE correo_usuario='" . $correo_usuario . "'";
    
    $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $longpalabra=8;
            for($temp='', $n=strlen($caracteres)-1; strlen($temp) < $longpalabra ; ) {
              $x = rand(0,$n);
              $temp.= $caracteres[$x];
            }
    $consulta_sql = "UPDATE ib_usuario SET contrasena_usuario = '. $temp .'  WHERE correo_usuario='" . $correo_usuario . "'";

	 if (!$resultado_consulta = $conexion->query($consulta_sql)) {
	   echo "Lo sentimos, este sitio web esta experimentando problemas.";
	   echo "Error: La ejecucion de la consulta fallo debido a: \n";
	   echo "Query: " . $consulta_sql . "\n";
	   exit;
	 }else{
	   if ($resultado_consulta -> num_rows > 0) {

	    $row = $resultado_consulta -> fetch_array(MYSQLI_ASSOC);
	    $correo = $row["correo_usuario"];
	    $asunto = 'Recuperacion de clave';
        $mensaje = '
        <html>
        <body>
          <p>Hemos recibido su solicitud para recuperar contrase&ntilde;a</p>
          <br>
          <p>Su contrase&ntilde;a es: ' . $temp.'</p>
          <br>
          <p>Gracias!</p>
        </body>
        </html>
        ';
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Cabeceras adicionales
            
        $cabeceras .= 'From: Recuperar clave! <recuperacion@usuario11.com>' . "\r\n";
	    
        mail($correo, $asunto, $mensaje,$cabeceras);

        
        echo '<script type="text/javascript">alert("Correo de recuperacion enviado a: '.$correo.'");</script>';
        echo '<script>location.href="https://usuario11.talleresmelipilla.cl/griseld/#"</script>';
    	   }else{
    	       echo "<script> alert('No se encontro el usuario: ".$nombre_usuario."');window.location= 'https://usuario11.talleresmelipilla.cl/griseld/' </script>";
    	   }}
    	   
    	$resultado_consulta -> free();
	    $conn -> close();
	break;
	   
	
	case "registro":
	    $nombre = $_POST["nombre"];
        $pass = $_POST["contrasena"];
        $correo = $_POST["correo"];
        $rol = $_POST["rol"];
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $consulta_sql = "SELECT * FROM ib_usuario WHERE correo_usuario ='" . $correo . "'";

    	 if (!$resultado_consulta = $conn->query($consulta_sql)) {
    	   echo "Lo sentimos, este sitio web esta experimentando problemas.";
    	   echo "Error: La ejecucion de la consulta fallo debido a: \n";
    	   echo "Query: " . $consulta_sql . "\n";
    	   exit;
    	 }else{
    	   if ($resultado_consulta -> num_rows > 0) {	
    	     echo "<script> alert('Error, el correo ya esta en uso');window.location.href = '../views/registro.php'; </script>";
    	   }else{
    	     $query = "INSERT INTO `ib_usuario` (`nombre_usuario`, `contrasena_usuario`, `correo_usuario`,`rol`) VALUES ('".$nombre."', '".$pass."', '".$correo."', '".$rol."')";
             $conn->query($query);
             $row = $resultado_consulta -> fetch_array(MYSQLI_ASSOC);
             
    	     $asunto = 'BIENVENIDO A Portal del Campo!';
    	     
            $mensaje = '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Bienvenido/a a Portal del Campo</title>
            </head>
            <body>
                <header>
                    <h1>Bienvenido/a a Portal del Campo</h1>
                    <p>¡Gracias por unirte a nosotros!</p>
                </header>
                <main>
                    <p>Hola ' . $nombre.',</p>
                    <p>En nombre de todo el equipo de Portal del Campo, te damos una cálida bienvenida.</p>
                    <p>Estamos emocionados de tenerte  y nos encantaría que disfrutes de todos los productos que ofrecemos.</p>
                    <p>No dudes en contactarnos si necesitas ayuda con cualquier cosa. Nuestro equipo de soporte está disponible para ayudarte en cualquier momento.</p>
                    <p>Gracias de nuevo por unirte a nosotros. ¡Esperamos que disfrutes tu estadía en Portal del Campo!</p>
                </main>
                <footer>
                    <p>Atentamente,</p>
                    <p>Equipo de Portal del Campo</p>
                </footer>
            </body>
            </html>

            ';
            
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Cabeceras adicionales
            
            $cabeceras .= 'From: Bienvenido! <PortaldelCampo@usuario11.com>' . "\r\n";
            
            

    	    
            mail($correo, $asunto, $mensaje,$cabeceras);

            echo "<script> alert('Usuario $nombre registrado'); window.location.href = '../views/login.php'; </script>";
            
    	   }}
	break;    

    case "generar":
       
     
        
    
    break;
	
 }
