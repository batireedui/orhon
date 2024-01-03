<?php
require 'start.php';
print_r($_POST);
if (isset($_POST['movieadd'])) {
    if (isset($_POST['status']) == "on")
        $eseh = 1;
    else
        $eseh = 0;
    $name = post('mname', 500);
    $tai = post('mtai', 1000);
    try {
        $success = _exec(
            "insert into movie(name, img, status, `desc`, ognoo) VALUES(?, ?, ?, ?, ?)",
            'ssiss',
            [$name, '', $eseh, $tai, ognoo()],
            $count
        );
        echo "ok";
    } catch (Exception $e) {
        $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
        echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
    } finally {
    }
    redirect("movies.php");
}

if (isset($_POST['addhuvaari'])) {
    $mid = post('mid', 10);
    $name = post('mname', 500);
    $tom = post('tom', 10);
    $huuhed = post('huuhed', 10);
    $cag = post('cag', 2);
    $min = post('min', 2);
    $cag = $cag . ":" . $min;
    if (isset($_POST['status']) == "on")
        $eseh = 1;
    else
        $eseh = 0;
    try {
        $success = _exec(
            "insert into huvaari(movie_id, movie_time, tom, huuhed, status, ognoo) VALUES(?, ?, ?, ?, ?, ?)",
            'isiiis',
            [$mid, $cag, $tom, $huuhed, $eseh, ognoo()],
            $count
        );
        echo "ok";
    } catch (Exception $e) {
        $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
        echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
    } finally {
    }
    redirect("huvaari.php");
}
if (isset($_POST['edithuvaari'])) {
    $hid = post('hid', 10);
    $name = post('mname', 500);
    $tom = post('tom', 10);
    $huuhed = post('huuhed', 10);
    $cag = post('cag', 2);
    $min = post('min', 2);
    $cag = $cag . ":" . $min;
    if (isset($_POST['status']) == "on")
        $eseh = 1;
    else
        $eseh = 0;
    try {
        $success = _exec(
            "UPDATE huvaari SET movie_time=?, tom=?, huuhed=?, status=? WHERE id=?",
            'siiii',
            [$cag, $tom, $huuhed, $eseh, $hid],
            $count
        );
        echo "ok";
    } catch (Exception $e) {
        $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
        echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
    } finally {
    }
    redirect("huvaari.php");
}
if (isset($_POST['movieedit'])) {
    if (isset($_POST['status']) == "on")
        $eseh = 1;
    else
        $eseh = 0;
    $id = post('mid', 10);
    $name = post('mname', 500);
    $tai = post('mtai', 1000);
    try {
        $success = _exec(
            "update movie set name=?, status=?, `desc`=? WHERE id = ?",
            'sisi',
            [$name, $eseh, $tai, $id],
            $count
        );
        echo "ok";
    } catch (Exception $e) {
        $_SESSION['errors'] = ["Системийн алдаа гарлаа. Та дараа дахин оролдоно уу"];
        echo "Алдаа: " . $e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine() . ' : Code ' . $e->getCode();
    } finally {
    }
    redirect("movies.php");
}
