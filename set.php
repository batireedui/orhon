<?php
require 'admin/start.php';
if (isset($_SESSION['userid']) != null) {
  if (!isset($_COOKIE["cookie_hid"])) { ?>
    <div style="font-size: 40px;font-family: arial;text-align: center;font-weight: bold;margin-top: 50px;">Хуваарь сонгогдоогүй байна</div>
    <script>
      window.addEventListener('storage', () => {
        if (localStorage.getItem('change_orhon') === "changenew") {
          window.location.reload();
        }
      })
    </script>

  <?php
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
      <link rel="stylesheet" href="bt.css" />
      <link rel="stylesheet" href="main.css" />
      <title>Кино сонгох</title>
    </head>

    <body>
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12">
            <div class="titledivs">
              <div class="name">Кино: <span><?= $_COOKIE["cookie_moviename"] ?></span></div>
              <div class="name">Огноо: <span><?php echo $_COOKIE["cookie_ognoo"] ?></span></div>
              <div class="name">Цаг: <span><?php echo $_COOKIE["cookie_movie_time"] ?></span></div>
              <div class="name">Хүүхэд: <span><?= $_COOKIE["cookie_huuhed"] ?></span></div>
              <div class="name">Том хүн: <span><?= $_COOKIE["cookie_tom"] ?></span></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-10">
            <?php
            for ($i = 1; $i <= 12; $i++) {
              $st = "<div class='eg'><span class='egtitle'>Эгнээ: $i</span>";
              if ($i < 9)  $s = 16;
              else if ($i < 12)  $s = 13;
              else $s = 12;
              for ($j = 1; $j <= $s; $j++) {
                for ($n = 0; $n < count($sdata); $n++) {
                  $check = false;
                  if ($sdata[$n]->egnee == $i && $sdata[$n]->seath == $j) {
                    $check = true;
                    break;
                  }
                }
                if ($check)
                  $st .= "<div id='seath-$i-$j'class='aseat dis'>$j</div>";
                else
                  $st .= "<div id='seath-$i-$j'class='aseat' onclick='clickSeat(\"$i\", \"$j\")'>$j</div>";
              }
              $st .= '</div>';
              echo $st;
            }
            ?>
          </div>
          <div class="boxtai col-2">
            <div style="text-align: center; font-weight: bold; font-size: larger;">ТАЙЛБАР</div>
            <div class="tailbar">
              <div class='aseat'></div> СУЛ СУУДАЛ
            </div>
            <div class="tailbar">
              <div class='aseat dis'></div>СОНГОСОН
            </div>
          </div>
          <style>
            .boxtai {
              display: flex;
              flex-direction: column;
              justify-content: center;
              background: linear-gradient(90deg, rgba(230, 228, 228, 1) 0%, rgba(255, 255, 255, 1) 100%);
              border-radius: 10px
            }

            .tailbar {
              display: flex;
              align-items: center;
              font-weight: bold;
            }
          </style>
        </div>
        <script src="jquery.js" crossorigin="anonymous"></script>
        <script>
          window.addEventListener('storage', () => {
            if (localStorage.getItem('change_orhon') === "changehid") {
              window.location.reload();
            }
            for (i = 1; i <= 12; i++) {
              if (i < 9) s = 16;
              else if (i < 12) s = 13;
              else s = 12;
              for (j = 1; j <= s; j++) {
                $('#seath-' + i + '-' + j).removeClass('ch')
              }
            }
            let array = localStorage.getItem('seathItem');
            const aa = JSON.parse(array);
            if (aa !== null) {
              aa.map((el) => {
                $('#seath-' + el.egnee + '-' + el.seath).addClass('ch');
              })
            }

            let songoson = localStorage.getItem('songosonItem');
            const ss = JSON.parse(songoson);
            if (ss !== null) {
              ss.map((e) => {
                $('#seath-' + e.egnee + '-' + e.seath).addClass('dis');
              })
            }
          });
        </script>
    </body>

    </html>
<?php
  }
} else
  redirect("login.php");
?>