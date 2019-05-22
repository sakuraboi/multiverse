<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 7-4-2019
 * Time: 21:15
 */

$conn = mysqli_connect("localhost", "root", "", "multiverse");



 if(isset($_POST["verstuur"]))  
 {  
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $name = $_POST['name'];
      $platform = $_POST['platform'];
      $price = $_POST['price'];
      $specification = $_POST['specificaties'];
      $resolution = $_POST['resolutie'];
      $refresh = $_POST['refresh'];
      $gezichtsveld = $_POST['gezichtsveld'];
      $actie = $_POST['actie'];
      $query = "INSERT INTO vrbrillen(name, image, platform, price, specificaties, resolutie, refresh, gezichtsveld, actie) VALUES ('$name', '$file', '$platform','$price', '$specificaties', '$resolution', '$refresh', '$gezichtsveld', '$actie');";  
      if(mysqli_query($connect, $query))  
      {  
           echo 'Data is in de database gezet';  
      }  
 }  
 ?>