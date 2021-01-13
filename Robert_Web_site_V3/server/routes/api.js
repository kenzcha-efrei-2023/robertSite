const express = require('express')
const router = express.Router()
const bcrypt = require('bcrypt')
const { Client } = require('pg')

const client = new Client({
    user: 'pi',
    host: 'localhost',
    password: 'projetTransverse2020',
    database: 'robert'
})

client.connect()

const users = []

class Profil {
    constructor() {
        this.createdAt = new Date()
    }
}


router.use((req, res, next) => {
    // l'utilisateur n'est pas reconnu, lui attribuer un nv profil dans req.session
    if (typeof req.session.userId === 'undefined') {
        req.session.userId = -1;
    }
    next()
})

router.post('/login', async(req, res) => {

    const email = req.body.email
    const password = req.body.password
    console.log(email)
    console.log(password)
    const result = await client.query({
        text: 'SELECT * FROM users WHERE email=$1',
        values: [email]
    })

    if (result.rows.length === 0) {
        res.status(401).send({ message: "Cet utilisateur n'existe pas !" })
        return
    }
    // si on a pas trouvé l'utilisateur
    // alors on le crée
    const user = result.rows[0]

    if (await bcrypt.compare(password, user.pswd)) {
        // alors connecter l'utilisateur
        req.session.userId = user.id
        res.json({
            id: user.id,
            email: user.email
        })
        return
    } else {
        res.status(401).send({
            message: "Mauvais mot de passe !"
        })
        return
    }

    //si l'utilisateur est authentifier il a accès à la verification de ses réponses
    req.session.profil = new Profil()
})

router.post('/etat', async (req, res) =>{
    const input =
    {
        date : req.body.date
    }
    let info = await client.query({
        text: `SELECT * FROM logjour WHERE dat = $1`,
        values: [input.date]
    })
    res.json(info.rows)
})


router.post('/register', async(req, res) => {
    const pseudo = req.body.pseudo
    const email = req.body.email
    const password = req.body.password



    //CREATE TABLE users (
    //			id SERIAL,
    //          pseudo TEXT,
    //			email TEXT,
    //			password TEXT,
    //			PRIMARY KEY (id));

    // vérifier si la table existe !!
    const liste_tables = await client.query({
        text: 'SELECT tablename FROM pg_tables WHERE tablename NOT LIKE \'pg_%\' '

    })
    console.log("liste des tables :")
    console.log(liste_tables.rows)
        // si undefined => la table users n'existe pas !!
    const res_table = liste_tables.rows.find(a => a.tablename === "users")
    console.log(res_table)
    if (typeof res_table === 'undefined') {
        console.log("Création de la table car elle n'existe pas !!")
            // creation de la table
        const liste_tables = await client.query({
            text: 'CREATE TABLE users (id SERIAL, pseudo TEXT, email TEXT, pswd TEXT, PRIMARY KEY (id))'
        })


    } else {
        console.log("La table existe => controler si il existe le nouvelle email ?")

        // comme la table users existe,
        // vérifier que le nouveau utilisateur est n'existe pas dans la table users
        const result = await client.query({
            text: 'SELECT * FROM users WHERE email=$1',
            values: [email]
        })

        if (result.rows.length > 0) {
            res.status(401).json({
                message: 'user already exists'
            })
            return
        }

    }

    // si on a pas trouvé l'utilisateur ou que l'on a créé la table
    // alors ajoute notre nouveau utilisateur

    const hash = await bcrypt.hash(password, 10)

    await client.query({
        text: `INSERT INTO users(pseudo, email, pswd) VALUES ($1, $2, $3)`,
        values: [pseudo, email, hash]
    })
    res.send('ok')

})

// ICI ON ACCEDE A LA SESSION DE L'UTILISATEUR CONNECTE (On veut récup son pseudo stocké dans la table user dans un premier temps et l'afficher sur la page Profil.vue)

router.get('/profil', async(req, res) => {
    console.log(req.session.userId)
    if (req.session.userId === -1) {
        res.status(401).send({ message: 'Vous ne pouvez pas accéder à votre profil car vous n\'êtes pas connecté' })
        return
    }


    console.log("on est dans get profil !!")

    res.json(req.session.userId)
})


router.get('/me', async(req, res) => {

    let info = await client.query({
        text: `SELECT * FROM users WHERE id = $1`,
        values: [req.session.userId]
    })
    if (info.rows.length === 0) {
        res.json(null)
        return
    }

    res.json({ pseudo: info.rows[0].pseudo, email: info.rows[0].email })
})

module.exports = router