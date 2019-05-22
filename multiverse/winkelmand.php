<?php
include 'header.php';
if (isset($_GET["action"])) {
	if (isset($_GET) == "delete") {
		$cookie_data = stripslashes($_COOKIE["shopping_cart"]);

		$cart_data = json_decode($cookie_data, true);

		foreach ($cart_data as $keys => $values) {
			if ($cart_data[$keys]['item_id'] == $_GET["id"]) {
				unset($cart_data[$keys]);
				$item_data = json_encode($cart_data);

				setcookie('shopping_cart', $item_data, time() + (86400 * 30));
				header("location:winkelmand.php?remove=1");
			}
		}
	}
}

if (isset($_POST['add_to_cart'])) {
    if (isset($_COOKIE["shopping_cart"])) {
        $total = 0;
        $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
        $cart_data = json_decode($cookie_data, true);

    } else {
        echo 'Geen producten in winkelwagen';
    }

    $item_id_list = array_column($cart_data, 'item_id');

    if (in_array($_POST['hidden_id'], $item_id_list)) {
        foreach ($cart_data as $keys => $values) {
            if ($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
            }
        }
    } else {
        $item_array = array(
            'item_id' => $_POST["hidden_id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["hidden_quantity"],
        );
        $cart_data[] = $item_array;
    }
    $item_data = json_encode($cart_data);

    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:specification.php?id=$id&success=");
}

if (isset($_GET["success"])) {
	$message = 'Toegevoegd aan winkelwagen';
}

if (isset($_GET["remove"])) {
	$message = 'product verwijdert uit winkelwagen';
}


?>
<table align="center">
	<tr>
		<th>Naam</th>
		<th>Aantal</th>
		<th>Prijs</th>
		<th>Totaal</th>
		<th>Delete</th>
	</tr>
	<?php

	$total = '';
	?>
	<?php
	if (isset($_COOKIE["shopping_cart"])) {
		$total = 0;
		$cookie_data = stripslashes($_COOKIE["shopping_cart"]);
		$cart_data = json_decode($cookie_data, true);
	
		foreach ($cart_data as $keys => $values) {
			?>
			<tr>
				<td><?php echo $values["item_name"]; ?></td>
				<td><?php echo $values["item_quantity"]; ?></td>
				<td><?php echo $values["item_price"]; ?></td>
				<td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
				<td><a href="winkelmand.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
					class="text-danger">Remove</span></a></td>
				</tr>
				<?php
				$total = $total + ($values["item_quantity"] * $values["item_price"]);

			}
		} else {
			$cart_data = array();
		} ?>
	</table>
	<p style="text-align: center;">Totaal: € <?php echo number_format($total, 2); ?></p>
