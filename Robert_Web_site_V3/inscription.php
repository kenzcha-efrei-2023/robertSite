<?php

//on se connecte à la base de données
$servername = "localhost";
$username = "u757879057_djihane";
$password = "RobDji==!94";
$database = "u757879057_RobertDB";


$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    
    

if(isset($_POST['forminscription'])) {
   //on récupére les entrées de l'utilisateur dans le formulaire
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
   $mdp2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 20) {
          //on verifie que les deux mails correspondent
         if($mail == $mail2) {
             //on verifie si il existe deja ce mail dans la base de données (bd)
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $conn->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               //si il n'y a aucune occurence du mail dans la bd alors on verifie que les deux mdp correspondent
               if($mailexist == 0) {
                   //si oui, on enregistre les données entrées par l'utilisateur dans la base de données
                  if($_POST['mdp'] == $_POST['mdp2']) {
                     $insertmbr = $conn->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 20 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<html>

<head>
    <title>INSCRIPTION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Darker+Grotesque:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <link rel="stylesheet" href="https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css">
    <script src="https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js"></script>

    <style>
        input[type=text],
        [type=email],
        [type=password],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            text-align: center;
        }
        
        input[type=submit] {
            width: 100%;
            background-color: rgba(184, 140, 93, 0.7);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }
        
        input[type=submit]:hover {
            background-color: rgb(207, 177, 94);
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <!--------------- navbar starts here --------------->

        <nav class="nav" style="background-color: #161616 ">
            <span id="brand">
                <img src="Logo.png" width="80" height="80">
                <h1>Inscription</h1>
              </span>



        </nav>


        <!--------------- navbar ends here --------------->


        <!--------------- team section template --------------->

        <section class="team">

            <div class="container-fluid">

                <div align="center">
                    <br><br>
                    <form method="POST" action="">
                        <table>
                            <tr>
                                <td align="right">
                                    <label for="pseudo">Pseudo :</label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="mail">Mail :</label>
                                </td>
                                <td>
                                    <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="mail2">Confirmation du mail :</label>
                                </td>
                                <td>
                                    <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="mdp">Mot de passe :</label>
                                </td>
                                <td>
                                    <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="mdp2">Confirmation du mot de passe :</label>
                                </td>
                                <td>
                                    <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="center">
                                    <br />
                                    <input type="submit" name="forminscription" value="Je m'inscris" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                 if(isset($erreur)) {
                    echo '<font color="red">'.$erreur."</font>";
                 }
                 ?>
                </div>




            </div>

        </section>

        <!--------------- team section ends here --------------->





        <!--------------- footer starts here --------------->

        <div class="footer">

            <div class="container">


                <div class="info">

                    <div class="row">
                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s" id="address">
                            <p>EFREI Paris</p>
                            <h4>30-32 Avenue de la République</h4>
                            <h4>Villejuif</h4>
                            <h4>94800</h4>

                            <br><br>
                        </div>

                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s" id="media">
                            <ul>

                                <li>
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </li>

                            </ul>

                            <br><br>
                        </div>

                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s" id="mail">
                            <h4>contact@robertplant.fr</h4>

                            <br><br>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    </div>
    </div>
    <!--------------- footer ends here --------------->



</body>

</html>