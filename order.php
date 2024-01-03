<?php
require 'admin/start.php';
if(isset($_SESSION['userid']) != null)
{
if (!isset($_COOKIE["cookie_hid"])) {
    redirect("index.php");
} else {

    $sql = "SELECT egnee, seat as seath FROM orderdetial WHERE hezee= '" . $_COOKIE['cookie_ognoo'] . "' and huvaari_id = '" . $_COOKIE["cookie_hid"] . "'";
    $result = $con->query($sql);
    $dataset = [];
    if (@$result->num_rows > 0) {
        while ($row[] = $result->fetch_assoc()) {
            $item = $row;
            $dataset = json_encode($item);
        }
        $sdata = json_decode($dataset);
    } else {
        $dataset = '[{"egnee":"0", "seath":"0"}]';
    }
    $sdata = json_decode($dataset);
    $con->close();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bt.css">
        <link rel="stylesheet" href="main.css" />
        <title>Үзвэр сонгох</title>
    </head>

    <body>
        <div class="container">
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Захиалга баталгаажуулах</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        Үзвэр: <span class="btext"><?= $_COOKIE["cookie_moviename"] ?></span><br>
                                        Огноо: <span class="btext"><?php echo $_COOKIE["cookie_ognoo"] . ' ' . $_COOKIE["cookie_movie_time"] ?></span>
                                    </div>
                                    <div class="col-6">
                                        Том хүн: <span class="btext"><?= $_COOKIE["cookie_tom"] ?>₮</span><br>
                                        Хүүхэд: <span class="btext"><?= $_COOKIE["cookie_huuhed"] ?>₮</span>
                                    </div>
                                </div>

                                <input type="text" class="form-control" id="choosen" name="choosen" style="display: none;">

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Суудлын тоо:</label>
                                            <input type="text" class="form-control" id="stooval" name="stooval" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Том хүн:</label>
                                            <input type="text" class="form-control" id="ztom" name="tomtoo" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Хүүхэд:</label>
                                            <select class="form-control" id="zhuuhed" name="huuhedtoo" onchange="bod()">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Төлөх дүн:</label>
                                            <input type="text" class="form-control" id="sdun" name="sdun" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Төлсөн дүн:</label>
                                            <input type="number" class="form-control" id="bdun" name="bdun" onchange="dunbod()" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Хариулт:</label>
                                            <input type="text" class="form-control" id="hdun" name="hdun" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Болих</button>
                            <input type="submit" class="btn btn-primary" name="orderinsert" id="orderinsert" value="Баталгаажуулах" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="titledivs">
                        <div class="name">Үзвэр: <span><?= $_COOKIE["cookie_moviename"] ?></span></div>
                        <div class="name"><span><?php echo $_COOKIE["cookie_ognoo"] . ' ' . $_COOKIE["cookie_movie_time"] ?></span></div>
                        <div class="name">Хүүхэд: <span><?= $_COOKIE["cookie_huuhed"] ?></span></div>
                        <div class="name">Том хүн: <span><?= $_COOKIE["cookie_tom"] ?></span></div>
                        <div class="name"><a href="new.php"><button type="button" class="btn btn-danger">ХУВААРЬ СОЛИХ</button></a></div>
                        <div class="name"><a href="set.php" target="blank"><button type="button" class="btn btn-warning">[]</button></a></div>
                        <div class="name"><a href="logout.php" target="blank"><button type="button" class="btn btn">Гарах</button></a></div>
                    </div>
                </div>
            </div>
            <div id="detial">
                Сонгосон суудал: <input id='stoo' class="inp" type='text' name="stoo" value="" readonly />
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#orderModal" id="zbtn" onclick="mclick()">ЗАХИАЛАХ</button>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $st = "<div class='eg'><span class='egtitle1'>Эгнээ: $i</span>";
                        if ($i < 9)  $s = 16;
                        else if ($i < 12)  $s = 13;
                        else $s = 12;
                        for ($j = 1; $j <= $s; $j++) {
                            for ($n = 0; $n < count($sdata); $n++) {
                                $check = false;
                                if ($sdata[$n]->egnee == $i && $sdata[$n]->seath == $j){
                                    $check = true;
                                    break;
                                }
                            }
                            if ($check)
                                $st .= "<div id='seath-$i-$j'class='aseats dis'>$j</div>";
                            else
                                $st .= "<div id='seath-$i-$j'class='aseats' onclick='clickSeat(\"$i\", \"$j\")'>$j</div>";
                        }
                        $st .= '</div>';
                        echo $st;
                    }
                    ?>
                </div>
            </div>

            <script src="bt.js"></script>
            <script src="jquery.js"></script>
            <script>
                let clicks = [];
                localStorage.removeItem('songosonItem');
                const songoson = <?php echo $dataset?>;
                localStorage.setItem('songosonItem', JSON.stringify(songoson));
                const taxT = <?= $_COOKIE["cookie_tom"] ?>;
                const taxH = <?= $_COOKIE["cookie_huuhed"] ?>;
                clickSeat();

                function mclick() {
                    $("#choosen").val(JSON.stringify(clicks));
                    $("#stooval").val(clicks.length);
                    $("#ztom").val(clicks.length);
                    let zs = "";
                    for (let i = 0; i <= clicks.length; i++) {
                        zs += ("<option>" + i + "</option>");
                    }
                    $("#zhuuhed").html(zs);
                    bod();
                }

                function bod() {
                    let hh = $("#zhuuhed").val();
                    hh === "" ? hh = 0 : null;
                    console.log(hh + "dd");
                    let tt = clicks.length - parseInt(hh);
                    $("#ztom").val(tt);

                    $("#sdun").val(tt * taxT + taxH * hh);
                    dunbod();
                }

                function dunbod() {
                    bdun = $("#bdun").val();
                    sdun = $("#sdun").val();
                    bdun === "" ? bdun = 0 : null;
                    $("#hdun").val(parseInt(bdun) - parseInt(sdun));
                }

                function clickSeat(e, s) {
                    console.log(e);
                    const obj = {
                        egnee: e,
                        seath: s
                    };
                    if (e === undefined) {
                        document.getElementById("zbtn").disabled = true;
                        for (i = 1; i <= 12; i++) {
                            if (i < 9) s = 16;
                            else if (i < 12) s = 13;
                            else s = 12;
                            for (j = 1; j <= s; j++) {
                                $('#seaths-' + i +'-'+ j).removeClass('chs')
                            }
                        }
                        $("#stoo").val("");
                        localStorage.removeItem('seathItem');
                    } else {
                        document.getElementById("zbtn").disabled = false;
                        let cs = document.getElementById("seath-" + e +'-'+ s);
                        if (cs.className == "aseats") {
                            $('#seath-' + e +'-'+ s).addClass('chs');
                            clicks.push(obj);
                            //$("#detial").append("<input id='in-"+e+s+"' type='text'/>");
                        } else {
                            const index = clicks.findIndex(object => {
                                return object.egnee === e && object.seath === s;
                            });
                            if (index > -1) {
                                clicks.splice(index, 1);
                            }
                            $('#seath-' + e +'-' + s).removeClass('chs');
                        }
                        $("#stoo").val(clicks.length);
                        clicks.length > 0 ? document.getElementById("zbtn").disabled = false : document.getElementById("zbtn").disabled = true;
                        console.log(clicks);
                        localStorage.setItem('seathItem', JSON.stringify(clicks));
                    }
                }
            </script>
    </body>

    </html>
<?php
}
 }
else
    redirect("login.php");
?>