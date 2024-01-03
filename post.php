<?php
require 'admin/start.php';

if (isset($_GET['hid'])) {
    _selectRow(
        "SELECT huvaari.id, TIME_FORMAT(huvaari.movie_time, '%H:%i'), tom, huuhed, movie.name FROM `huvaari` INNER JOIN movie ON huvaari.movie_id = movie.id WHERE huvaari.id=?",
        "i",
        [$_GET['hid']],
        $hid,
        $movie_time,
        $tom,
        $huuhed,
        $moviename
    );

    setcookie("cookie_hid", $hid, time() + (86400 * 30), "/", "", 0);
    setcookie("cookie_ognoo", $_GET['ognoo'], time() + (86400 * 30), "/", "", 0);
    setcookie("cookie_movie_time", $movie_time, time() + (86400 * 30), "/", "", 0);
    setcookie("cookie_tom", $tom, time() + (86400 * 30), "/", "", 0);
    setcookie("cookie_huuhed", $huuhed, time() + (86400 * 30), "/", "", 0);
    setcookie("cookie_moviename", $moviename, time() + (86400 * 30), "/", "", 0);
    //redirect("order.php");
} else
    redirect("index.php");
?>
<script>
    localStorage.setItem('change_orhon', 'changenew');
    window.location.href = "order.php";
</script>
