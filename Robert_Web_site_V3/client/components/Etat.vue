<template>
  <div class="pouet">

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
     <div class="p-5 bg-dark text-white" id="badg">
        <div class="container">
          <br>
          <br>
          <br>

          <h3>Hauts faits</h3>
          <br>
          <br>
          <p>Ici vous avez accès aux récompenses que vous avez débloquées !</p>

          <!-- liste d'image qui sont les badges -->
          <div class="mx-auto d-flex flex-row ">

            <div v-for="badge in badges">
              <img :src=badges_paths[badge] width="100%" >
            </div>
          </div>
          <br>
          <br>
        </div>

     </div>
    <div class=" p-5" id="etat" style="background-color: #d3ae87">
      <div class="container text-center text-white">
        <br>
        <br>
          <h3>Etat</h3>
        <br>
        <br>
        <p>Consultez le niveau d'eau en temps réel et l'état de Robert par jour !</p>
        <br>
        <br>
          <div class="row">
            <div class="col-sm">
              <div class="d-flex flex-column">

                <div>
                  <input type="date">
                </div>
                <div>
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Manger
                  </label>

                </div>
                <div>
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckpet">
                  <label class="form-check-label" for="flexCheckDefault">
                    Jouer
                  </label>
                </div>
                <div>
                  <button class="btn btn-success" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-sunglasses" viewBox="0 0 16 16">
                      <path d="M4.968 9.75a.5.5 0 1 0-.866.5A4.498 4.498 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.498 3.498 0 0 1 8 11.5a3.498 3.498 0 0 1-3.032-1.75zM7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A2.99 2.99 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.22 4.22 0 0 0 8 5c-.35 0-.69.04-1 .116z"/>
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0z"/>
                    </svg>
                  </button>
                  <button class="btn btn-outline-warning" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-neutral" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M4 10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm3-4C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5z"/>
                    </svg>
                  </button>
                  <button class="btn btn-outline-danger" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-dizzy" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M9.146 5.146a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708zm-5 0a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 1 1 .708.708l-.647.646.647.646a.5.5 0 1 1-.708.708L5.5 7.207l-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708zM10 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                    </svg>
                  </button>
                  <br>
                  <br><br>
                  <br>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div style="padding-bottom: 10%">
                Niveau d'eau
              </div>
              <div class="progress vertical-progressbar" style="width:150px;height:100px;">
                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        <br>
        <br><br>
        <br>
      </div>

    </div>
    <div class="footer">

      <div class="container">

        <div class="info">

          <div class="row">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s" id="address">
              <p>EFREI Paris</p>
              <h4>30-32 Avenue de la République</h4>
              <h4>Villejuif</h4>
              <h4>94800</h4>


            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s" id="media">
              <ul>

                <li>
                  <ion-icon name="logo-instagram"></ion-icon>
                </li>

              </ul>


            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s" id="mail">
              <h4>contact@robertplant.fr</h4>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</template>


<script>
module.exports = {
  
  data () {
    return {
      badges_paths : ["../Assets/bois.png","../Assets/amateur.png","../Assets/apprenti.png","../Assets/connaisseur.png","../Assets/fleuriste.png","../Assets/jardinier.png","../Assets/ami_des_plantes.png","../Assets/compagnon_de_robert.png"],
      badges : [1,2,3,4,5,6,7],
    }
  }
}
</script>

<style>
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
.vertical-progressbar{
  margin-left: auto;
  margin-right: auto;
}
.pouet{
  font-size: 20px;
}
</style>