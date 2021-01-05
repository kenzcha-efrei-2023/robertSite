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
       <ul v-for="badge in badges">

       </ul>
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
      badges : [],

    }
  }
}
</script>