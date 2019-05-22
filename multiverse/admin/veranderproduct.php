<?php
include 'header.php';
$connect = mysqli_connect("localhost", "root", "", "multiverse");

$result = mysqli_query($connect,"SELECT * FROM `vrbrillen`");
while($row = mysqli_fetch_array($result)){
            	print '<div class="col-4 col-s-6 colzelf">';
            	print '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';
            	print $row['name'] . ' | €' . $row['price'];
            	print '<br>';
            	print '<a href="updateproduct.inc.php?id='.$row['id'].'">update</a>';
            print '</div>';
        }
?>