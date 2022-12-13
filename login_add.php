<?
    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'class.php';

    $message = "";

    $company = isset($_REQUEST["company"])? $_REQUEST["company"] : "";
    $department = isset($_REQUEST["department"])? $_REQUEST["department"] : "";
    $windowname = isset($_REQUEST["windowname"])? $_REQUEST["windowname"] : "";
    $phone = isset($_REQUEST["phone"])? $_REQUEST["phone"] : "";

    $userid = $_SESSION['userid'];

    $name= $_SESSION['oname'];

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);


    $company = iconv("UTF-8", "big5", $company);
    $department = iconv("UTF-8", "big5", $department);
    $windowname = iconv("UTF-8", "big5", $windowname);

    $fields = "user_id, USERNAME, DEPARTMENT, windowName, IS_DELETE, Create_DT, company, phone";

    $values = "'$userid', '$name', '$department', '$windowname', 'N', sysdate, '$company', '$phone'";

    $db->insStmt("DBASRM.QuestMain", $fields, $values);

    $message = "成功新增資料!";
?>

<script>
		alert("<?php echo $message;?>");
		location.href = "index.php";
</script>