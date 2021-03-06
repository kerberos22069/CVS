<?php

include('database_connection.php');

$message = '';

if(isset($_GET['activation_code']))
//    echo $_GET['activation_code'];
{
	$query = "
		SELECT * FROM usuario 
		WHERE user_activation_code = :user_activation_code
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_activation_code'=>$_GET['activation_code']
		)
	);
	$no_of_row = $statement->rowCount();
	
	if($no_of_row > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_email_status'] == 'NO VERIFICADO')
			{
				$update_query = "
				UPDATE usuario 
				SET user_email_status = 'VERIFICADO' 
				WHERE idusuario = '".$row['idusuario']."'
				";
				$statement = $connect->prepare($update_query);
				$statement->execute();
				$sub_result = $statement->fetchAll();
				if(isset($sub_result))
				{
					$message = '<label class="text-success">Su Cuenta  se ha verificado correctamente  <br />You can login here - <a href="login.php">Login</a></label>';
				}
			}
			else
			{
				$message = '<label class="text-info">
Su Cuenta ya esta verificada</label>';
			}
		}
	}
	else
	{
		$message = '<label class="text-danger">Enlace inválido</label>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Activacion de inicio de sesión con verificación de correo electrónico
</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 align="center">inicio de sesión con verificación de correo electrónico</h1>
		
			<h3><?php echo $message; ?></h3>
			
		</div>
	
	</body>
	
</html>