<?php
require 'start.php';
$_SESSION['page'] = "huvaari";
require 'header.php';

_selectNoParam(
    $stmt,
    $count,
    "SELECT id, name, status, ognoo, `desc` FROM movie WHERE status = '1' ORDER BY ognoo ASC",
    $movieid,
    $moviename,
    $moviestatus,
    $movieognoo,
    $moviedesc
);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Киноны жагсаалт</h6>
                    <div>
                        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification">Кино гарах хуваарь</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">Цагийн хуваарь нэмэх</h3>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="action.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Киноны нэр:</label>
                                                        <input type="text" class="form-control" name="mname" id="mname" readonly>
                                                        <input type="text" class="form-control" name="mid" id="mid" style="display: none" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Цаг:</label>
                                                                <select class="form-control" name="cag">
                                                                    <?php
                                                                    for ($i = 8; $i < 24; $i++)
                                                                        echo $i < 10 ? "<option>0$i</option>" : "<option>$i</option>"
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Минут:</label>
                                                                <select class="form-control" name="min">
                                                                    <?php
                                                                    for ($i = 0; $i < 60; $i = $i + 5)
                                                                        echo $i < 10 ? "<option>0$i</option>" : "<option>$i</option>"
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Том хүн тариф:</label>
                                                                <input type="number" class="form-control" name="tom" placeholder="Тоо оруулна" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Хүүхэд тариф:</label>
                                                                <input type="number" class="form-control" name="huuhed" placeholder="Тоо оруулна" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                                                <label class="form-check-label" for="status">Идэвхтэй эсэх</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" name="addhuvaari" value="Хадгалах">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification">Кино гарах хуваарь</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">Цагийн хуваарь нэмэх</h3>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="action.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Киноны нэр:</label>
                                                        <input type="text" class="form-control" name="mname" id="hmname" readonly>
                                                        <input type="text" class="form-control" name="hid" id="hid" style="display: none" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Цаг:</label>
                                                                <select class="form-control" name="cag" id="hcag">
                                                                    <?php
                                                                    for ($i = 8; $i < 24; $i++)
                                                                        echo $i < 10 ? "<option>0$i</option>" : "<option>$i</option>"
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Минут:</label>
                                                                <select class="form-control" name="min" id="hmin">
                                                                    <?php
                                                                    for ($i = 0; $i < 60; $i = $i + 5)
                                                                        echo $i < 10 ? "<option>0$i</option>" : "<option>$i</option>"
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Том хүн тариф:</label>
                                                                <input type="number" class="form-control" name="tom" id="htom" placeholder="Тоо оруулна" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Хүүхэд тариф:</label>
                                                                <input type="number" class="form-control" name="huuhed" id="hhuuhed" placeholder="Тоо оруулна" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="hstatus" name="status" checked>
                                                                <label class="form-check-label" for="status">Идэвхтэй эсэх</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" name="edithuvaari" value="Хадгалах">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Киноны нэр</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Цаг</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Том хүн</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Хүүхэд</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Төлөв</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Огноо</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($count > 0) {
                                    $d = 1;
                                    while (_fetch($stmt)) {
                                        _selectNoParam(
                                            $hstmt,
                                            $hcount,
                                            "SELECT id, movie_time, tom, huuhed, status, ognoo FROM huvaari WHERE movie_id = '$movieid'",
                                            $hid,
                                            $htime,
                                            $htom,
                                            $hhuu,
                                            $hstatus,
                                            $hognoo
                                        );
                                        $ee = 1;
                                        while (_fetch($hstmt)) {
                                            echo "<tr>";
                                            echo $ee == 1 ?
                                                "<td class='align-middle text-center' style='width: 25px;' rowspan='$hcount'>
                                                <p class='text-xs font-weight-bold mb-0'>$d</p>
                                            </td>
                                            <td  rowspan='$hcount'>
                                            <div class='d-flex flex-column justify-content-center'>
                                                    <h6 class='mb-0 text-md'>$moviename</h6>
                                                </div>
                                            </td>" : null;
                                            echo "<td class='align-middle text-center'> $htime </td><td> $htom </td><td>  $hhuu </td><td>";
                                            echo $hstatus == 1 ? "<span style='color: green'> Гарч байгаа</span>" : "<span style='color: red'> Гараагүй </span>";

                                            echo "</td><td><a href='#' style='margin-left: 10px;' data-bs-toggle='modal' data-bs-target='#modal-edit' onClick='editM(\"" . $hid . "\", \"" . $moviename . "\", \"" . $htime . "\", \"" . $htom . "\", \"" . $hhuu . "\", \"" . $hstatus . "\")'><span class='badge badge-sm bg-gradient-primary'>Засах</span></a></td>";

                                            echo $ee == 1 ? "<td class='align-middle' rowspan='$hcount'>
                                                <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#modal-add' onClick='addM(\"" . $movieid . "\", \"" . $moviename . "\")'>Цаг нэмэх</button>
                                                </td>
                                            </tr>" : null;
                                            $ee++;
                                        }
                                        $d++;
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
<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" />
<script type="text/javascript">
    function addM(id, name) {
        document.querySelector('#mid').value = id;
        document.querySelector('#mname').value = name;
    }

    function editM(hid, mname, cag, tom, child, sta) {
        console.log(cag.substring(0, 2));
        console.log(cag.substring(3, 5));
        const es = document.querySelector('#hstatus');
        const att = document.createAttribute("checked");
        if (sta == 1) {
            es.setAttributeNode(att);
        } else {
            document.getElementById("hstatus").removeAttribute("checked");
        }
        document.querySelector('#hid').value = hid;
        document.querySelector('#hmname').value = mname;
        document.querySelector('#htom').value = tom;
        document.querySelector('#hhuuhed').value = child;
        document.querySelector('#hcag').value = cag.substring(0, 2);
        document.querySelector('#hmin').value = cag.substring(3, 5);
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