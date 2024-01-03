<?php
require 'admin/start.php';
header('Content-type: application/json');
if ($_POST['type'] == "choosecag") {
    $id = post('sid', 10);

    $sql = "SELECT id, TIME_FORMAT(movie_time, '%H:%i') as movie_time, tom, huuhed FROM huvaari WHERE movie_id = '$id' and status='1'";
    $result = $con->query($sql);
    if (isset($result)) {
        $cartcount = $result->num_rows;
        if ($cartcount > 0) {
            while ($row[] = $result->fetch_assoc()) {
                $item = $row;
                $json = json_encode($item);
            }
            echo $json;
        } else {
            echo json_encode("nodata");
        }
    } else {
        echo json_encode("nodata");
    }
    $con->close();
}
if ($_POST['type'] == "huvaari") {
    $id = post('sid', 10);

    $sql = "SELECT id, movie_time FROM `huvaari` WHERE movie_id = '$id'";
    $result = $con->query($sql);
    if (isset($result)) {
        $cartcount = $result->num_rows;
        if ($cartcount > 0) {
            while ($row[] = $result->fetch_assoc()) {
                $item = $row;
                $json = json_encode($item);
            }
            echo $json;
        } else {
            echo json_encode("nodata");
        }
    } else {
        echo json_encode("nodata");
    }
    $con->close();
}
