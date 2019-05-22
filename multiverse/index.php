<?php require 'header.php';
$connect = mysqli_connect("localhost", "root", "", "multiverse");
?>
<body>
<h2 style="text-align: center;">SALE!</h2>
<div class="col-12 products3">
    <?php

    $total_records_per_page = 3;
    $result = mysqli_query($connect,"SELECT * FROM `vrbrillen` WHERE actie = 1 ");
    while($row = mysqli_fetch_array($result)){
        print '<div class="col-4 col-s-6 colzelf">';
        print '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';
        print $row['name'] . ' | €' . $row['price'];
        print '<br>';
        print '<a href="specification.php?id='.$row['id'].'">More info</a>';
        print '</div>';
    }
    mysqli_close($connect);
    ?>
    </div>
    <div class="col-12 infoindex">
            <h2>Wat is een vr bril</h2>
            <img class="vrbril" src="img/vrbril.png"/>
        <p>
            Een virtual reality-bril is een op het hoofd bevestigd apparaat dat virtuele realiteit biedt aan diegene die deze bril draagt.<br>
            VR-brillen worden veel gebruikt bij computerspellen, maar ze worden ook gebruikt in andere toepassingen, waaronder simulators en trainers.<br>
            Ze bestaan uit een stereoscopisch op het hoofd gemonteerd display (met afzonderlijke beelden voor elk oog),
            stereogeluid en sensoren voor het volgen van de hoofdbewegingen (waaronder gyroscopen, versnellingsmeters, gestructureerde lichtsystemen enz.).<br>
            Sommige VR-brillen hebben ook eye-tracking- sensoren en gamecontrollers.<br>
            bron: Wikipedia<br><br>
            Een virtual reality-bril is dus in feite een beeldscherm dat direct voor je ogen op het hoofd gedragen wordt.<br>
            Door de bril (of headset) wordt een virtuele werkelijkheid ervaren doordat er een 3D-computer gegenereerde omgeving wordt getoond.<br>
            Om een realistische gebruikerservaring te bieden, wordt het beeld geprojecteerd alsof het zich enkele meters verderop afspeelt.<br>
            Een Virtual Reality bril kan worden gebruikt voor het spelen van games en het bekijken van films, maar in toenemende mate zijn er ook andere toepassingen.<br>
    </div>
</body>