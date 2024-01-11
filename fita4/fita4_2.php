<html>
 <head>
 	<title>Exemple de lectura de dades a MySQL</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
		form {
			float: left;
		}
		ul {
			float: left;
		}
 	</style>
 </head>
 
 <body>
 	<h1>Exemple de lectura de dades a MySQL</h1>
 
 	<?php
 		$conn = mysqli_connect('localhost','xavi','Superlocal123@');
 		mysqli_select_db($conn, 'world');
 		$consulta = "select distinct continent from country;";
 
 		$resultat = mysqli_query($conn, $consulta);
 
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>
    <form method="POST">
        <label> Selecciona un continent </label>
        <?php
 		# (3.2) Bucle while
 		while( $registre = mysqli_fetch_assoc($resultat) ){
 			$continent = $registre["continent"];
            echo " <br>\n\t\t<label> <input type='checkbox' name='opcion[]' value= '$continent' > $continent </label>";
 		}
        echo "\n";
        ?>
        <br>
        <input type="submit" value="tramet la consulta">
    </form>
    <?php
     if (isset($_POST["opcion"])) {
        $opcion = $_POST["opcion"];
        # echo "$opcion";
        # var_dump($opcion);

		$consulta = "select name from country where continent in ('".implode("','", $opcion)."')";

		$resultat = mysqli_query($conn, $consulta);
 
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
     }
    ?>

	<ul>
	 	<?php
			while( $registre = mysqli_fetch_assoc($resultat) ){
			   echo "\t\t<li>".$registre['name']."</li>\n";
			}

		?>
	</ul>

 </body>
</html>