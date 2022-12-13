<?

    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'Id_chk.php';
    require_once 'change_txt.php';

    $QuestReply_id = isset($_REQUEST["id"])? $_REQUEST["id"] : "";

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $where_QuestReply =' where IS_DELETE = \'N\' and id = \''. $QuestReply_id .'\'';	

    $result_QuestReply = $db->selStmt('DBASRM.QuestReply', 'systemtype, Quest_content, Quest_note, id', $where_QuestReply, 'order by Update_DT desc');

    if(!empty($result_QuestReply))
    {
        $systemType = $result_QuestReply[0][0];
        $systemName = mb_convert_encoding($systemType, "UTF-8", "BIG5");
        // $systemName = getSystemName($result_QuestReply[0][0]);

        $Quest_note= mb_convert_encoding($result_QuestReply[0][2], "UTF-8", "BIG5");

        $obj = json_decode($result_QuestReply[0][1]);

        $stablize = $obj->{'stablize'};
        $speed = $obj->{'speed'};
        $operate = $obj->{'operate'};
        $program = $obj->{'program'};
        $ability = $obj->{'ability'};
        

        $stablizeReason = $obj->{'stablizeReason'};
        $speedReason = $obj->{'speedReason'};
        $operateReason = $obj->{'operateReason'};
        $programReason = $obj->{'programReason'};
        $abilityReason = $obj->{'abilityReason'};
    }
?>

<script>
    let stablize = "#stablize" + "<?php echo $stablize; ?>";
    let speed = "#speed" + "<?php echo $speed; ?>";
    let operate = "#operate" + "<?php echo $operate; ?>";
    let program = "#program" + "<?php echo $program; ?>";
    let ability = "#ability" + "<?php echo $ability; ?>";

    window.onload = function () {
        start(stablize, speed, operate, program, ability);
        
    }
</script>

<main>

