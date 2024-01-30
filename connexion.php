<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=exo-connexion;charset=utf8;', 'root', '');
if (isset($_POST['send'])) {
    if (!empty($_POST['pseudo'] && !empty($_POST['mdp']))) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $mdp));
        // echo $recupUser;

        if ($recupUser->rowCount() > 0) {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            echo $_SESSION['id'];
            echo "<script type='text/javascript'>";
            echo "alert('Vous êtes connectés !');</script>";

        } else {
            echo "Votre mot de passe ou pseudo incorrect...";
        }

    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Veuillez completer tout les champs !');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

    <form action="" method="post" align="center">

        <input type="text" name="pseudo" id="pseudo" autocomplete="off">
        <br>
        <input type="password" name="mdp" id="mdp" autocomplete="off">
        <br><br>
        <input type="submit" value="Envoyer" name="send">

    </form>
    
</body>
</html>