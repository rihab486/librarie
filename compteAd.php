
   <?php
session_start();
if (isset($_SESSION['nomAd']) AND isset($_SESSION['adresseAd']) AND isset($_SESSION['idAd']) ) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="compteClient.css">
    <title>compte Administrateur</title>
</head>

<body>
<nav>
<form action="test1.php"class="nav" method="POST" >
<div id="navigation ">
        <a href="#" id="a">accueil</a>
        <a href="presentation.html"id="a">présentation</a>
        <a id="a">mon compte</a>
        <a href="profil.php" id="a">mon profil</a> 
        <a href="deconnAd.php" id="a">se déconnecter</a>

        </div>
<form></br></br>
      <div class="ri">
        <input type="search" name="q" placeholder="Recherchez un titre">
        <input type="button" value="OK">
        </div>
    </nav></br></br>
                  
  <aside>  <h5><b>Bienvenue à votre compte</b> <?php echo $_SESSION['nom']; ?>.
  <b>Ici vous pouvez gérer l'ensemble de vos informations personnelles et les commandes.</b>

  
     <div id="ch"> 
       <a class="nav-link"href="controlerDocument.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>controler les documents déposés</b></a></div>
       <div id="do">   <a class="nav-link"href="deposerDocAd.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>déposer un nouveau document</b></a></div>
        <img src="compte.jpg" alt="logo" width="100%" height="40%" >
        <h6> LIBRAIRIE.TN</h6> 
             <?php
    }  
 else{ header("Location: acceAdministrateur.php");} ?>

  
        
</body>
</html>
