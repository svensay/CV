<?php  

// Connect to mysql and performs all the verifications needs. 
function connect_database($host, $username, $password, $dbname)
{
	$connexion = mysqli_connect($host, $username, $password);

	if (mysqli_connect_errno()) 
	{
		die("Connection failed: ".mysqli_connect_errno());
	}
	mysqli_set_charset($connexion, "utf8");

	$query = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	request_database($connexion, $query);

	$query = "USE ".$dbname;
	request_database($connexion, $query);

	$query = "CREATE TABLE IF NOT EXISTS competences (
  				id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  				h3 VARCHAR(256) NOT NULL DEFAULT '',
  				h4 VARCHAR(256) NOT NULL DEFAULT '',
  				description TEXT NOT NULL DEFAULT '') 
  				ENGINE=InnoDB DEFAULT CHARSET=utf8";
	request_database($connexion, $query);

	$query = "CREATE TABLE IF NOT EXISTS experiences (
  				id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  				date_from DATE NOT NULL,
  				date_to DATE NOT NULL,
  				h4 VARCHAR(256) NOT NULL DEFAULT '',
  				description TEXT NOT NULL DEFAULT '') 
  				ENGINE=InnoDB DEFAULT CHARSET=utf8";
	request_database($connexion, $query);

	$query = "CREATE TABLE IF NOT EXISTS formations (
  				id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  				date_from DATE NOT NULL,
  				date_to DATE NOT NULL,
  				h4 VARCHAR(256) NOT NULL DEFAULT '',
  				description TEXT NOT NULL DEFAULT '') 
  				ENGINE=InnoDB DEFAULT CHARSET=utf8";
	request_database($connexion, $query);

	$query = "CREATE TABLE IF NOT EXISTS projets (
  				id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  				h3 VARCHAR(256) NOT NULL DEFAULT '',
  				h4 VARCHAR(256) NOT NULL DEFAULT '',
  				description TEXT NOT NULL DEFAULT '') 
				ENGINE=InnoDB DEFAULT CHARSET=utf8";
	request_database($connexion, $query);

	$query = "CREATE TABLE IF NOT EXISTS loisirs (
  				id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  				h3 VARCHAR(256) NOT NULL DEFAULT '',
  				description TEXT NOT NULL DEFAULT '') 
				ENGINE=InnoDB DEFAULT CHARSET=utf8";
	request_database($connexion, $query);

	return $connexion;
}

// Make a request to the datebase.
function request_database($connexion, $query)
{
	$result = mysqli_query($connexion, $query);

	if(!$result)
	{
		die("Error query: ".mysqli_error($connexion));
	}

	return $result;
}

