<?php
session_start();
//connexion à la base de données
$servername = "localhost";
$username = "id13252001_djihane";
$password = "c#@8lXXNtb5uCyJ/";
$database = "id13252001_greenhelper";

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

//on récupére l'id du membre
   
if(isset($_GET['id']) AND $_GET['id'] > 0) {
    
   $getid = intval($_GET['id']);
   $requser = $conn->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Mon compte</title>
      <meta charset="UTF-8" name="viewport" content="width=device-width">
      <link rel="stylesheet" type="text/css" href="style_user.css">
   </head>
   <body>
       
         <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
         <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="deconnexion.php" id="deco">Se déconnecter</a>
         <?php
         }
         ?>
    
         <img src="Logo.png" width="80" height="80" id="logo">
         
               
<div></div>

<section>
    <nav>
        <div id="menu">
            <div>
                <button type="submit" id="utilisateurs" onclick="showUsers();">Mes plantes</button>
            </div>
            <div>
                <button type="reset" id="taches" onclick="showPlants();">Plantes</button>
            </div>
        </div>

    </nav>
</section>

<form onsubmit="return false" id="form">
    <!----BOX---->
    <section class="form">
        <!----Type de plante---->
        <div class="inputs">
            <select name="user_type" id="type">
                    <option value="0" required>Type de plantes : Choisissez</option>
                    <option value="Plante à fleurs" required>Plante à fleurs</option>
                    <option value="Plante comestible" required>Plante comestible</option>
            </select>
        </div>
        <!----Entretien---->
        <div class="inputs">
            <select name="user_entretien" id="entretien">
                    <option value="0" required>Entretien : Choisissez</option>
                    <option value="Facile : pas de soins particuliers" required>Facile</option>
                    <option value="Modéré : soins réguliers" required>Modéré</option>
                    <option value="Difficile : soins importants et un savoir-faire spécifique" required>Difficile</option>
                </select>
        </div>

        <!----Croissance----->
        <div class="inputs">
            <select name="user_croissance" id="croissance">
                    <option value="0" required>Croissance : Choisissez</option>
                    <option value="Lente : maturité en plusieurs décénnies" required>Lente</option>
                    <option value="Normale : maturité en quelques années" required>Normale</option>
                    <option value="Rapide : maturité en quelques mois" required>Rapide</option>
                </select>
        </div>

    </section>

    <section>
        <div>
            <button type="submit" id="searchButton">Rechercher</button>
        </div>
        <div>
            <button type="reset" id="resetButton">Tout supprimer</button>
        </div>
    </section>



</form>



</header>
<br><br>
<main>
<p id="titre_user">Mes plantes</p>
<table class="tableau" id="userTable">
    <tr>
        <th>Nom</th>
        <th>Type</th>
        <th>Entretien</th>
        <th>Besoin en eau</th>
        <th>Croissance</th>
        <th>Type de sol</th>
        <th>Emplacement</th>
        <th>Plantation</th>
    </tr>
</table>


<p id="titre_tache">Plantes</p>
<table class="tableau" id="tacheTable">
    <tr>
        <th>Nom</th>
        <th>Type</th>
        <th>Entretien</th>
        <th>Besoin en eau</th>
        <th>Croissance</th>
        <th>Type de sol</th>
        <th>Emplacement</th>
        <th>Plantation</th>
    </tr>
</table>


</main>
<script>
var buttonSearch = document.querySelector("#searchButton");
var buttonReset = document.querySelector("#resetButton");
var buttonStateDisabled = true;
buttonSearch.textContent = "Rechercher"


buttonSearch.addEventListener('click', search);

buttonReset.addEventListener('click', deleteAll);

function deleteAll() {
    document.location.reload();
}

