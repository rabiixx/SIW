<?php

    $colors = $_POST['Color'];
    print_r($colors);



    foreach ($colors as $color) {
        echo $color."\n".'<br>';
    }

    $day = $_POST['day'];
    echo $day;


    $channel_list = array(
        'ch1' => 'TheWillyrex',
        'ch2' => 'Discovery Max',
        'ch3' => 'Telecirco',
        'ch4' => 'Visual Pilitik',
        'ch5' => 'Tri-line',
        'ch6' => 'Hardware 360'
    );

    print_r($channel_list);

    $channels = $_POST['channel'];
    //print_r($channels);

    echo "<br>Colores elegidos: \n<br>";

    ?>

    <table border="1">
        <tr> <?php
            foreach ($channels as $ch) {
                echo "<td>".$channel_list[$ch] . "</td>";
            }?>
        </tr>
    </table>
