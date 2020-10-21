<?php

session_start();
	//require("conexion.php");
?>
<?php

	$username=$_POST['mail'];
	$pass=$_POST['pass'];

if(empty($username))
{
echo '<script>alert("INTRODUCE UN USUARIO")</script> ';
		
echo "<script>location.href='index.php'</script>";

}

 if(empty($pass))
 {
echo '<script>alert("INTRODUCE UNA CONTRASEÑA")</script> ';
		
echo "<script>location.href='index.php'</script>";
exit();
 }


//require_once('conexion.php');
 // $mysqli=new mysqli('localhost', 'root','','evatuitsa');
 $mysqli=new mysqli('mysql.itsa.edu.mx', 'dh_wspz9y','n!F5Xa2C','evatuitsa'); 
   ///////////////////////////////////////////////////////// //Validacion del administrador

$alum=mysqli_query ($mysqli,"SELECT * FROM alumnos WHERE no_de_control = '$username'");
$profe=mysqli_query($mysqli, "SELECT * FROM docente_tutor WHERE correo= '$username'");// AND contra= '$pass'");
$admin=mysqli_query($mysqli, "SELECT * FROM usuarios WHERE usuario = '$username'");//" AND password = '$pass'");

$alumno=mysqli_fetch_assoc($alum);
$profesor=mysqli_fetch_assoc($profe);
$administrador=mysqli_fetch_assoc($admin);

if($administrador['usuario']==$username)
{
	
     if($administrador['password'] == $pass)
     {

			$_SESSION['usuario'] = $username;

			header("Location: menu.php");
	  }
	  else
	  {

			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
		echo "<script>location.href='index.php'</script>";
		exit();
		}
}
else
{	if ($profesor['correo']==$username )
	{
	
     if($profesor['contra'] == $pass)
     {

			$_SESSION['apellidos_empleado'] = $username;

			header("Location: recibirTutor.php");
	  }
	  else
	  {

			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='index.php'</script>";
			exit();
		}
	# code...
	}
	else
	{
		if ($alumno['no_de_control']==$username) 
		{
	
     		if($alumno['no_de_control'] == $pass)
     		{

			$_SESSION['no_de_control'] = $username;

			header("Location: formulario.php");
	  		}
	  		else
	  		{

			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='index.php'</script>";
			exit();
			}
	
		}
		else
		{
echo '<script>alert("USUARIO NO ENCONTRADO")</script> ';
		
echo "<script>location.href='index.php'</script>";
exit();
	}

	}
} 

	
?>