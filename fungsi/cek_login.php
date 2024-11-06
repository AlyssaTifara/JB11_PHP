<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

    include "config/koneksi.php";
    include "fungsi/pesan_kilat.php";
    include "fungsi/anti_injection.php";

    $username = antiinjection($koneksi, $_POST['username']);
    $password = antiinjection($koneksi, $_POST['password']);

    $query = "SELECT users' AND password = '$password'";
    $result = mysqli_query($konek, $sql);
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    }
?>