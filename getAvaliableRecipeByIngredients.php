<?php

require 'recipe.class.php';

if (isset($_POST['sum']) && !empty($_POST['sum'])) {
    $get_ingredents_value = $_POST['sum'];
} else {
    //$get_ingredents_value = 0b100110001001;
    //$get_ingredents_value = 0b111111111111;
    $get_ingredents_value = 0b000000000000;
}

$output = array();

foreach ($recipe_class as $key => $recipe_info) {
    if (false) {
        echo $recipe_info->name."\n";
        echo (int) base_convert($recipe_info->value, 10, 2)."\n";
        echo (int) base_convert($get_ingredents_value, 10, 2)."\n";
        echo (int) base_convert($recipe_info->value & $get_ingredents_value, 10, 2)."\n";
        echo "\n";
    }

    if (($recipe_info->value & $get_ingredents_value) == $recipe_info->value) {
        $output[] = $recipe_info;
    }
}

$result = array();

foreach ($output as $key => $recipe_avaliable) {
    $result[] = get_object_vars($recipe_avaliable);
}

$rst = array('result' => $result);

if (isset($_POST['table']) && !empty($_POST['table']) && $_POST['table'] == 1) {
    require 'ajax_table.php';
} else {
    $msg = json_encode($rst);
    echo $msg;
}
