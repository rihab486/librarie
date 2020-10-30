


   <?php
session_start();
if (isset($_SESSION['nom']) AND isset($_SESSION['prenom']) AND isset($_SESSION['adresse']) AND isset($_SESSION['id']) ) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="compteClient.css">
  
    <title>compte client</title>
</head>

<body>
  <nav>
<form action="test1.php"class="nav" method="POST" >
<div id="navigation ">
        <a href="#" id="a">accueil</a>
        <a href="presentation.html"id="a">présentation</a>
        <a id="a">mon compte</a>
        <a href="profilClient.php" id="a">mon profil</a> 
        <a href="deconnClient.php" id="a">se déconnecter</a>
</div>
<form></br></br>
      <div class="ri">
        <input type="search" name="q" placeholder="Recherchez un titre">
        <input type="button" value="OK">
        </div>
    </nav></br></br>
                  
  <aside>  <h5><b>Bienvenue à votre compte</b> <?php echo $_SESSION['nom']; ?>.
  <b>Ici vous pouvez gérer l'ensemble de vos informations personnelles et les commandes.</b>

     <div class="to">
     <div id="ch"> 
       <a class="nav-link"href="chercherDocument.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>chercher un document</b></a></div>
       <div id="do">   <a class="nav-link"href="afficherTéléchargé.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>les documents téléchargés</b></a></div>
        <div id="de"> <a class="nav-link"href="deposerDoc.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>déposer un nouveau document</b></a></div>
        <div id="re"> <a class="nav-link"href="résultat.php" style="font-size: 20px;text-shadow:
        0 0 3px #FF0000, 0 0 5px #0000FF;" ><b>résultat du dernier document déposé</b></a></div>
        </div>

    </aside>
    <img src="compte.jpg" alt="logo" width="100%" height="40%" >
        <h6> LIBRAIRIE.TN</h6> 
 <?php
    }  
 else{ header("Location: acceClient.php");} ?>




    





  
     
      


   
     
   




    
    
    
   </div>
    </div>

  
    
  

  
    
  
    
  







       
       
        
    

       
     

                                                                    
                
</body>
</html>
