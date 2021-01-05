<template>
  <div class="container">
    	<nav>
      <ul>
        <li><router-link to="/etat">Etat</router-link></li>
         <li><router-link to="/conseil">Conseil</router-link></li>      
      </ul>
    </nav>
     <div class="container p-3 my-3 bg-dark text-white" id="badg">
        <h3>Hauts faits</h3>
        <!-- liste d'image qui sont les badges -->
       <div class="d-flex flex-row">
         <div v-for="badge in badges">
           <img :src=badges_paths[badge] width="130px" >
         </div>
       </div>
     </div>
    <div id="etat">
      <div id = "date">

      </div>
      <div id="eau">

      </div>
    </div>
  </div>
</template>


<script>
module.exports = {
  
  data () {
    return {
      badges_paths : ["../Assets/amateur.png","../Assets/ami_des_plantes.png","../Assets/apprenti.png","../Assets/compagnon_de_robert.png","../Assets/connaisseur.png","../Assets/fleuriste.png","../Assets/jardinier.png"],
      badges : [1,2,3],
    }
  }
}
</script>