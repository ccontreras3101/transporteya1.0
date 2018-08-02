 <html>
<head>
	
</head>
<body>
<?php
$to = 'contreras.camilo@gmail.com';
$subject =  $_POST['email'];
$headers = "From: \r\n". $_POST['name'];
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message .= 
"<span style='color:#000;'>
	<table>
		<tr>
			<td>De:</td><td>".$_POST['name']."</td>
		</tr>
		<tr>
			<td>Para:</td><td> contreras.camilo@gmail.com</td>
		</tr>
		<tr>
			<td>Asunto:</td><td>Contacto</td>
		</tr>
		<tr>
			<td>Mensaje:</td>".$_POST['body'].".<td></td>
		</tr>
	</table>
</span>";
//mail($to,$subject,$message,$headers,$parameters);
if ( mail($to,$subject,$message,$headers,$parameters) ) {
	echo '<script type="text/javascript">';
	echo 'alert("Su email fue enviado con Exito, nos comunicaremos con Ud. a la brevedad posible");';
	echo 'window.location.href = "Index.php"';
	echo '</script>';
   } 
?>
</body>
</html>