//Fonction qui affiche toutes les plantes de la base de donnée dans le deuxième tableau
function displayPlants() {

    myarray = [{
            "Nom": "Hubiscus",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Rose du désert",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Calcaire",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Camacia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Browallia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Anthurium",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Spathiphyllum",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Arachide",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Calcaire",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Bégonia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Ombre : pas d'exposition",
            "Plantation": "Janvier"
        }, {
            "Nom": "Bignone rose",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Colchique d'automne",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Juillet"
        }, {
            "Nom": "Aglaonéma",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Sableux",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Calcéolaire",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Cardamine",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Crassula ovata",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Cuphea",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Curcuma",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Dipladénia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Eucalyptus",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Dipladénia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Jacinthe",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Septembre"
        }, {
            "Nom": "Fuchsia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Gardénia",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Gingembre",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Gloxinia",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Juin"
        }, {
            "Nom": "Medinilla",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Janvier"
        }, {
            "Nom": "Thym",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Ail",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Thym",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Coriandre",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }


    ]

    var myarrayLength = myarray.length;
    console.log(myarrayLength)
    for (var i = 0; i < myarrayLength; i++) {
        var Nom = myarray[i]['Nom'];
        var Type = myarray[i]['Type'];
        var Entretien = myarray[i]['Entretien'];
        var Besoin = myarray[i]['Besoin en eau'];
        var Croissance = myarray[i]['Croissance'];
        var TypeSol = myarray[i]['Type de sol'];
        var Emplacement = myarray[i]['Emplacement'];
        var Plantation = myarray[i]['Plantation'];
        createPlant(Nom, Type, Entretien, Besoin, Croissance, TypeSol, Emplacement, Plantation);

    }



}






displayPlants();
var form = document.querySelector("#form");
var sticky = form.offsetTop;




let table = document.querySelector("tacheTable");

function generateTable(table, data) {
    for (let element of data) {
        let row = table.insertRow();
        for (key in element) {
            let cell = row.insertCell();
            let text = document.createTextNode(element[key]);
            cell.appendChild(text);
        }
    }
}


function createPlant(Nom, Type, Entretien, Besoin, Croissance, TypeSol, Emplacement, Plantation) {
    var task_table = document.getElementById("tacheTable");
    var newLine = document.createElement("tr");

    var newNom = document.createElement("td");
    newNom.appendChild(document.createTextNode(Nom));
    newLine.appendChild(newNom);

    var newType = document.createElement("td");
    newType.appendChild(document.createTextNode(Type));
    newLine.appendChild(newType)

    var newEntretien = document.createElement("td");
    newEntretien.appendChild(document.createTextNode(Entretien));
    newLine.appendChild(newEntretien)

    var newBesoin = document.createElement("td");
    newBesoin.appendChild(document.createTextNode(Besoin));
    newLine.appendChild(newBesoin);

    var newCroissance = document.createElement("td");
    newCroissance.appendChild(document.createTextNode(Croissance));
    newLine.appendChild(newCroissance);

    var newTypeSol = document.createElement("td");
    newTypeSol.appendChild(document.createTextNode(TypeSol));
    newLine.appendChild(newTypeSol)

    var newEmplacement = document.createElement("td");
    newEmplacement.appendChild(document.createTextNode(Emplacement));
    newLine.appendChild(newEmplacement)

    var newPlantation = document.createElement("td");
    newPlantation.appendChild(document.createTextNode(Plantation));
    newLine.appendChild(newPlantation);

    task_table.appendChild(newLine);
}

//Fonction qui affiche les plantes correspondantes aux recherches de l'utilisateur

function displayShearchPlant(Nom, Type, Entretien, Besoin, Croissance, TypeSol, Emplacement, Plantation) {
    var task_table = document.getElementById("userTable");
    var newLine = document.createElement("tr");

    var newNom = document.createElement("td");
    newNom.appendChild(document.createTextNode(Nom));
    newLine.appendChild(newNom);

    var newType = document.createElement("td");
    newType.appendChild(document.createTextNode(Type));
    newLine.appendChild(newType)

    var newEntretien = document.createElement("td");
    newEntretien.appendChild(document.createTextNode(Entretien));
    newLine.appendChild(newEntretien)

    var newBesoin = document.createElement("td");
    newBesoin.appendChild(document.createTextNode(Besoin));
    newLine.appendChild(newBesoin);

    var newCroissance = document.createElement("td");
    newCroissance.appendChild(document.createTextNode(Croissance));
    newLine.appendChild(newCroissance);

    var newTypeSol = document.createElement("td");
    newTypeSol.appendChild(document.createTextNode(TypeSol));
    newLine.appendChild(newTypeSol)

    var newEmplacement = document.createElement("td");
    newEmplacement.appendChild(document.createTextNode(Emplacement));
    newLine.appendChild(newEmplacement)

    var newPlantation = document.createElement("td");
    newPlantation.appendChild(document.createTextNode(Plantation));
    newLine.appendChild(newPlantation);

    task_table.appendChild(newLine);
}



/*VERIFICATION : Appel la fonction createTask()

createTask(myarray[1]['userId'], myarray[1]['id'], myarray[1]['title'], myarray[1]['completed']);

*/


function search() {

    myarray = [{
            "Nom": "Hubiscus",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Rose du désert",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Calcaire",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Camacia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Browallia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Anthurium",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Spathiphyllum",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Arachide",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Calcaire",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Bégonia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Ombre : pas d'exposition",
            "Plantation": "Janvier"
        }, {
            "Nom": "Bignone rose",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Colchique d'automne",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Juillet"
        }, {
            "Nom": "Aglaonéma",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Sableux",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mars"
        }, {
            "Nom": "Calcéolaire",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Cardamine",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Crassula ovata",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Cuphea",
            "Type": "Plante à fleurs",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Lente : maturité en plusieurs décénnies",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Curcuma",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Dipladénia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Eucalyptus",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Dipladénia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Faible : une fois par mois",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Jacinthe",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Sableux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Septembre"
        }, {
            "Nom": "Fuchsia",
            "Type": "Plante à fleurs",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Gardénia",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Mai"
        }, {
            "Nom": "Gingembre",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Février"
        }, {
            "Nom": "Gloxinia",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Mi-ombre : exposition durant une partie de la journée",
            "Plantation": "Juin"
        }, {
            "Nom": "Medinilla",
            "Type": "Plante à fleurs",
            "Entretien": "Difficile : soins importants et un savoir-faire spécifique",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Normale : maturité en quelques années",
            "Type de sol": "Terre de bruyère",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Janvier"
        }, {
            "Nom": "Ail",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Terreau",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Octobre"
        }, {
            "Nom": "Thym",
            "Type": "Plante comestible",
            "Entretien": "Facile : pas de soins particuliers",
            "Besoin en eau": "Important : plusieurs fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux ",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }, {
            "Nom": "Coriandre",
            "Type": "Plante comestible",
            "Entretien": "Modéré : soins réguliers",
            "Besoin en eau": "Modéré : une fois par semaine",
            "Croissance": "Rapide : maturité en quelques mois",
            "Type de sol": "Argileux",
            "Emplacement": "Soleil : exposition directe toute la journée",
            "Plantation": "Avril"
        }


    ]

    var b = 1;
    // On récupère la recherche de l'utilisateur 
    var TypeSearch = document.querySelector("#type").value;
    var EntretienSearch = document.querySelector("#entretien").value;
    var CroissanceSearch = document.querySelector("#croissance").value;
    console.log(TypeSearch);
    console.log(EntretienSearch);
    console.log(CroissanceSearch);
    //dddddddddddddddddddddddddddddddddddddddddddddddd
    var temp = 0;
    if (TypeSearch == 0 || EntretienSearch == 0 || CroissanceSearch == 0) {
        alert("Attention vous avez oublie d'indiquer le type de plante");
    } else if (TypeSearch != 0 && EntretienSearch != 0 && CroissanceSearch != 0) {
        var myarrayLength = myarray.length;
        console.log(myarrayLength);
        for (var i = 0; i < myarrayLength; i++) {
            var Nom = myarray[i]['Nom'];
            var Type = myarray[i]['Type'];
            var Entretien = myarray[i]['Entretien'];
            var Besoin = myarray[i]['Besoin en eau'];
            var Croissance = myarray[i]['Croissance'];
            var TypeSol = myarray[i]['Type de sol'];
            var Emplacement = myarray[i]['Emplacement'];
            var Plantation = myarray[i]['Plantation'];
            if (Type == TypeSearch && Entretien == EntretienSearch && Croissance == CroissanceSearch) {
                console.log(i);
                console.log("ici", myarray[i]['Nom']);
                displayShearchPlant(Nom, Type, Entretien, Besoin, Croissance, TypeSol, Emplacement, Plantation);
            } else {
                b = 0;
            }
        }
    } else if (b == 0) {
        alert("Desolé, il n'y a pas de plante qui correspond à votre recherche pour l'instant :(");
    }

}





function showUsers() {
    document.getElementById("tacheTable").style.display = 'none';
    document.getElementById("titre_tache").style.display = 'none';
    document.getElementById("userTable").style.display = 'table';
    document.getElementById("titre_user").style.display = 'table';
}

function showPlants() {
    document.getElementById("userTable").style.display = 'none';
    document.getElementById("titre_user").style.display = 'none';
    document.getElementById("tacheTable").style.display = 'table';
    document.getElementById("titre_tache").style.display = 'table';
}
</script>

   </body>
</html>
<?php   
}
?>