<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Colin" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow" />
    <meta name="rating" content="General" />
    <link rel="icon" type="image/png" href="images/icon.png" />

    <base target="_self" />
    <title>問卷調查系統</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="login.php">問卷調查系統登入</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

<main>

    <div class="form-group row m-3">
        <h3>操作教學</h3>
    </div>

    <div class="form-group row m-3">
        <h3>第一次進入系統頁面</h3>

        <img src="./images/teaching00.jpg" class="img-fluid">
    </div>

    <div class="form-group row m-3">
        <h3>新增問卷</h3>

        <img src="./images/teaching01.jpg" class="img-fluid">
    </div>

    <div class="form-group row m-3">
        <h3>填寫問卷</h3>

        <img src="./images/teaching02.jpg" class="img-fluid">
    </div>

    <div class="form-group row m-3">
        <h3>修改及刪除問卷</h3>

        <img src="./images/teaching03.jpg" class="img-fluid">
    </div>

    <!-- <div class="form-group row m-2">
        <div class="col-md-auto">
            <button type="button" onclick="history.back()" class="btn btn btn-danger">回上一頁</button>
        </div>
    </div> -->
</main>

</body>


<?php
    require_once 'footer.php';
?>