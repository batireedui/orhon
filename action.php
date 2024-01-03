<?php
require 'admin/start.php';

$seat = $_POST["choosen"];
$hid = $_COOKIE["cookie_hid"];
$taxT = $_COOKIE["cookie_tom"];
$taxH = $_COOKIE["cookie_huuhed"];
$tomtoo = $_POST["tomtoo"];
$huuhedtoo = $_POST["huuhedtoo"];

$seatObj = json_decode($seat, false);
$odo = ognoo();
$tomif = 0;
$el = "";
for ($i = 0; $i < count($seatObj); $i++) {
    if ((int)$tomtoo > 0) {
        _exec(
            "INSERT INTO orderdetial(huvaari_id, username, egnee, seat, une, tuluv, ognoo, hezee, tom) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)",
            "isiiiissi",
            [$hid, "", $seatObj[$i]->egnee, $seatObj[$i]->seath, $taxT, "1", $odo, $_COOKIE['cookie_ognoo'], "1"],
            $c
        );
        $el .= "<div style='padding: 15px; margin-bottom: 25px'>
                    <div class='tit'>ОРХОН КИНО ТЕАТР</div>
                    <div class='lis'>Үзвэр: <span>" . $_COOKIE['cookie_moviename'] . " </span></div>
                    <div class='lis'>Хуваарь: <span>" . $_COOKIE['cookie_ognoo'] . " " . $_COOKIE['cookie_movie_time'] . "</span></div>
                    <div class='lis'>Төрөл: <span>Том хүн:</span></div>
                    <div class='lis'>Тасалбар үнэ: <span>$taxT</span></div>
                    <div class='lis'>ЭГНЭЭ: <span>1</span> СУУДАЛ: <span>5</span></div>
                    <div style='text-align: center; margin-top: 10px; font-size: 10px; font-style: italic'>Манайхаар үйлчлүүлсэн танд баярлалаа. Манайхаар дахин үйлчлүүлээрэй.</div>
                    <div style='text-align: center; margin-top: 10px'>$odo</div>
                </div>";
    } else {
        _exec(
            "INSERT INTO orderdetial(huvaari_id, username, egnee, seat, une, tuluv, ognoo, hezee, tom) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)",
            "isiiiissi",
            [$hid, "", $seatObj[$i]->egnee, $seatObj[$i]->seath, $taxH, "1", $odo, $_COOKIE['cookie_ognoo'], "0"],
            $c
        );
        $el .= "<div style='padding: 15px; margin-bottom: 25px'>
                    <div class='tit'>ОРХОН КИНО ТЕАТР</div>
                    <div class='lis'>Үзвэр: <span>" . $_COOKIE['cookie_moviename'] . " </span></div>
                    <div class='lis'>Хуваарь: <span>" . $_COOKIE['cookie_ognoo'] . " " . $_COOKIE['cookie_movie_time'] . "</span></div>
                    <div class='lis'>Төрөл: <span>Хүүхэд:</span></div>
                    <div class='lis'>Тасалбар үнэ: <span>$taxH</span></div>
                    <div class='lis'>ЭГНЭЭ: <span>1</span> СУУДАЛ: <span>5</span></div>
                    <div style='text-align: center; margin-top: 10px; font-size: 10px; font-style: italic'>Манайхаар үйлчлүүлсэн танд баярлалаа. Манайхаар дахин үйлчлүүлээрэй.</div>
                    <div style='text-align: center; margin-top: 10px'>$odo</div>
                </div>";
    }
    $tomtoo--;
}

?>
<html>

<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .wid {
            display: inline-block;
            width: 56mm;
            background-color: #fff0ff;
            margin: auto;
        }

        .tit {
            text-align: center;
            font-weight: bold;
        }

        .lis {
            margin-top: 10px;
        }

        .lis span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="parea">
        <div class="wid">
            <?php echo $el; ?>
        </div>
    </div>
    <script>
        window.onload = function() {
            printDiv();
        }
        window.onafterprint = function(e) {
            window.onfocus = function() {
                console.log(e);
                window.location.href = "order.php";
            }
        };

        function closePrintView() {

        }

        async function printDiv() {
            var divElements = document.getElementById("parea").innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML =
                "<html><head></head><body>" +
                divElements + "</body>";

            await window.print();

        }
    </script>
</body>

</html>