// Show contents of the datebase on the web page. 
function show_resuslt($connexion, $section)
{
	$query = "SELECT * FROM ".$section;
	if($section == 'experiences' || $section == 'formations'){
		$query .= " ORDER BY date_from DESC"; // if have date, displays in descending order.
	}

	$result_select = request_database($connexion, $query);

	switch ($section) {
		case 'loisirs':
			while($row = mysqli_fetch_assoc($result_select))
			{
				echo "<div class='element'>";
					echo "<div class='value' id='value_".$section."_".$row["id"]."'>";
						echo "<h3>".$row["h3"]."</h3>";
						echo "<p>".$row["description"]."</p>";
						echo "<a href='javascript:void(0);' class='edit_button' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\"><img src='Images\\editer.png' /></a>";
						echo "<form action=\"MySQL/redirection.php\" method=\"post\">";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
                        echo "<button class='delete_button' name='submit' value='Delete' type='submit'>+</button>";
                    	echo "</form>";
					echo "</div>";
					echo "<div class='form_edit' id='form_".$section."_".$row["id"]."'>";
						echo "<form action='MySQL/redirection.php' method='post'>";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
						echo "<input type='text' id='titre_temp' name='titre' value='".$row["h3"]."' placeholder='Titre ..' required>";
						echo "<textarea id='descrition_temp' name='description' required>".$row["description"]."</textarea>";
			            echo "<input class='changeButton' type='submit' value='Changer' name='submit'>";
			            echo "</form>";
		            echo "<button class='cancelButton' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\">Annuler</button>";
					echo "</div>";
				echo "</div>";
			}
			break;
		
		case 'competences':
			while($row = mysqli_fetch_assoc($result_select))
			{
				echo "<div class='card_element'>";
					echo "<div class='value' id='value_".$section."_".$row["id"]."'>";
						echo "<h3>".$row["h3"]."</h3>";
						echo "<h4>".$row["h4"]."</h4>";
						echo "<p>".$row["description"]."</p>";
						echo "<a href='javascript:void(0);' class='edit_button' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\"><img src='Images\\editer.png' /></a>";
						echo "<form action=\"MySQL/redirection.php\" method=\"post\">";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
                        echo "<button class='delete_button' name='submit' value='Delete' type='submit'>+</button>";
                    	echo "</form>";
					echo "</div>";
					echo "<div class='form_edit' id='form_".$section."_".$row["id"]."'>";
						echo "<form action='MySQL/redirection.php' method='post'>";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
						echo "<input type='text' id='titre_temp' name='titre' value='".$row["h3"]."' placeholder='Titre ..' required>";
						echo "<div class='radio_temp'>";
						selectLevel($row["h4"], $row["id"]);
		                echo "</div>";
						echo "<textarea id='descrition_temp' name='description' required>".$row["description"]."</textarea>";
			            echo "<input class='changeButton' type='submit' value='Changer' name='submit'>";
			            echo "</form>";
		            	echo "<button class='cancelButton' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\">Annuler</button>";
					echo "</div>";
				echo "</div>";
			}
			break;

		case 'projets':
			while($row = mysqli_fetch_assoc($result_select))
			{
				echo "<div class='element'>";
					echo "<div class='value' id='value_".$section."_".$row["id"]."'>";
						echo "<h3>".$row["h3"]."</h3>";
						echo "<h4>".$row["h4"]."</h4>";
						echo "<p>".$row["description"]."</p>";
						echo "<a href='javascript:void(0);' class='edit_button' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\"><img src='Images\\editer.png' /></a>";
						echo "<form action=\"MySQL/redirection.php\" method=\"post\">";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
                        echo "<button class='delete_button' name='submit' value='Delete' type='submit'>+</button>";
                    	echo "</form>";
					echo "</div>";
					echo "<div class='form_edit' id='form_".$section."_".$row["id"]."'>";
						echo "<form action='MySQL/redirection.php' method='post'>";
						echo "<input type='number' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
						echo "<input type='text' id='titre_temp' name='titre' value='".$row["h3"]."' placeholder='Titre ..' required>";
						echo "<input type='text' id='lp_temp' name='programming_language' value='".$row["h4"]."' placeholder='Java, C++, Python ..' required>";
						echo "<textarea id='descrition_temp' name='description' required>".$row["description"]."</textarea>";
			            echo "<input class='changeButton' type='submit' value='Changer' name='submit'>";
			            echo "</form>";
		            echo "<button class='cancelButton' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\">Annuler</button>";
					echo "</div>";
				echo "</div>";
			}
			break;

		case 'experiences':
		case 'formations':
			while($row = mysqli_fetch_assoc($result_select))
			{
				echo "<div class='element'>";
					echo "<div class='value' id='value_".$section."_".$row["id"]."'>";
						echo "<h3>".changeDateFormat($row["date_from"])." - ".changeDateFormat($row["date_to"])."</h3>";
						echo "<h4>".$row["h4"]."</h4>";
						echo "<p>".$row["description"]."</p>";
						echo "<a href='javascript:void(0);' class='edit_button' onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\"><img src='Images\\editer.png' /></a>";
						echo "<form action=\"MySQL/redirection.php\" method=\"post\">";
						echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
						echo "<input type='hidden' name='section' value='".$section."' />";
                        echo "<button class='delete_button' name='submit' value='Delete' type='submit'>+</button>";
                    	echo "</form>";
					echo "</div>";
					echo "<div class='form_edit' id='form_".$section."_".$row["id"]."'>";
						echo "<form action='MySQL/redirection.php' method='post'>";
							echo "<input type='hidden' name='idValue' value='".$row["id"]."' />";
							echo "<input type='hidden' name='section' value='".$section."' />";
							echo "<input type='text' id='titre_temp' name='titre' value='".$row["h4"]."' placeholder='Titre ..' required>";
							echo "<input type='date' name='date_from' value='".$row["date_from"]."' required>";
				            echo "<input type='date' name='date_to' value='".$row["date_to"]."' required>";
							echo "<textarea id='descrition_temp' name='description' required>".$row["description"]."</textarea>";
				            echo "<input class='changeButton' type='submit' value='Changer' name='submit'>";
			            echo "</form>";
			            echo "<button class='cancelButton'onclick=\"editValue('value_".$section."_".$row["id"]."','form_".$section."_".$row["id"]."')\">Annuler</button>";
					echo "</div>";
				echo "</div>";
			}
			break;
	}
}

