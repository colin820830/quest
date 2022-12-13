<?
    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'class.php';

    $message = "";

    $systemType = isset($_REQUEST["systemType"])? $_REQUEST["systemType"] : "";
    $stablize = isset($_REQUEST["stablize"])? $_REQUEST["stablize"] : "";
    $speed = isset($_REQUEST["speed"])? $_REQUEST["speed"] : "";
    $operate = isset($_REQUEST["operate"])? $_REQUEST["operate"] : "";
    $program = isset($_REQUEST["program"])? $_REQUEST["program"] : "";
    $ability = isset($_REQUEST["ability"])? $_REQUEST["ability"] : "";
    $contentTextarea = isset($_REQUEST["contentTextarea"])? $_REQUEST["contentTextarea"] : "";

    $stablizeReason = isset($_REQUEST["stablizeReason"])? $_REQUEST["stablizeReason"] : "";
    $speedReason = isset($_REQUEST["speedReason"])? $_REQUEST["speedReason"] : "";
    $operateReason = isset($_REQUEST["operateReason"])? $_REQUEST["operateReason"] : "";
    $programReason = isset($_REQUEST["programReason"])? $_REQUEST["programReason"] : "";
    $abilityReason = isset($_REQUEST["abilityReason"])? $_REQUEST["abilityReason"] : "";

    $Q = new QuestContent();

    $Q->stablize = $stablize;
    $Q->stablizeReason = $stablizeReason;

    $Q->speed = $speed;
    $Q->speedReason = $speedReason;

    $Q->operate = $operate;
    $Q->operateReason = $operateReason;

    $Q->program = $program;
    $Q->programReason = $programReason;

    $Q->ability = $ability;
    $Q->abilityReason = $abilityReason;

    $quest_content = json_encode($Q);

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $where =' where IS_DELETE = \'N\' and user_id = \''. trim($_SESSION['userid']) .'\'';		

    $result = $db->selStmt('DBASRM.QuestMain', 'id, user_id, department', $where, '');

    if(!empty($result))
    {
        $QuestMain_id = $result[0][0];
        $user_id = $result[0][1];
        $department = $result[0][2];
    }
    else
    {
        $message = "發生錯誤 找不到 QuestMain 主檔資料";
?>
        <script>
            alert("<?php echo $message;?>");
            location.href = "index.php";
        </script>

<?
    }

    $systemType = iconv("UTF-8", "big5", $systemType);

    $contentTextarea = iconv("UTF-8", "big5", $contentTextarea);

    $fields = "QuestMain_id, Systemtype, Quest_content, Quest_note, IS_DELETE, Update_DT, department, Update_UserId";

    $values = "'$QuestMain_id', '$systemType', '$quest_content', '$contentTextarea', 'N', sysdate, '$department', '$user_id'";

    $db->insStmt("DBASRM.QuestReply", $fields, $values);

    $message = "成功新增資料!";
?>

<script>
		alert("<?php echo $message;?>");
		location.href = "index.php";
</script>