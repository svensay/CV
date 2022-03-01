<?php 
require_once("MySQL/mySQL.php");
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>CV</title>
    <link rel="stylesheet" href="CSS/mainStyle.css" />
    <link rel="stylesheet" href="CSS/headerStyle.css" />
    <link rel="stylesheet" href="CSS/addContentStyle.css" />
</head>
<body id="main">
    <?php $connexion = connect_database("127.0.0.1","root","","cv"); // Connect to the mySQL and the "cv" database ?>

     <!--HEADER-->
    <header class="header">
        <nav class="navbar" id="nav-bar">
            <img src="Images\CV_icon.png">
            <a href="#hobbies" class="nav-link">Loisirs</a>
            <a href="#projects" class="nav-link">Projets</a>
            <a href="#curriculum" class="nav-link">Formations</a>
            <a href="#experience" class="nav-link">Expériences</a>
            <a href="#skill" class="nav-link">Compétences</a>
            <a href="javascript:void(0);"
               class="nav-menu"
               onclick="responsiveTopBar()">
                ☰
            </a>
        </nav>
    </header>

     <!--ADD CONTENT PAGE-->
    <div class="overlay" id="ol" onclick="clickAddContent()"></div>
    <div class="add-content-page" id="acp">
        <form action="MySQL/redirection.php" method="post">
            <div class="form-row">
                <label for="section">Section</label>
                <select id="section" name="section" onchange="selectSectionChange(this)">
                    <option value="competences">Compétence</option>
                    <option value="experiences">Expérience</option>
                    <option value="formations">Formations</option>
                    <option value="projets">Projets</option>
                    <option value="loisirs">Loisirs</option>
                </select>
            </div>
            <div class="form-row">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" placeholder="Titre .." required>
            </div>
            <div class="form-row" id="radio">
                <label>Niveaux</label>

                <input type="radio" id="radioBeg" name="radio_comp" value="Débutant" checked required>
                <label for="radioBeg">Débutant</label>

                <input type="radio" id="radioInter" name="radio_comp" value="Intermédiaire">
                <label for="radioInter">Intermédiaire</label>

                <input type="radio" id="radioAdv" name="radio_comp" value="Avancé">
                <label for="radioAdv">Avancé</label>

                <input type="radio" id="radioExp" name="radio_comp" value="Expert">
                <label for="radioExp">Expert</label>
            </div>
            <div class="form-row" id="date">
                <label>Date</label>

                <label>de</label>
                <input type="date" name="date_from" required disabled>

                <label>à</label>
                <input type="date" name="date_to" required disabled>
            </div>
            <div class="form-row" id="programming_language">
                <label for="pl">Language de Programation</label>
                <input type="text" id="pl" name="programming_language" placeholder="Java, C++, Python .." required disabled>
            </div>
            <div class="form-row">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <input type="submit" id="addButton" name="submit" value="Ajouter">
        </form>
    </div>
    <button class="add-content-button"  
            id="acb" 
            type="button" 
            onclick="clickAddContent()">
        +
    </button>

    <!--MAIN-->
    <div class="all_content">
        <div class="content">
            <a class="anchor" id="skill"></a>
            <h1>Compétences</h1>
            <?php show_resuslt($connexion, "competences"); ?>
        </div>
        <div class="content">
            <a class="anchor" id="experience"></a>
            <h1>Expériences</h1>
            <?php show_resuslt($connexion, "experiences"); ?>
        </div>
        <div class="content">
            <a class="anchor" id="curriculum"></a>
            <h1>Formations</h1>
            <?php show_resuslt($connexion, "formations"); ?>
        </div>
        <div class="content">
            <a class="anchor" id="projects"></a>
            <h1>Projets</h1>
            <?php show_resuslt($connexion, "projets"); ?>
        </div>
        <div class="content">
            <a class="anchor" id="hobbies"></a>
            <h1>Loisirs</h1>
            <?php show_resuslt($connexion, "loisirs"); ?>
        </div>
    </div>

    <?php mysqli_close($connexion); // Close the connexion with mySQL ?>
    
    <!--script javascript-->
    <script src="common-function.js"></script>
</body>
</html>
