<?php
require 'start.php';
$_SESSION['page'] = "index";
require 'header.php';

_selectRowNoParam(
  "select count(id) from movie where status='1'",
  $odoomovie
);

_selectNoParam(
  $chst,
  $chcou,
  "SELECT COUNT(id) as too, hezee FROM `orderdetial` GROUP BY hezee order by hezee DESC LIMIT 10",
  $charttoo, $chartognoo
);

_selectRowNoParam(
  "select count(id) from huvaari where status='1'",
  $odoohuvaari
);

_selectRow(
  "select count(id) from orderdetial where tom='1' and tuluv='1' and hezee=?",
  's',
  [unuudur()],
  $odootom
);
_selectRow(
  "select count(id) from orderdetial where tom='0' and tuluv='1' and hezee=?",
  's',
  [unuudur()],
  $odooh
);
$ognooc = "";
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Гарч байгаа кино</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $odoomovie ?>
                  <span class="text-success text-sm font-weight-bolder">кино</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Цагийн хуваарь</p>
                <h5 class="font-weight-bolder mb-0">
                  <span class="text-success text-sm font-weight-bolder">өдөрт</span>
                  <?= $odoohuvaari ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Өнөөдөр том хүн</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $odootom ?>
                  <span class="text-danger text-sm font-weight-bolder">үзсэн</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Өнөөдөр хүүхэд</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $odooh ?>
                  <span class="text-danger text-sm font-weight-bolder">үзсэн</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Үзэлтийн статистик</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">Сараар</span>
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
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
  var ctx2 = document.getElementById("chart-line").getContext("2d");

  var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  /*var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
  gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); */
  let labeldata = [];
  let valdata = [];
  <?php
  while(_fetch($chst)){
    $ognooc = $chartognoo;
  ?>
  labeldata.push('<?=$ognooc?>');
  valdata.push(<?=$charttoo?>);
  <?php }?>
  console.log(labeldata);
  console.log(valdata);
  new Chart(ctx2, {
    type: "line",
    data: {
      labels: labeldata,
      datasets: [{
          label: "Нийт үзэлт",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          fill: true,
          data: valdata,
          maxBarThickness: 6

        },
        /*{
          label: "Websites",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#3A416F",
          borderWidth: 3,
          backgroundColor: gradientStroke2,
          fill: true,
          data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
          maxBarThickness: 6
        },*/
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>
<script>
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