<form action="quest_edit.php" method="post">

    <div class="form-group row m-4">
        <h3><?=$systemName?></h3>

        <input type="hidden" id="systemType" name="systemType" value="<?=$systemType?>" >
        <input type="hidden" id="QuestReply_id" name="QuestReply_id" value="<?=$QuestReply_id?>" >

        <div class="col-md-auto">
            <label class="form-check-label">
                執行穩定度：
            </label>

            <input class="form-check-input" type="radio" name="stablize" id="stablize1" value="1">
            <label class="form-check-label" for="stablize1">
                非常滿意
            </label>

            <input class="form-check-input" type="radio" name="stablize" id="stablize2" value="2" checked>
            <label class="form-check-label" for="stablize2">
                滿意
            </label>

            <input class="form-check-input" type="radio" name="stablize" id="stablize3" value="3">
            <label class="form-check-label" for="stablize3">
                普通
            </label>

            <input class="form-check-input" type="radio" name="stablize" id="stablize4" value="4">
            <label class="form-check-label" for="stablize4">
                不滿意
            </label>

            <input class="form-check-input" type="radio" name="stablize" id="stablize5" value="5">
            <label class="form-check-label" for="stablize5">
                非常不滿意
            </label>

        </div>

    </div>

    <div class="form-group ml-4" id="stablizeReasonDiv" style="display:none">
        <div class="col-8">
            <!-- <input type="hidden" class="form-control" name="stablizeReason" id="stablizeReason" PlaceHolder="不滿意原因" value="<?=$programReason?>"> -->

            <textarea class="form-control content" id="stablizeReason" name="stablizeReason" PlaceHolder="請詳述不滿意的原因"><?=$stablizeReason?></textarea>
        </div>
    </div>

    <div class="form-group row m-4">
        
        <div class="col-md-auto">
            <label class="form-check-label">
                執行速度：
            </label>

            <input class="form-check-input" type="radio" name="speed" id="speed1" value="1">
            <label class="form-check-label" for="speed1">
                非常滿意
            </label>

            <input class="form-check-input" type="radio" name="speed" id="speed2" value="2" checked>
            <label class="form-check-label" for="speed2">
                滿意
            </label>

            <input class="form-check-input" type="radio" name="speed" id="speed3" value="3">
            <label class="form-check-label" for="speed3">
                普通
            </label>

            <input class="form-check-input" type="radio" name="speed" id="speed4" value="4">
            <label class="form-check-label" for="speed4">
                不滿意
            </label>

            <input class="form-check-input" type="radio" name="speed" id="speed5" value="5">
            <label class="form-check-label" for="speed5">
                非常不滿意
            </label>

        </div>
    </div>

    <div class="form-group ml-4" id="speedReasonDiv" style="display:none">
        <div class="col-8">
            <!-- <input type="hidden" class="form-control" name="speedReason" id="speedReason" PlaceHolder="不滿意原因" value="<?=$speedReason?>"> -->

            <textarea class="form-control content" id="speedReason" name="speedReason" PlaceHolder="請詳述不滿意的原因"><?=$speedReason?></textarea>
        </div>
    </div>


    <div class="form-group row m-4">
        
        <div class="col-md-auto">
            <label class="form-check-label">
                系統操作界面：
            </label>

            <input class="form-check-input" type="radio" name="operate" id="operate1" value="1">
            <label class="form-check-label" for="operate1">
                非常滿意
            </label>

            <input class="form-check-input" type="radio" name="operate" id="operate2" value="2" checked>
            <label class="form-check-label" for="operate2">
                滿意
            </label>

            <input class="form-check-input" type="radio" name="operate" id="operate3" value="3">
            <label class="form-check-label" for="operate3">
                普通
            </label>

            <input class="form-check-input" type="radio" name="operate" id="operate4" value="4">
            <label class="form-check-label" for="operate4">
                不滿意
            </label>

            <input class="form-check-input" type="radio" name="operate" id="operate5" value="5">
            <label class="form-check-label" for="operate5">
                非常不滿意
            </label>

        </div>
    </div>

    <div class="form-group ml-4" id="operateReasonDiv" style="display:none">
        <div class="col-8">
            <!-- <input type="hidden" class="form-control" name="operateReason" id="operateReason" PlaceHolder="不滿意原因" value="<?=$operateReason?>"> -->

            <textarea class="form-control content" id="operateReason" name="operateReason" PlaceHolder="請詳述不滿意的原因"><?=$operateReason?></textarea>
        </div>
    </div>

    <div class="form-group row m-4">
        
        <div class="col-md-auto">
            <label class="form-check-label">
                程式功能：
            </label>

            <input class="form-check-input" type="radio" name="program" id="program1" value="1">
            <label class="form-check-label" for="program1">
                非常滿意
            </label>

            <input class="form-check-input" type="radio" name="program" id="program2" value="2" checked>
            <label class="form-check-label" for="program2">
                滿意
            </label>

            <input class="form-check-input" type="radio" name="program" id="program3" value="3">
            <label class="form-check-label" for="program3">
                普通
            </label>

            <input class="form-check-input" type="radio" name="program" id="program4" value="4">
            <label class="form-check-label" for="program4">
                不滿意
            </label>

            <input class="form-check-input" type="radio" name="program" id="program5" value="5">
            <label class="form-check-label" for="program5">
                非常不滿意
            </label>

        </div>
    </div>

    <div class="form-group ml-4" id="programReasonDiv" style="display:none">
        <div class="col-8">
            <!-- <input type="hidden" class="form-control" name="programReason" id="programReason" PlaceHolder="不滿意原因" value="<?=$programReason?>"> -->

            <textarea class="form-control content" id="programReason" name="programReason" PlaceHolder="請詳述不滿意的原因"><?=$programReason?></textarea>
        </div>
    </div>

    <div class="form-group row m-4">
        
        <div class="col-md-auto">
            <label class="form-check-label">
                資訊人員處理能力：
            </label>

            <input class="form-check-input" type="radio" name="ability" id="ability1" value="1">
            <label class="form-check-label" for="ability1">
                非常滿意
            </label>

            <input class="form-check-input" type="radio" name="ability" id="ability2" value="2" checked>
            <label class="form-check-label" for="ability2">
                滿意
            </label>

            <input class="form-check-input" type="radio" name="ability" id="ability3" value="3">
            <label class="form-check-label" for="ability3">
                普通
            </label>

            <input class="form-check-input" type="radio" name="ability" id="ability4" value="4">
            <label class="form-check-label" for="ability4">
                不滿意
            </label>

            <input class="form-check-input" type="radio" name="ability" id="ability5" value="5">
            <label class="form-check-label" for="ability5">
                非常不滿意
            </label>

        </div>
    </div>

    <div class="form-group ml-4" id="abilityReasonDiv" style="display:none">
        <div class="col-8">
            <!-- <input type="hidden" class="form-control" name="abilityReason" id="abilityReason" PlaceHolder="不滿意原因" value="<?=$abilityReason?>"> -->

            <textarea class="form-control content" id="abilityReason" name="abilityReason" PlaceHolder="請詳述不滿意的原因"><?=$abilityReason?></textarea>
        </div>
    </div>

    <div class="form-group row m-4">
        <div class="col-md-auto">
            <label class="form-check-label" for="contentTextarea">
                希望系統改善項目(請列舉說明)：
            </label>

            
        </div>

        <div class="col-md-8">
            <textarea class="form-control content" id="contentTextarea" name="contentTextarea" PlaceHolder="針對目前的系統如有希望改善或加強的功能項目
請提出具體的說明，以便後續訪談。"><?=$Quest_note?></textarea>
        </div>
    </div>

    <div class="form-group row m-2">
        <div class="col-md-auto">
            <button type="button" onclick="history.back()" class="btn btn btn-danger">回上一頁</button>
        </div>

        <div class="col-md-auto">
            
            <button type="submit" class="btn btn btn-primary">確認修改</button>
        </div>
    </div>

</form>

</main>

<?php
    require_once 'footer.php';
?>

