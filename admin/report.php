<?php
require 'start.php';
$_SESSION['page'] = "report";
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
if (isset($_GET['movie']) != "" && isset($_GET['sdate']) != "" && isset($_GET['edate']) != "") {
    $get = true;
    _select(
        $stmt,
        $count,
        "SELECT egnee, seat, une, orderdetial.tom, movie_time, hezee FROM orderdetial INNER JOIN huvaari ON orderdetial.huvaari_id = huvaari.id WHERE huvaari.movie_id=? and hezee BETWEEN ? and ?",
        "iss",
        [$_GET['movie'], $_GET['sdate'], $_GET['edate']],
        $egnee,
        $suu,
        $une,
        $tom,
        $movie_time,
        $hezee
    );
    _selectRow(
        "SELECT sum(orderdetial.une), movie.name FROM orderdetial INNER JOIN huvaari ON orderdetial.huvaari_id = huvaari.id INNER JOIN movie ON huvaari.movie_id = movie.id WHERE huvaari.movie_id=? and hezee BETWEEN ? and ?",
        "iss",
        [$_GET['movie'], $_GET['sdate'], $_GET['edate']],
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="movie">
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
                            <input type="date" class="form-control" name="sdate" value="<?= date(unuudur()) ?>" />
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <h6><?php echo $get ? $mnamesum . "  Эхэлсэн: " . $_GET['sdate'] . "  Сүүлийн: " . $_GET['edate'] . " Нийт: " . $sum . "₮" : "Кино болон эхний, сүүлийн огноонуудыг сонгож харна" ?></h6>
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
<script>
    function printDiv() {
        var divElements = document.getElementById("parea").innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML = "<h1>ОРХОН КИНО ТЕАТР</h1>" + divElements;

        window.print();

        document.body.innerHTML = oldPage;

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