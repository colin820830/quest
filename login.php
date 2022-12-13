<?php
	require_once('startsession.php');
	
?>

<style type="text/css">
	
	.mg-10{
		margin: 10px;
	}

</style>


<script>
function check_form(login_form)
{
	var x = document.login_form
	var z = false
	if(x.e_usr.value == "")
	{alert("請輸入[帳號]");
	 x.e_usr.focus();
	 return false;
	}	
	if(x.e_pwd.value == "")
	{alert("請輸入[密碼]");
	 x.e_pwd.focus();
	 return false;
	}				
}
</script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>問卷調查系統</title>
  <link rel="icon" type="image/png" href="images/icon.png" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

  <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="login.php">問卷調查系統登入</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
          <li class="nav-item">
              <a class="nav-link" href="teaching.php" target="_blank">操作教學</a>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link" href="table.php" target="_blank">單位系統參考對照表</a>
          </li> -->

      </ul>
    </div>

  </div>
</nav>


<div class="container mg-10">
  <form class="form-horizontal" role="form" name="login_form" id="login_form" method="post" action="login_chk.php" >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">帳 號</label>
    <div class="col-sm-10">
      <input class="form-control" name="e_usr" id="e_usr" placeholder="請輸入薪資帳號">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密 碼</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="e_pwd" id="e_pwd" placeholder="請輸入密碼">
    </div>
  </div>
  <div class="form-group mg-10">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="Submit" onClick="javascript:return check_form(login_form)"  class="btn btn-primary">登 入</button>
	  <button type="reset" name="clear" class="btn btn-primary">取 消</button>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
  <p class="form-control-static text-danger">
  ( 本站建議使用瀏覽器為Google Chrome, Firefox )
	</p>
	</div>
	</div>
</form>	

</body>


<?php
	require_once('footer.php');
?>