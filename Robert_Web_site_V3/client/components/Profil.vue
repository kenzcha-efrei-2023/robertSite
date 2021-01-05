<template>
  <div>
	 <nav>
        <span id="brand">
                <img src="Logo.png" width="70" height="70">
                    <a href="index.html">Robert</a>
        </span>

    </nav>

  
		

  <!------------- ICI ON VEUT AFFICHER LE PSEUDO DE L'UTILISATEUR CONNECTE -------------->
			
				   <h2>Bienvenue {{pseudo}}</h2>
				  
		<nav>
      <ul>
        <li><router-link to="/etat">Etat</router-link></li>
         <li><router-link to="/conseil">Conseil</router-link></li>      
      </ul>
    </nav>
			  
    
  </div>
</template>

<script>


module.exports = {
 
  data () {
    return {
      pseudo : "nada",
      email : "rien"
    }

  },
  
  async mounted () {

   let temp = await axios.get('/api/me')
   this.pseudo = temp.data.pseudo
   this.email = temp.data.email
  },
  methods: {

  }


}
</script>


<style scoped>
nav {
    width: 100%;
    height: 80px;
    z-index: 2;
    background-color:  rgb(0, 0, 0);
}


nav #brand {
    float: left;
    display: block;
    margin-left: 40px;
    line-height: 80px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 18px;
}

nav #brand a {
    color: #fff;
    font-family: Poppins !important;
    transition: all 500ms ease-out;
}

nav #brand a:hover {
    text-decoration: none;
    color: #d3ae87;
}
</style>
