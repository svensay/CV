<?php 
require_once("mySQL.php");

function form_redirection()
{
	$connexion = connect_database("127.0.0.1","root","","cv");
	$query = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
	{
		switch ( $_POST['submit'] )
		{
			case 'Ajouter' :
				if(checkEmpty($_POST['section']))
				{
					switch ($_POST['section']) {
						case 'competences':
								$query = "INSERT INTO ".$_POST['section']." (h3 , h4, description) VALUES (\"".changeQuoteMark($_POST['titre'])."\", \"".changeQuoteMark($_POST['radio_comp'])."\", \"".changeQuoteMark($_POST['description'])."\")";
							break;

						case 'projets':
							$query = "INSERT INTO ".$_POST['section']." (h3 , h4, description) VALUES (\"".changeQuoteMark($_POST['titre'])."\", \"".changeQuoteMark($_POST['programming_language'])."\", \"".changeQuoteMark($_POST['description'])."\")";
							break;
						
						case 'experiences':
						case 'formations':
							$query = "INSERT INTO ".$_POST['section']." (date_from , date_to, h4, description) VALUES (\"".$_POST['date_from']."\", \"".$_POST['date_to']."\", \"".changeQuoteMark($_POST['titre'])."\", \"".changeQuoteMark($_POST['description'])."\")";
							break;

						case 'loisirs':
							$query = "INSERT INTO ".$_POST['section']." (h3, description) VALUES (\"".changeQuoteMark($_POST['titre'])."\", \"".changeQuoteMark($_POST['description'])."\")";
							break;
					}
				}
				break;

			case 'Changer' :
				if(checkEmpty($_POST['section']))
				{
					switch ($_POST['section']) {
						case 'competences':
							$query = "UPDATE ".$_POST['section']." SET h3 = \"".changeQuoteMark($_POST['titre'])."\", h4 = \"".changeQuoteMark($_POST['radio_comp'])."\", description = \"".changeQuoteMark($_POST['description'])."\" WHERE id=".$_POST['idValue'];
							break;

						case 'projets':
							$query = "UPDATE ".$_POST['section']." SET h3 = \"".changeQuoteMark($_POST['titre'])."\", h4 = \"".changeQuoteMark($_POST['programming_language'])."\", description = \"".changeQuoteMark($_POST['description'])."\" WHERE id=".$_POST['idValue'];
							break;
						
						case 'experiences':
						case 'formations':
							$query = "UPDATE ".$_POST['section']." SET date_from = \"".$_POST['date_from']."\", date_to = \"".$_POST['date_to']."\", h4 = \"".changeQuoteMark($_POST['titre'])."\", description = \"".changeQuoteMark($_POST['description'])."\" WHERE id=".$_POST['idValue'];
							break;

						case 'loisirs':
							$query = "UPDATE ".$_POST['section']." SET h3 = \"".changeQuoteMark($_POST['titre'])."\", description = \"".changeQuoteMark($_POST['description'])."\" WHERE id=".$_POST['idValue'];
							break;
					}
				}
				break;

			case 'Delete':
				$query = "DELETE FROM ".$_POST['section']." WHERE id=".$_POST['idValue'];
				break;
		}
	}

	if(!empty($query))
		request_database($connexion, $query);

	mysqli_close($connexion);
	header("Location: ../CV.php");
}

// check if all POST slot have content.
function checkEmpty($section)
{
	switch ($section) {
		case 'competences':
			return !(empty($_POST['titre']) || empty($_POST['radio_comp']) || empty($_POST['description']));

		case 'projets':
			return !(empty($_POST['titre']) || empty($_POST['programming_language']) || empty($_POST['description']));
		
		case 'experiences':
		case 'formations':
			return !(empty($_POST['date_from']) || empty($_POST['date_to']) || empty($_POST['titre']) || empty($_POST['description']));

		case 'loisirs':
			return !(empty($_POST['titre']) || empty($_POST['description']));
	}
}

// Change the '"' to '\"' in string to avoid error.
function changeQuoteMark($string)
{
	str_replace('"', '\"', $string);
	return $string;
}

form_redirection();
?>