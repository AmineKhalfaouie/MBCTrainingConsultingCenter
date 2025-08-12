<?php
//require connection
require('database/DBController.php');
//require Offer class
require('database/Offer.php');
//require Favorite class
require('database/Favorite.php');
//require Newsletter class
require('database/Newsletter.php');
//require User class
require('database/User.php');

//DBController object
$db = new DBController();
//Offer object
$offer = new Offer($db);
//Favorite object
$favorite = new Favorite($db);
//require newsletter class
$newsletter = new Newsletter($db);
//require user object
$userObj = new User($db);
?>