<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=exo-connexion;charset=utf8;', 'root', '');
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);
        $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp) VALUES (?, ?)');
        $insertUser->execute(array($pseudo, $mdp));

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?') ;
        $recupUser->execute(array($pseudo, $mdp));
        if($recupUser->rowCount() > 0){
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
        }

        echo $_SESSION['id'];

       ;

    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Veuillez completer tout les champs !');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

<form action="" method="POST" align="center" autocomplete="off" >
    <input type="text" name="pseudo" id=""  autocomplete="off">
    <br>
    <input type="password" name="mdp" id="">

    <br><br>

    <input type="submit" name="envoi">
</form>
    
</body>
</html>