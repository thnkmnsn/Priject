<?php
if(isset($_SESSION['counter'])){
    $_SESSION['counter'] += 1;
    setcookie("counter", $_SESSION['counter'], time() + 3600);
}else{
    $_SESSION['counter'] = 1;
    setcookie("counter", $_SESSION['counter'], time() + 3600);
}

echo "คุณเข้าชมเว็บไซต์นี้แล้ว <strong>" . $_SESSION['counter'] . "</strong> ครั้ง ล่าสุด " . date("d/m/Y H:i:s", time());
?>
