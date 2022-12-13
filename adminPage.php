<?php

    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'Id_chk.php';
    require_once 'change_txt.php';

    $systemType = isset($_REQUEST["systemType"])? $_REQUEST["systemType"] : "";

    $systemType_original = $systemType;

    //$systemType = iconv("UTF-8", "big5", $systemType);

    $systemType = mb_convert_encoding($systemType, "BIG5", "UTF-8");

    $DepartmentType = isset($_REQUEST["DepartmentType"])? $_REQUEST["DepartmentType"] : "";

    $DepartmentType_original = $DepartmentType;

    //$DepartmentType = iconv("UTF-8", "big5", $DepartmentType);

    $DepartmentType = mb_convert_encoding($DepartmentType, "BIG5", "UTF-8");

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $where_QuestMain =' where IS_DELETE = \'N\' and user_id = \''. trim($_SESSION['userid']) .'\'';		

    $result_QuestMain = $db->selStmt('DBASRM.QuestMain', 'id, user_id, department', $where_QuestMain, '');

    $department = mb_convert_encoding($result_QuestMain[0][2], "UTF-8", "BIG5");

    $id = $result_QuestMain[0][0];

    $where_QuestReply =' where IS_DELETE = \'N\' and QuestType is null ';
    

    if(!empty($systemType))
    {
        $where_QuestReply.='  and systemtype = \''. $systemType .'\' ';
    }

    if(!empty($DepartmentType))
    {
        $where_QuestReply.='  and Department = \''. $DepartmentType .'\' ';
    }


    $result_QuestReply = $db->selStmt('DBASRM.QuestReply', 'systemtype, Quest_content, Quest_note, id, QuestMain_id,  Department', $where_QuestReply, 'order by systemtype desc, QuestMain_id');

    
    $where =' where IS_DELETE = \'N\'';

    $result = $db->selStmt('DBASRM.QuestMain', 'id, username, windowName', $where, '');

    $where_Select = ' where IS_DELETE = \'N\' and QuestType is null ';

    $result_Select = $db->selStmt('DBASRM.QuestReply', 'systemtype', $where_Select, 'group by systemtype');

    $where_Select_Department = ' where IS_DELETE = \'N\' and QuestType is null and Department is not null';

    $result_Select_Department = $db->selStmt('DBASRM.QuestReply', 'Department', $where_Select_Department, 'group by Department');
?>

<main>

<form action="adminPage.php" method="post">

    <div class="form-group row m-3">
        <h3>問卷一覽</h3>
    </div>

    <div class="form-group row m-3">

        <div class="col-md-auto">
            <label for="systemType" class="fz-20">請選擇欲分類的系統:</label>
        </div>

        <div class="col-md-3">
            <select id="systemType" name="systemType" class="form-select">
                <option value="">--請選擇系統--</option>
                <?
                   for($j = 0; $j < count($result_Select); $j++) 
                   {
                        $selectName = mb_convert_encoding($result_Select[$j][0], "UTF-8", "BIG5");

                        if($result_Select[$j][0] == $systemType)
                        {
                            echo "<option value='$selectName' selected='selected'>$selectName</option>";
                        }
                        else
                        {
                            echo "<option value='$selectName'>$selectName</option>";
                        }
                   }
                ?>
            </select>
        </div>

        
    </div>

    <div class="form-group row m-3">

        <div class="col-md-auto">
            <label for="DepartmentType" class="fz-20">請選擇欲分類的部門:</label>
        </div>

        <div class="col-md-3">
            <select id="DepartmentType" name="DepartmentType" class="form-select">
                <option value="">--請選擇部門--</option>
                <?
                   for($j = 0; $j < count($result_Select_Department); $j++) 
                   {
                        $selectDepartment = mb_convert_encoding($result_Select_Department[$j][0], "UTF-8", "BIG5");

                        if($result_Select_Department[$j][0] == $DepartmentType)
                        {
                            echo "<option value='$selectDepartment' selected='selected'>$selectDepartment</option>";
                        }
                        else
                        {
                            echo "<option value='$selectDepartment'>$selectDepartment</option>";
                        }
                   }
                ?>
            </select>
        </div>

        <div class="col-md-auto">
            <button type="submit" class="btn btn btn-primary">查詢</button>
            
        </div>

        <div class="col-md-auto">
            <button type="button" class="btn btn btn-success" onclick= "download_excel()" >下載 excel</button>
        </div>
    </div>
