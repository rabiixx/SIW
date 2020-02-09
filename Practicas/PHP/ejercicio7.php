<?php

    /* Texto plano HTML */
    // header('Content-type: text/plain');

    /* Genereamos dos arrays de 20 numeros */
    $arr1 = range(1, 20);
    $arr2 = range(21, 40);

    /* Se mezclan los elementos del array */
    shuffle($arr1);
    shuffle($arr1);

    $lista = array(
      range(0, 19)
    );

    ?>
    <span>Array 1:</span>

    <?php
    for ($i=0; $i < sizeof($arr1); $i++) {
        echo $arr1[$i]."\t";
    }
    ?>
    <br>

    <span>Array 2:</span>
    <?php

    for ($i=0; $i < sizeof($arr1); $i++) {
        echo $arr2[$i]."\t";
    } ?>
    <br>

    <?php
    for ($i=0; $i < sizeof($lista[0]); $i++) {
        $lista[1][$i] = $arr1[$i] + $arr2[$i];
    }



    for ($i=0; $i < sizeof($lista[0]); $i++) { ?>
        <table border="1" bgcolor="blue">
            <tr>
                <td><?php echo $lista[0][$i]; ?></td>
                <td><?php echo $lista[1][$i]; ?></td>
            </tr>
        </table>

    <?php } ?>
