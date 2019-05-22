<?php
include 'header.php';
$conn = mysqli_connect("localhost", "root", "", "multiverse"); ?>

<div id="new_product_div">
<form method="POST" enctype="multipart/form-data">
    Naam: <input id="form" type="text" name="name" required> <br>
    <br>Image/png: <input id="form" type="file" name="image" id='image'> <br><br>
    Platform: <input id="form" type="text" name="platform" required> <br>
    Prijs: <input id="form" type="text" name="price" required> <br>
    Specificaties: <input id="form" type="text" name="specificaties" required> <br>
    Resolutie: <input id="form" type="text" name="resolutie" required> <br>
    Refresh rate: <input id="form" type="text" name="refresh" required> <br>
    gezichtsveld: <input id="form" type="text" name="gezichtsveld" required> <br>
    Actie: <input id="form" type="select" name="actie"> *0 = normaal, *1 = actie <br>
    <button id="form-submit" type="submit" name="insert">Maak nieuw product</button>
</form>
</div>
<?php

if(isset($_POST["insert"]))
{
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $name = $_POST['name'];
    $platform = $_POST['platform'];
    $price = $_POST['price'];
    $specification = $_POST['specificaties'];
    $refresh = $_POST['refresh'];
    $gezichtsveld = $_POST['gezichtsveld'];
    $actie = $_POST['actie'];

   $query = "INSERT INTO vrbrillen(name, image, platform, price, specificaties, resolutie, refresh, gezichtsveld, actie) VALUES ('$name', '$file', '$platform','$price', '$specification', '$resolution', '$refresh', '$gezichtsveld', '$actie');";  
    if(mysqli_query($conn, $query))
    {
        echo 'Data is in de database gezet';
    }
}
 ?>