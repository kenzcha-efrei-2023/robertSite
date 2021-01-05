<template>
  <div>
    <nav>
        <span id="brand">
                <img src="Logo.png" width="70" height="70">
                    <a href="index.html">Robert</a>
              </span>
    </nav>


     <div align="center">
        
                    <br><br>
                    <form @submit.prevent="createUser()">
                       
                        <table>
                             <h1>Inscription</h1>
                                 <br>

                            <!-------------- PSEUDO -------------->
                            <tr>
                                <td align="right">
                                    <label for="pseudo">Pseudo :</label>
                                </td>
                                <td>
                                   <input v-model="pseudo" placeholder="votre pseudo">
                                </td>
                            </tr>

                             <!-------------- MAIL -------------->
                            <tr>
                                <td align="right">
                                    <label for="mail">Mail :</label>
                                </td>
                                    
                                <td>
                                   <input v-model="email" placeholder="email">
                                </td>
                            </tr>
                           
                            <!-------------- MDP -------------->
                            <tr>
                                <td align="right">
                                    <label for="mdp">Mot de passe :</label>
                                </td>
                                <td>
                                    <input type="password" v-model="password" placeholder="mot de passe">
                                </td>
                            </tr>
                           

                            <tr>
                                <td></td>
                                <td align="center">
                                    <br>
                                     <button type="submit">Je m'inscris</button>
                                   
                                </td>
                            </tr>
                        </table>
                    </form>
        </div>
  </div>
</template>

<script>
module.exports = {
  props: {
    profil: { type: Object }
  },
  data () {
    return {
      pseudo: '',
      email: '',
      password: ''
    }
  },
  async mounted () {
  },
  methods: {
    async createUser() {
      await axios.post('/api/register', {
        pseudo: this.pseudo,
        email: this.email,
        password: this.password
      })
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>

/* --------------------- Nav style --------------------- */

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


/* --------------------- Form style --------------------- */

form input{
   width: 100%;
   padding: 12px 20px;
   margin: 8px 0;
   display: inline-block;
   border: 1px solid #ccc;
   border-radius: 4px;
   box-sizing: border-box;
   text-align: center;

}

button{
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


button:hover{
 background-color:  rgba(184, 140, 93, 0.7);
 font-weight: bold;
 color:black;
}
</style>


