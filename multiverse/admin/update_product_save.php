<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 7-4-2019
 * Time: 21:21
 */

$id = $_REQUEST['id'];

if(isset($_POST['verstuur'])){
$conn = mysqli_connect("localhost", "root", "", "multiverse");


$name = $_POST['name'];
$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
$platform = $_POST['platform'];
$price = $_POST['price'];
$specification = $_POST['specificaties'];
$resolution = $_POST['resolutie'];
$refresh = $_POST['refresh'];
$gezichtsveld = $_POST['gezichtsveld'];
$actie = $_POST['actie'];

$sql = "UPDATE `vrbrillen` 
        SET `name`='".$name."',
        `image`='".$file."',
            `platform`='".$platform."',
            `price`='".$price."',
            `specificaties`='".$specification."',
            `resolutie`='".$resolution."',
            `refresh`='".$refresh."',
            `gezichtsveld`='".$gezichtsveld."',
            `actie`='".$actie."'
        WHERE `id` ='".$id."'";



if ($conn->query($sql) === TRUE) {
    echo "Updated record successfully";
    echo "<br>";
    echo "<a href='admin.php'>terug</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
