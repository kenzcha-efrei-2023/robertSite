<template>

    <div>
    	<nav class="nav">

            <span id="brand">
                <img src="Logo.png" width="70" height="70">
                    <a href="index.html">Robert</a>
              </span>

        <ul class="oui">
            <li><router-link to="/etat">Etat</router-link></li>
            <li><router-link to="/conseil">Conseil</router-link></li>      
        </ul>
        </nav>

        <div id="hello">
            <h1>CONSEIL</h1>
            <p>N'hesitez plus grace à nos conseils ! Choisissez les plantes qui vous correspondent.</p>  
        </div>

        <div class="partie">

     <!--------------- Form starts here --------------->

            <form>

                <p>
                    <label for="Type">Type</label>
                    <select id="Type" v-model="search.Type" name="Type">
                        <option>Plante à fleurs</option>
                        <option>Plante comestible</option>
                    </select>
                </p>

                <p>
                    <label for="Entretien">Entretien</label>
                    <select id="Entretien" v-model="search.Entretien" name="Entretien">
                        <option>Facile</option>
                        <option>Modéré</option>
                        <option>Difficile</option>
                    </select>
                </p>

                <p>
                    <label for="Croissance">Croissance</label>
                    <select id="Croissance" v-model="search.Croissance" name="Croissance">
                        <option>Lente</option>
                        <option>Normale</option>
                        <option>Rapide</option>
                    </select>
                </p>

                        
                    <p>
                        <button type="submit" v-on:click="sendInfo(search,tab_plante,user_tab_plante)">Envoyer</button>
                    </p>
               

            </form>

    <!--------------- Form end here --------------->

 <!--------------- Table user starts here --------------->

       <div v-if="seen">
         <table class="table table-bordered">
            <thead class="thead-light">
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
            </thead>
            <tbody>
                <tr v-for="plant in user_tab_plante" :key="plant.id">
                <td>{{ plant.Nom }}</td>
                <td>{{ plant.Type }}</td>
                <td>{{ plant.Entretien }}</td>
                <td>{{ plant.Besoin_eau }}</td>
                <td>{{ plant.Croissance }}</td>
                <td>{{ plant.Type_sol }}</td>
                <td>{{ plant.Emplacement}}</td>
                <td>{{ plant.Plantation}}</td>
                </tr>  
            </tbody>     
            </table>

        </div>  
            
    <!--------------- Table user end here --------------->

      <!--------------- Table starts here --------------->

    <div v-if="!seen">

            <table class="table table-bordered">
            <thead class="thead-light">
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
            </thead>
            <tbody>
                <tr v-for="plant in tab_plante" :key="plant.id">
                <td>{{ plant.Nom }}</td>
                <td>{{ plant.Type }}</td>
                <td>{{ plant.Entretien }}</td>
                <td>{{ plant.Besoin_eau }}</td>
                <td>{{ plant.Croissance }}</td>
                <td>{{ plant.Type_sol }}</td>
                <td>{{ plant.Emplacement}}</td>
                <td>{{ plant.Plantation}}</td>
                </tr>  
            </tbody>     
            </table>

    </div> 
<!--------------- Table end here --------------->



        </div>

     
 

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

            <!--------------- footer ends here --------------->

    </div>
    
    
</template>


