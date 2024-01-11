<html>
 <head>
 	<title>Fita 3</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 
 <body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <select id="opciones" name="opciones">
            <?php
            # (1.1) Connectem a MySQL (host,usuari,contrassenya)
 		    $conn = mysqli_connect('localhost','xavi','Superlocal123@');
 
 		    # (1.2) Triem la base de dades amb la que treballarem
 		    mysqli_select_db($conn, 'world');

            $sql = "SELECT DISTINCT Continent FROM country";
            $result= mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row["Continent"] . "'>" . $row["Continent"] .  "</option>";
        }

            ?>
        </select>

        <input type="submit" value="Enviar">
    </form>
 	<?php
        $campo1 = $_POST["opciones"];
 
 		# (2.1) creem el string de la consulta (query)
        $consulta = "SELECT country.Name from country where country.Continent = '$campo1'";

 
 		# (2.2) enviem la query al SGBD per obtenir el resultat
 		$resultat = mysqli_query($conn, $consulta);
 
 		# (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
 		#     posem un missatge d'error i acabem (die) l'execució de la pàgina web
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>
 
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<?php
 		# (3.2) Bucle while

 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
 			# els \t (tabulador) i els \n (salt de línia) son perquè el codi font quedi llegible
  
 			# (3.3) obrim fila de la taula HTML amb <tr>
 			echo "\t<ul>\n";
 
 			# (3.4) cadascuna de les columnes ha d'anar precedida d'un <td>
 			#	després concatenar el contingut del camp del registre
 			#	i tancar amb un </td>
 			echo "\t\t<li>".$registre["Name"]."</li>\n";
 		
 
 			# (3.5) tanquem la fila
 			echo "\t</ul>\n";
 		}
 	?>
  	<!-- (3.6) tanquem la taula -->
 </body>
</html>