// Make look the date to french format.
function changeDateFormat($date)
{
	$arrayDate = explode("-", $date);
	return $arrayDate[2]."/".$arrayDate[1]."/".$arrayDate[0];
}

// Selects the appropriate option for the content.
function selectLevel($level, $id)
{
	switch($level)
	{
		case 'Débutant':
            echo "<input type='radio' id='beg_temp_".$id."' name='radio_comp' value='Débutant' checked>";
            echo "<label for='beg_temp_".$id."'>Débutant</label>";
            echo "<input type='radio' id='inter_temp_".$id."' name='radio_comp' value='Intermédiaire' >";
            echo "<label for='inter_temp_".$id."'>Intermédiaire</label>";
            echo "<input type='radio' id='adv_temp_".$id."' name='radio_comp' value='Avancé'>";
            echo "<label for='adv_temp_".$id."'>Avancé</label>";
            echo "<input type='radio' id='exp_temp_".$id."' name='radio_comp' value='Expert'>";
            echo "<label for='exp_temp_".$id."'>Expert</label>";
			break;
		case 'Intermédiaire':
		    echo "<input type='radio' id='beg_temp_".$id."' name='radio_comp' value='Débutant'>";
            echo "<label for='beg_temp_".$id."'>Débutant</label>";
            echo "<input type='radio' id='inter_temp_".$id."' name='radio_comp' value='Intermédiaire' checked>";
            echo "<label for='inter_temp_".$id."'>Intermédiaire</label>";
            echo "<input type='radio' id='adv_temp_".$id."' name='radio_comp' value='Avancé'>";
            echo "<label for='adv_temp_".$id."'>Avancé</label>";
            echo "<input type='radio' id='exp_temp_".$id."' name='radio_comp' value='Expert'>";
            echo "<label for='exp_temp_".$id."'>Expert</label>";
			break;
		case 'Avancé':
		    echo "<input type='radio' id='beg_temp_".$id."' name='radio_comp' value='Débutant'>";
            echo "<label for='beg_temp_".$id."'>Débutant</label>";
            echo "<input type='radio' id='inter_temp_".$id."' name='radio_comp' value='Intermédiaire'>";
            echo "<label for='inter_temp_".$id."'>Intermédiaire</label>";
            echo "<input type='radio' id='adv_temp_".$id."' name='radio_comp' value='Avancé' checked>";
            echo "<label for='adv_temp_".$id."'>Avancé</label>";
            echo "<input type='radio' id='exp_temp_".$id."' name='radio_comp' value='Expert'>";
            echo "<label for='exp_temp_".$id."'>Expert</label>";
			break;
		case 'Expert':
		    echo "<input type='radio' id='beg_temp_".$id."' name='radio_comp' value='Débutant'>";
            echo "<label for='beg_temp_".$id."'>Débutant</label>";
            echo "<input type='radio' id='inter_temp_".$id."' name='radio_comp' value='Intermédiaire'>";
            echo "<label for='inter_temp_".$id."'>Intermédiaire</label>";
            echo "<input type='radio' id='adv_temp_".$id."' name='radio_comp' value='Avancé'>";
            echo "<label for='adv_temp_".$id."'>Avancé</label>";
            echo "<input type='radio' id='exp_temp_".$id."' name='radio_comp' value='Expert' checked>";
            echo "<label for='exp_temp_".$id."'>Expert</label>";
			break;
	}
}

?>