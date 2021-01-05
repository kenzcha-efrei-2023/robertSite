<?php
session_start();

//on se connecte à la base de données
$servername = "localhost";
$username = "u757879057_djihane";
$password = "RobDji==!94";
$database = "u757879057_RobertDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    } catch(PDOException $e) {    
    echo "Connection failed: " . $e->getMessage();
    }
    
 
if(isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = $_POST['mdpconnect'];
   
    if(!empty($mailconnect) AND !empty($mdpconnect)) {

        //on verifie si le mail existe dans la base données
          
        $requser = $conn->prepare("SELECT * FROM membres WHERE mail = ?");
      
        $requser->execute(array($mailconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)  {

            //on vérifie que le $mdpconnect correspond bien au mot de passe crypté contenu dans base de données
            //($hashmdp (hasher grace à password_hash () dans insciption.php) 
            $userinfo = $requser->fetch();

            $hashmdp = $userinfo['motdepasse'];
             
            if (password_verify($mdpconnect, $hashmdp) == 1) {

                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['mail'] = $userinfo['mail'];
                 header("Location: profil.php?id=".$_SESSION['id']);
            }
               else {
          $erreur = "Mauvais mot de passe !";
       }
        }

    
       else {
          $erreur = "Mauvais mail !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }
?>
<html>
<head>
    <title>CONNEXION</title>
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
                <h1>Connexion</h1>
              </span>



        </nav>


        <!--------------- navbar ends here --------------->


        <!--------------- team section template --------------->

        <section class="team">
            <br><br><br>
            <div class="container-fluid" align="center">
                 <form action="" method="POST">
                <table>

                    <tr>
                        <td align="right">
                            <label for="mail">Mail :</label>
                        </td>
                        <td>
                            <input type="email" name="mailconnect" placeholder="Mail"  value="" />
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="mdp">Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td align="center">
                            <br />
                            
                                <input type="submit"  name="formconnexion" value="Se connecter"/>
                           
                           
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