<?php
	require_once('startsession.php');

    $name= mb_convert_encoding($_SESSION['oname'], "UTF-8", "BIG5");
?>

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
    <div class="form-group row m-4">
        <h3>Hi~ <?=$name?></h3>
        <h3>您為第一次登入請填寫以下資料</h3>
    </div>

    <form action="login_add.php" method="post">
        <div class="form-group row m-4">
            <div class="col-md-auto">
                <label>
                公司別:
                </label>
            </div>

            <div class="col-md-3">
                <!-- <input type="text" name="company" id="company" required> -->
                <select id="company" name="company" class="form-select" required>
                    <option value="">--請選擇公司--</option>
                    <option value="順益貿易">順益貿易</option>
                    <option value="裕益汽車">裕益汽車</option>
                    <option value="聯晟汽車">聯晟汽車</option>
                    <!-- <option value="健益汽車">健益汽車</option> -->
                    <option value="安德順">安德順</option>
                    <option value="順益租賃">順益租賃</option>
                    <!-- <option value="順益車輛">順益車輛</option> -->
                </select>
            </div>

            <div class="col-md-auto">
                <label>
                    部門:
                </label>
            </div>

            <div class="col-md-3">
                <!-- <input type="text" name="department" id="department" required> -->

                <select id="department" name="department" class="form-select" required>

                <option value="">--請選擇部門--</option>

                    <option value="租賃部">租賃部</option>
                    <option value="總務部">總務部</option>
                    <option value="財務部">財務部</option>
                    <option value="授信部">授信部</option>
                    <option value="業管部">業管部</option>
                    <option value="貿易部">貿易部</option>
                    <option value="工務部">工務部</option>
                    <option value="資訊部">資訊部</option>
                    <option value="週邊事業部">週邊事業部</option>
                    <option value="稽核室">稽核室</option>
                    <option value="零件部">零件部</option>
                    <option value="重工事業部">重工事業部</option>
                    <option value="石油部">石油部</option>

                </select>
            </div>

        </div>

        <div class="form-group row m-4">
            <div class="col-md-auto">
                <label>
                    聯繫窗口人員姓名:
                </label>
            </div>

            <div class="col-md-3">
                <input type="text" class="form-control" name="windowname" id="windowname" required>
            </div>

            <div class="col-md-auto">
                <label>
                    聯繫電話:
                </label>
            </div>

            <div class="col-md-3">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="ex. #552" required>
            </div>
        </div>

        <div class="form-group row m-4">
            <div class="col-md-4">
                <button type="submit" class="btn btn btn-primary">送出</button>
            </div>
        </div>
    </form>

</main>
</body>


<?php
	require_once('footer.php');
?>