<script>
module.exports = { 
  
  data () {
    return {

       search: [{
                Type: "",
                Entretien: "",
                Croissance: "",
                }],
   
        seen: false,
       

        user_tab_plante: [{
        id: 0,
        Nom: "",
        Type: "",
        Entretien: "",
        Besoin_eau: "",
        Croissance: "",
        Type_sol: "",
        Emplacement: "",
        Plantation: ""
    }],

        tab_plante : [{
        
        id: 1,
        Nom: "Hubiscus",
        Type: "Plante à fleurs",
        Entretien: "Modéré",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Normale",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mars"
    }, {
        id: 2,
        Nom: "Rose du désert",
        Type: "Plante à fleurs",
        Entretien: "Modéré",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Lente",
        Type_sol: "Calcaire",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Février"
    }, {
        id: 3,
        Nom: "Camacia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Octobre"
    }, {
        id: 4,
        Nom: "Browallia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Mi-ombre : exposition durant une partie de la journée",
        Plantation: "Avril"
    }, {
        id: 5,
        Nom: "Anthurium",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Normale",
        Type_sol: "Terre de bruyère",
        Emplacement: "Mi-ombre : exposition durant une partie de la journée",
        Plantation: "Mars"
    }, {
        id: 6,
        Nom: "Spathiphyllum",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Terre de bruyère",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mars"
    }, {
        id: 7,
        Nom: "Arachide",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Calcaire",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mars"
    }, {
        id: 8,
        Nom: "Bégonia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Normale",
        Type_sol: "Terre de bruyère",
        Emplacement: "Ombre : pas d'exposition",
        Plantation: "Janvier"
    }, {
        id: 9,
        Nom: "Bignone rose",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mars"
    }, {
        id: 10,
        Nom: "Colchique d'automne",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Juillet"
    }, {
        id: 11,
        Nom: "Aglaonéma",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Lente",
        Type_sol: "Sableux",
        Emplacement: "Mi-ombre : exposition durant une partie de la journée",
        Plantation: "Mars"
    }, {
        id: 12,
        Nom: "Calcéolaire",
        Type: "Plante à fleurs",
        Entretien: "Modéré",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mai"
    }, {
        id: 13,
        Nom: "Cardamine",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Normale",
        Type_sol: "Terreau",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Février"
    }, {
        id: 14,
        Nom: "Crassula ovata",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Normale",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mai"
    }, {
        id: 15,
        Nom: "Cuphea",
        Type: "Plante à fleurs",
        Entretien: "Modéré",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Lente",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Avril"
    }, {
        id: 16,
        Nom: "Curcuma",
        Type: "Plante comestible",
        Entretien: "Modéré",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Février"
    }, {
        id: 17,
        Nom: "Dipladénia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Octobre"
    }, {
        id: 18,
        Nom: "Eucalyptus",
        Type: "Plante comestible",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux ",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Avril"
    }, {
        id: 19,
        Nom: "Dipladénia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Faible : une fois par mois",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Octobre"
    }, {
        id: 20,
        Nom: "Jacinthe",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Sableux",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Septembre"
    }, {
        id: 21,
        Nom: "Fuchsia",
        Type: "Plante à fleurs",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Terre de bruyère",
        Emplacement: "Mi-ombre : exposition durant une partie de la journée",
        Plantation: "Mai"
    }, {
        id: 22,
        Nom: "Gardénia",
        Type: "Plante à fleurs",
        Entretien: "Difficile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Terre de bruyère",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Mai"
    }, {
        id: 23,
        Nom: "Gingembre",
        Type: "Plante comestible",
        Entretien: "Modéré",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Normale",
        Type_sol: "Terreau",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Février"
    }, {
        id: 24,
        Nom: "Gloxinia",
        Type: "Plante à fleurs",
        Entretien: "Difficile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Terre de bruyère",
        Emplacement: "Mi-ombre : exposition durant une partie de la journée",
        Plantation: "Juin"
    }, {
        id: 25,
        Nom: "Medinilla",
        Type: "Plante à fleurs",
        Entretien: "Difficile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Normale",
        Type_sol: "Terre de bruyère",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Janvier"
    }, {
        id: 26,
        Nom: "Thym",
        Type: "Plante comestible",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux ",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Avril"
    }, {
        id: 27,
        Nom: "Ail",
        Type: "Plante comestible",
        Entretien: "Facile",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Terreau",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Octobre"
    }, {
        id: 28,
        Nom: "Thym",
        Type: "Plante comestible",
        Entretien: "Facile",
        Besoin_eau: "Important : plusieurs fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux ",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Avril"
    }, {
        id: 29,
        Nom: "Coriandre",
        Type: "Plante comestible",
        Entretien: "Modéré",
        Besoin_eau: "Modéré : une fois par semaine",
        Croissance: "Rapide",
        Type_sol: "Argileux ",
        Emplacement: "Soleil : exposition directe toute la journée",
        Plantation: "Avril"
    },

]
      
    }
  },

  methods: {

        sendInfo(search,tab_plante,user_tab_plante){

            const srh = this.search
            this.seen = true;
            this.tab_plante.forEach(function(element) {
            if (element.Type == srh.Type && element.Entretien == srh.Entretien && element.Croissance == srh.Croissance) {
                console.log(element)
                user_tab_plante.push(element);
            }

            console.log(user_tab_plante)
           
            
            });
        
        },

     

   
  }
}
</script>

