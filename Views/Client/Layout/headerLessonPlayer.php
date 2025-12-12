<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$isLoggedIn = false;
if (!empty($_SESSION['client'])) {
    $isLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix</title>
    <link rel="shortcut icon" href="https://res.cloudinary.com/dfmoftnpw/image/upload/v1765528592/logo_sajaxq.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./Assets/Client/css/header.css">
    <link rel="stylesheet" href="./Assets/Client/css/style.css">
    <link rel="stylesheet" href="./Assets/Client/css/Alert.css" />

</head>

<body>
    