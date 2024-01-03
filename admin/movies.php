<?php
require 'start.php';
$_SESSION['page'] = "movie";
require 'header.php';

_selectNoParam(
    $stmt,
    $count,
    "SELECT id, name, status, ognoo, `desc` FROM movie ORDER BY ognoo ASC",
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
                        <button type="button" class="btn bg-gradient-info btn-block" data-bs-toggle="modal" data-bs-target="#modal-form">Кино нэмэх</button>

                        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification">Кино нэмэх</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">Шинэ кино</h3>
                                                <p class="mb-0">Шинээр гарах киноны мэдээллийг оруулна уу!</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="action.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Киноны нэр:</label>
                                                        <input type="text" class="form-control" name="mname" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Тайлбар:</label>
                                                        <textarea class="form-control" id="message-text" name="mtai"></textarea>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="status" checked="">
                                                        <label class="form-check-label" for="rememberMe">Дэлгэцэнд гарах эсэх</label>
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" name="movieadd" value="Хадгалах">
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
                                        <h6 class="modal-title" id="modal-title-notification">Кино нэмэх</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">Шинэ кино</h3>
                                                <p class="mb-0">Шинээр гарах киноны мэдээллийг оруулна уу!</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="action.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Киноны нэр:</label>
                                                        <input type="text" class="form-control" name="mname" id="mname" required>
                                                        <input type="text" class="form-control" name="mid" id="mid" style="display: none" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Тайлбар:</label>
                                                        <textarea class="form-control" name="mtai" id="mtai"></textarea>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                                        <label class="form-check-label" for="status">Идэвхтэй эсэх</label>
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" name="movieedit" value="Хадгалах">
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Тайлбар</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Төлөв</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Огноо</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($count > 0) {
                                    $d = 1;
                                    while (_fetch($stmt)) {
                                        echo "<tr>
                                                <td class='align-middle text-center' style='width: 25px;'>
                                                    <p class='text-xs font-weight-bold mb-0'>$d</p>
                                                </td>
                                                <td>
                                                   <div class='d-flex flex-column justify-content-center'>
                                                        <h6 class='mb-0 text-md'>$moviename</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class='text-xs font-weight-bold mb-0'>$moviedesc</p>
                                                </td>
                                                <td class='align-middle text-center text-sm'>";
                                        echo $moviestatus == 1 ? "<span class='badge badge-sm bg-gradient-success'>Гарч байгаа</span>" : "<span class='badge badge-sm bg-gradient-secondary'>Гараагүй</span>";
                                        echo "</td>
                                                <td class='align-middle text-center'>
                                                    <span class='text-secondary text-xs font-weight-bold'>$movieognoo</span>
                                                </td>
                                                <td class='align-middle'>
                                                <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#modal-edit' onClick='editM(\"" . $movieid . "\", \"" . $moviename. "\", \"" . $moviestatus. "\", \"" . $moviedesc. "\")'>Засах</button>
                                                </td>
                                            </tr>";
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
<script type="text/javascript">
    function editM(id, name, tuluv, descr) {
        console.log(tuluv);
        const es = document.querySelector('#status');
        const att = document.createAttribute("checked");
        if (tuluv == 1) {
            es.setAttributeNode(att);
        } else {
            document.getElementById("status").removeAttribute("checked");
        }
        document.querySelector('#mid').value = id;
        document.querySelector('#mname').value = name;
        document.querySelector('#mtai').value = descr;
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