<style scoped>

/*--------------- navigation --------------- */

.nav {
    width: 100%;
    height: 84px;
    position: fixed;
    z-index: 2;
    background-color: #161616;
}



.nav #brand {
    float: left;
    display: block;
    margin-left: 40px;
    line-height: 80px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 18px;
}

.nav #brand a {
    color: #fff;
    font-family: Poppins !important;
    transition: all 500ms ease-out;
}

.nav #brand a:hover {
    text-decoration: none;
}

.nav .oui {
    margin-left: 260px;
     background-color: #161616;
 
}

.nav .oui li {
    padding-left: 70px;
    display: inline-block;
    font-weight: lighter !important;
    text-transform: uppercase;
    font-size: 14px;
    line-height: 80px;
    position: relative;
    transition: all 500ms ease-out;
    
}

.nav .oui li a {
    font-family: Poppins !important;
    color: rgb(156, 156, 156);
    transition: all 500ms ease-out;
}

.nav .oui li a:hover {
    text-decoration: none;
    color: #fff;
    transition: all 500ms ease-out;
}

#hello{
    padding-top: 170px;
    margin-left:40px;
    margin-right:40px;

}
section {
    display: flex;
    flex-wrap: wrap;
}


button {
     background: none;
    border: .3pt solid rgba(184, 140, 93, 0.7);
    text-transform: uppercase !important;
    font-size: 12px !important;
    letter-spacing: 2px;
    padding: 18px 36px;
    text-transform: uppercase;
    
}

input {
    border: none;
}

button:hover {
    background-color: rgba(184, 140, 93, 0.7);
}


/*--------------- Form starts section here ---------------*/

form {
    border-color: #DAC16A;
    padding-top: 60px;
    padding-bottom: 50px;
    top: 0px;
    margin-right: auto;
    margin-left: auto;
}



form p{
    display: inline-flex;
    padding-left: 30px;
    margin-right: auto;
    margin-left: auto;
}

p label{
    padding-right: 10px;
}
/*--------------- Form end section here ---------------*/




/*--------------- table section starts here --------------- */
.partie{
    margin-left:40px;
    margin-right:40px;

}



/*--------------- table section end here --------------- */

/*--------------- footer section starts here --------------- */

.footer {
    background: #161616;
}

#media,
#address,
#mail {
    text-align: center !important;
}

.footer .container {
    padding: 160px 0;
}

.footer li,
p,
h4 {
    font-size: 24px !important;
}

.footer h4 {
    font-weight: lighter;
    color: #fff;
}

.footer p {
    color: grey;
    font-weight: lighter;
}

.footer li {
    font-weight: lighter;
    color: #fff;
    padding-left: 20px;
    font-size: 18px !important;
}

#media ul {
    list-style: none;
}

#media ul li {
    display: inline-block;
}

@media(max-width: 900px) {
    .footer .container {
        width: 92% !important;
    }
}

/*--------------- footer section end here --------------- */


</style>