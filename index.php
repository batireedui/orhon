<?php
require 'admin/start.php';
if(isset($_SESSION['userid']) != null)
{
_selectNoParam(
    $stmt,
    $count,
    "SELECT id, name FROM movie WHERE status = '1'",
    $movieid,
    $moviename
);
?>
<!DOCTYPE html>
<html>

<head>
    <link href="bt.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div>
                    <h3 style="text-align: center;">ХУВААРЬ СОНГОХ</h3>
                </div>
                <div class="mb-3">
                    <label class="form-label">Кино сонгох</label>
                    <select id="movie" class="form-control" name="mid" onchange="movieChoosed()">
                        <option value='0'>Киногоо эндээс сонго</option>
                        <?php while (_fetch($stmt)) {
                            echo "<option value='$movieid'>$moviename</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th>Огноо</th>
                            <th>Цаг</th>
                            <th>Том хүн</th>
                            <th>Хүүхэд</th>
                            <th></th>
                        </tr>
                        <tbody id="cag">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
<script src="bt.js" crossorigin="anonymous"></script>
<script src="jquery.js" crossorigin="anonymous"></script>
<script>
    function movieChoosed() {
        const today = '<?php echo date('Y-m-d', strtotime(ognoo())); ?>';
        let a = document.getElementById("movie").value;
        $.ajax({
            url: 'axios.php',
            type: 'POST',
            data: jQuery.param({
                type: "choosecag",
                sid: a,
            }),
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(response) {
                console.log(response);
                if (response.indexOf("nodata") > -1) {
                    $('#cag').html("<tr><td colspan='4'>Идэвхтэй цагийн хуваарь байхгүй байна</td></tr>");
                } else {
                    let val = "";
                    response.map((el) => {
                        val += '<tr><td name="hid"  style="display: none">' + el.id + '</td><td><input type="date" class="form-control" name="ognoo" value="' + today + '" /></td><td name="htime">' + el.movie_time + '</td><td name="htom">' + el.tom + '</td><td name="hhuuhed">' + el.huuhed + '</td><td>';
                        val += '<a href="post.php?hid=' + el.id + '&ognoo=' + today + '" class="btn btn-success">Сонгох</a></td></tr>';
                    });
                    $('#cag').html(val);
                }
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    }
</script>

</html>
<?php }
else
    redirect("login.php");?>