<?php

//Fonction pour se connecter a la base de données 
function connexion(){
    return new PDO('mysql:dbname=artbox;host=localhost','root','');
}