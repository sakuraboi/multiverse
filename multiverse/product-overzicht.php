<?php include 'header.php';

$cart_data = [];

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
            'item_quantity' => $_POST["quantity"],
        );
        $cart_data[] = $item_array;
    }
    $item_data = json_encode($cart_data);

    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:product-overzicht.php?success=1");
}

?>

<body>
<div class="row">

    <form action="search.php" method="POST">
        <input id="search" type="text" name="search" placeholder="Search">
        <button id="search" type="submit" name="submit-search"><i class="fa fa-search"></i></button>
    </form>

    <div class='main'>
        <?php

        $connect = mysqli_connect("localhost", "root", "", "multiverse");

        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
            $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
        }

        $total_records_per_page = 6;

        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $result_count = mysqli_query(
            $connect,
            "SELECT COUNT(*) As total_records FROM `vrbrillen`"
        );
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1


        $result = mysqli_query(
            $connect,
            "SELECT * FROM `vrbrillen` LIMIT $offset, $total_records_per_page"
        );
        while($row = mysqli_fetch_array($result)){ ?>
            <form method="post">
                <?php
                print '<div class="col-4 col-s-6 colzelf">';

                print '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';
                print $row['name'] . ' | €' . $row['price'];
                print '<br>';
                ?>
                <a href="specification.php?id=<?php echo $row['id'] ?>">More info</a>
                <?php
                 print '<input type="submit" name="add_to_cart" value="Add to cart">';
                 print '<input type="text" name="quantity" style="width: 50px;">';
                print '</div>'; ?>

                <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
            </form>
            <?php
        }
        mysqli_close($connect);
        ?>
        <div class='nav'>
            <ul class="pagination">
                <?php if($page_no > 1){
                    echo "<li><a href='?page_no=1'>Eerste pagina</a></li>";
                } ?>

                <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                    <a <?php if($page_no > 1){
                        echo "href='?page_no=$previous_page'";
                    } ?>>Vorige</a>
                </li>

                <li <?php if($page_no >= $total_no_of_pages){
                    echo "class='disabled'";
                } ?>>
                    <a <?php if($page_no < $total_no_of_pages) {
                        echo "href='?page_no=$next_page'";
                    } ?>>Volgende</a>
                </li>

                <?php if($page_no < $total_no_of_pages){
                    echo "<li><a href='?page_no=$total_no_of_pages'>Laatste &rsaquo;&rsaquo;</a></li>";
                } ?>
            </ul>
        </div>
    </div>
</div>
</body>


