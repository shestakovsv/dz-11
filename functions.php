<?php

//function sql_UPDATE($bd, $id, $post_date) {
//    $bd->query('UPDATE form SET ?a WHERE id =?', $post_date, $id);
//    if (empty($post_date["allow_mails"])) {
//        $value = '';
//        $bd->query('UPDATE form SET allow_mails=? WHERE id =?', $value, $id);
//    }
//}

//блок циклов считываение таблиц в массив объектов
function translation_table_form_in_array_objeckt_Announcements($bd) {
    $Announcements_massiv = $bd->select("select *,id AS ARRAY_KEY  from form");
    foreach ($Announcements_massiv as $key => $value) {
        $Announcements[$key] = new advertisement_class($value);
    }
    if (!empty($Announcements)) {
        return $Announcements;
    }
}


function translation_table_sity_in_array_location($bd) {
    $location = $bd->selectCol('SELECT location AS ARRAY_KEY,location FROM sity');
    return $location;
}

function translation_table_category_in_array_category($bd) {
    $category = $bd->selectCol('SELECT subcategory AS ARRAY_KEY_1,id AS ARRAY_KEY_2 ,category  FROM category');
    return $category;
}

function myLogger($db, $sql, $caller) {
    global $firePHP;
    if (isset($caller['file'])) {
        $firePHP->group("at " . @$caller['file'] . ' line ' . @$caller['line']);
    }
    $firePHP->log($sql);
    if (isset($caller['file'])) {
        $firePHP->groupEnd();
    }
}

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if (!error_reporting())
        return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}
