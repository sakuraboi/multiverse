<?php require 'header.php'; ?>
<?php
$conn = mysqli_connect("localhost", "root", "", "multiverse");

$id = $_REQUEST['id'];

$sql = "SELECT * FROM `vrbrillen` WHERE id = $id;";
$result = $conn->query($sql);

$data = $result->fetch_assoc(); 



?>
<div class="col-6 col-s-12 colspecification">
	<?php
     print '<img src="data:image/jpeg;base64,'.base64_encode($data['image'] ).'"  class="img-thumnail" /></br>';
     print '</div>'; ?>
</div>
<form class="col-6 col-s-12 productinfo">
	<h1><?php echo $data['name']?></h1>
    <h3>€ <?php echo $data['price']?></h3>
    <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">

	<h2>Info</h2>
	<p>Platform: <?php echo $data['platform']?></p>
    <p><?php echo $data['specificaties']?></p>
    <p><?php echo $data['refresh']?></p>
    <p><?php echo $data['gezichtsveld']?></p>
    <p><?php echo $data['resolutie']?></p>
</form>

