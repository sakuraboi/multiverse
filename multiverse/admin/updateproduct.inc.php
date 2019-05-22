<?php
include 'header.php';

$conn = mysqli_connect("localhost", "root", "", "multiverse");
$id = $_REQUEST['id'];

$sql = "SELECT * FROM `vrbrillen` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);



?>

<?php
echo '<div id="update_product_div">';
echo '<form action="update_product_save.php" method="POST" enctype="multipart/form-data">';

    while($row = $result->fetch_assoc()) {
        echo
            'Naam: <input id="form" type="text" name="name"  value="' . $row["name"] . '"> <br>
            <br>Image/png: <input id="form" type="file" name="image"> <br>
            Platform: <input id="form" type="text" name="platform" value="' . $row["platform"] . '"> <br>
            Prijs: <input id="form" type="text" name="price" value="' . $row["price"] . '"> <br>
            Specificaties: <input id="form" type="text" name="specificaties" value="' . $row["specificaties"] . '"> <br>
            Resolutie: <input id="form" type="text" name="resolutie" value="' . $row["resolutie"] . '"> <br>
            Refresh rate: <input id="form" type="text" name="refresh" value="' . $row["refresh"] . '"> <br>
            Gezichtsveld: <input id="form" type="text" name="gezichtsveld" value="' . $row["gezichtsveld"] . '"> <br>
            Actie: <input id="form" type="boolean" name="actie" value="'. $row["actie"].'"> <br>
            <button id="form-submit" type="submit" name="verstuur">Update product</button>
            <input type="hidden" id="id" name="id" value="'.$row['id'].'">';

    }

echo '</form>';
echo '</div>';
?>