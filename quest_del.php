<?
    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'class.php';

    $message = "";

    $QuestReply_id = isset($_REQUEST["id"])? $_REQUEST["id"] : "";

    $Update_UserId = trim($_SESSION['userid']);

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $where =' where IS_DELETE = \'N\' and id = \''. $QuestReply_id .'\'';	

    $fields = " IS_DELETE = 'Y', Update_DT = sysdate, Update_UserId = '$Update_UserId'";

    $db->updStmt("DBASRM.QuestReply", $fields, $where);

    $message = "成功刪除資料!";
?>

<script>
		alert("<?php echo $message;?>");
		location.href = "index.php";
</script>