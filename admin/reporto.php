<?php
require 'start.php';
$_SESSION['page'] = "reporto";
require 'header.php';
$get = false;
$count = 0;
_selectNoParam(
    $st,
    $ct,
    "select id, name from movie where status='1'",
    $mid,
    $mname
);
if (isset($_GET['huvaarie']) != "" && isset($_GET['edate']) != "") {
    $get = true;
    _select(
        $stmt,
        $count,
        "SELECT egnee, seat, une, orderdetial.tom, movie_time, hezee FROM orderdetial INNER JOIN huvaari ON orderdetial.huvaari_id = huvaari.id WHERE orderdetial.huvaari_id=? and hezee = ?",
        "is",
        [$_GET['huvaarie'], $_GET['edate']],
        $egnee,
        $suu,
        $une,
        $tom,
        $movie_time,
        $hezee
    );
    _selectRow(
        "SELECT sum(orderdetial.une), movie.name FROM orderdetial INNER JOIN huvaari ON orderdetial.huvaari_id = huvaari.id INNER JOIN movie ON huvaari.movie_id = movie.id WHERE orderdetial.huvaari_id=? and hezee = ?",
        "is",
        [$_GET['huvaarie'], $_GET['edate']],
        $sum,
        $mnamesum
    );
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="movie" onchange="huvaari()">
                                <option value="0">Хуваарь сонгоно уу</option>
                                <?php
                                if ($ct > 0) {
                                    while (_fetch($st)) {
                                        echo "<option value='$mid'>$mname</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="huvaarie" name="huvaarie">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" class="form-control" name="edate" value="<?= date(unuudur()) ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Харах" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="button" class="btn btn-success" value="Хэвлэх" onclick="printDiv()"/>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mb-4" id="parea">
                <div class="card-header pb-0">
                    <h6><?php echo $get ? $mnamesum . "  Огноо: " . $_GET['edate'] . " Нийт: " . $sum . "₮" : "Үзвэр болон эхний, сүүлийн огноонуудыг сонгож харна" ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Өдөр</th>
                                    <th>Цаг</th>
                                    <th>Төрөл</th>
                                    <th>TAX</th>
                                    <th>Эгнээ</th>
                                    <th>Суудал</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($count > 0) {
                                    $nu = 1;
                                    while (_fetch($stmt)) {
                                        $tt = "";
                                        $tom == "1" ? $tt = "Том хүн" : $tt = "Хүүхэд";
                                        echo "<tr>
                                            <td>$nu</td>
                                            <td>$hezee</td>
                                            <td>$movie_time</td>
                                            <td>$tt</td>
                                            <td>$une</td>
                                            <td>$egnee</td>
                                            <td>$suu</td>
                                        </tr>";
                                        $nu++;
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<!--   Core JS Files   -->
<?php require 'footer.php';   ?>
<script src="../jquery.js" crossorigin="anonymous"></script>
<script>
    function printDiv() {
        var divElements = document.getElementById("parea").innerHTML;
        var oldPage =  document.body.innerHTML;
        document.body.innerHTML = "<h1>ОРХОН КИНО ТЕАТР</h1>" + divElements;

        window.print();

        document.body.innerHTML = oldPage;

    }

    function huvaari() {
        let a = document.getElementById("movie").value;
        $.ajax({
            url: '../axios.php',
            type: 'POST',
            data: jQuery.param({
                type: "huvaari",
                sid: a,
            }),
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(response) {
                console.log(response);
                if (response.indexOf("nodata") > -1) {
                    $('#huvaarie').html('<option id="h" value="">Хуваарь байхгүй байна</option>');
                } else {
                    let val = '';
                    response.map((el) => {
                        val += '<option id="h' + el.id + '" value="' + el.id + '">' + el.movie_time + '</option>';

                    });
                    $('#huvaarie').html(val);
                }
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<?php require 'end.php';   ?>