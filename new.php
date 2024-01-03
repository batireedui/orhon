<?php
$past = time() - 3600;
foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, $past, '/');
}
?>
<script>
    localStorage.removeItem("seathItem");
    localStorage.removeItem("songosonItem");
    localStorage.setItem('change_orhon', 'changehid');
    window.location.href = "index.php";
</script>