</form>
<br>

<div class="form-group row m-3">
    <label for="systemType" class="fz-20">目前已填寫的問卷:</label>
    <label class="fz-20">數量:<?=count($result_QuestReply)?></label>
</div>


<div class="table-responsive m-3">
    <table class="table table-hover tablesorter" id="myTable">
        <thead>
            <tr>
                <th scope="col">系統名稱</th>
                <th scope="col" width="5%">填單者</th>
                <th scope="col" width="7%">部門</th>
                <th scope="col" width="7%">聯繫窗口</th>
                <th scope="col" width="5%">執行穩定度</th>
                <th scope="col" width="5%">執行速度</th>
                <th scope="col" width="5%">系統操作界面</th>
                <th scope="col" width="5%">程式功能</th>
                <th scope="col" width="5%">資訊人員處理能力</th>
                <th scope="col">填寫內容</th>
                <!-- <th scope="col">改善舉例說明</th> -->
                <th scope="col">功能</th>
            </tr>
        </thead>
        <tbody>
            <?
                if(!empty($result_QuestReply))
                {
                    for($j = 0; $j < count($result_QuestReply); $j++) 
                    {
                        // $systemName = getSystemName($result_QuestReply[$j][0]);
                        $systemName = mb_convert_encoding($result_QuestReply[$j][0], "UTF-8", "BIG5");

                        $department = mb_convert_encoding($result_QuestReply[$j][5], "UTF-8", "BIG5");
                        $Quest_note = mb_convert_encoding($result_QuestReply[$j][2], "UTF-8", "BIG5");

                        $obj = json_decode($result_QuestReply[$j][1]);

                        $stablize = getScore($obj->{'stablize'});
                        $speed = getScore($obj->{'speed'});
                        $operate = getScore($obj->{'operate'});
                        $program = getScore($obj->{'program'});
                        $ability = getScore($obj->{'ability'});
                        
                        $Score = getQuest_content($result_QuestReply[$j][1]);

                        $Score = $Score."改善舉例說明: $Quest_note";

                        $QuestMain_id = $result_QuestReply[$j][4];

                        $username = '';

                        $windowname = '';

                        for($i = 0; $i < count($result); $i++)
                        {
                            if($QuestMain_id == $result[$i][0])
                            {

                                $username = mb_convert_encoding($result[$i][1], "UTF-8", "BIG5");

                                $windowname = mb_convert_encoding($result[$i][2], "UTF-8", "BIG5");
                            }
                        }

                        echo '<tr>';
                        echo '<td>'.$systemName .'</td>';
                        echo '<td>'.$username .'</td>';	
                        echo '<td>'.$department .'</td>';	
                        echo '<td>'.$windowname .'</td>';	
                        echo '<td>'.$stablize .'</td>';	
                        echo '<td>'.$speed .'</td>';	
                        echo '<td>'.$operate .'</td>';	
                        echo '<td>'.$program .'</td>';	
                        echo '<td>'.$ability .'</td>';	
                        echo '<td>'.$Score .'</td>';	
                        // echo '<td>'.$Quest_note .'</td>';

                        if(!empty($systemType))
                        {
                            echo '<td>
                            <a href="quest_detailView.php?id='. $result_QuestReply[$j][3] .'&isSearch=Y">查看</a>
                             </td>';
                        }
                        else
                        {
                        echo '<td>
                                <a href="quest_detailView.php?id='. $result_QuestReply[$j][3] .'">查看</a>
                              </td>';
                        }

                        echo '</tr>';		
                    }
                }
            ?>
        </tbody>
    </table>
</div>


</main>

<script>
    $(function() {
    $("#myTable").tablesorter();
    });

    function download_excel()
    {

        var systemType = "<?php echo $systemType_original ?>";

        var DepartmentType = "<?php echo $DepartmentType_original ?>";

        
        window.location = "quest_excel.php?systemType=" + systemType + "&DepartmentType=" + DepartmentType; //原視窗開啟

    }  
</script>

<?php
    require_once 'footer.php';
?>