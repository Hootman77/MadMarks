<?php

//Allowing access from websevers to application
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST");


  //Including the information from the DBconnect file
    include "DbConnect.php";

    //Calling the DBConnect class and creating a connection to the Database
    $objDb = new DbConnect;
    $conn = $objDb->connect();

    //Getting the content that was sent to the php
    $eData = file_get_contents("php://input");
    //decode the data from json format
    $dData = json_decode($eData, true);
    //creating a variable called name with the data from the input
    $name = $dData['NAME'];
    //creating a new variable and adding SQL like to
    $name = "%".$name."%";
   
    
     //Creating a method variable and getting the information in an array and getting the request method to access the page
     $method = $_SERVER["REQUEST_METHOD"];
     //Calling the switch statement which is a collection of if statements depending on the method called
     switch($method) {
       //If the method is GET then this will be carried out  
         case "POST":
             //Setting a sql variable to an SQL statement
             $sql = "SELECT NAME, Platform, Main_Char, Rating FROM info_main WHERE NAME LIKE :term OR Platform LIKE :term2 OR Main_Char LIKE :term3 OR Rating LIKE :term4 AND Stock >= 1";
             
             //Storing the sql statement using the prepare function
             $stmt = $conn->prepare($sql);
             //Binding the paramters so that the data is hidden until executed on the page
             $stmt->bindParam(":term", $name, PDO::PARAM_STR);
             $stmt->bindParam(":term2", $name, PDO::PARAM_STR);
             $stmt->bindParam(":term3", $name, PDO::PARAM_STR);
             $stmt->bindParam(":term4", $name, PDO::PARAM_STR);
             //Executing the SQL statement
             $stmt->execute();
             //Fetching all the results from the SQL query
             $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
             //Encoding the data into json format
             echo json_encode($users);
             //breaking the switch statement
             break;
         }