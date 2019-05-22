<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 7-4-2019
 * Time: 20:19
 */
include 'header.php';
$connect = mysqli_connect("localhost", "root", "", "multiverse");
?>

<h1>Zoek Resultaten:</h1>
<a href="index.php">Homepage</a>
<a href="product-overzicht.php">Catalogus</a>


<div>
    <?php
        if (isset($_POST['submit-search'])){
            $search = mysqli_real_escape_string($connect, $_POST['search']);
            $sql = "SELECT * FROM vrbrillen WHERE name LIKE '%$search%'";
            $result = mysqli_query($connect, $sql);
            $queryResult = mysqli_num_rows($result);

            if ($queryResult > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    print '<div class="col-4 col-s-6 colzelf">';
                    print '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';
                    print $row['name'] . ' | €' . $row['price'];
                    print '<br>';
                    ?>
                    <a href="specification.php?id=<?php echo $row['id'] ?>">More info</a>
                    <?php
                    print '</div>';

                }
            } else {
                echo "Geen resultaat";
            }
        }
    ?>
</div>
