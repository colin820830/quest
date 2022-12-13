<?php

    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'header.php';
    require_once 'Id_chk.php';
    require_once 'change_txt.php';

    $name= mb_convert_encoding($_SESSION['oname'], "UTF-8", "BIG5");

    $userid = $_SESSION['userid'];

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $where_QuestMain =' where IS_DELETE = \'N\' and user_id = \''. trim($_SESSION['userid']) .'\'';		

    $result_QuestMain = $db->selStmt('DBASRM.QuestMain', 'id, user_id, department', $where_QuestMain, '');

    $department = mb_convert_encoding($result_QuestMain[0][2], "UTF-8", "BIG5");

    $id = $result_QuestMain[0][0];

    $where_QuestReply =' where IS_DELETE = \'N\' and QuestMain_id = \''. $id .'\'';	

    //$where_QuestReply =' where IS_DELETE = \'N\' and department = \''. $result_QuestMain[0][2] .'\'';	

    $result_QuestReply = $db->selStmt('DBASRM.QuestReply', 'systemtype, Quest_content, Quest_note, id, QuestMain_id', $where_QuestReply, 'order by Update_DT desc');


    $where =' where IS_DELETE = \'N\' and department = \''. $result_QuestMain[0][2] .'\'';	
    

    $result = $db->selStmt('DBASRM.QuestMain', 'id, username', $where, '');
?>

<script>

    function Show()
    {
        if (confirm("Press a button!")) {
            return true;
        } else {
            return false;
        }
    }

</script>

<main>


<form action="quest_write.php" method="post">
    <div class="form-group row m-3">
        <h3>Hi~ <?=$department?> <?=$name?></h3>
        <h3>歡迎使用 企業內系統使用情形調查</h3>

        <div class="col-md-auto">
            <label for="systemType" class="fz-20">請選擇欲填寫問卷的系統:</label>
        </div>

        <div class="col-md-3">
            <select id="systemType" name="systemType" class="form-select" required>
                <!-- <option value="rent" selected>租賃系統</option>
                <option value="person">人事系統</option> -->

                <option value="">--請選擇系統--</option>
                <option value="AS400 - 租賃系統">AS400 - 租賃系統</option>
                <option value="AS400 - 人事系統">AS400 - 人事系統</option>
                <option value="AS400 - 薪資系統">AS400 - 薪資系統</option>
                <option value="AS400 - 授信系統">AS400 - 授信系統</option>
                <option value="AS400 - 營業系統">AS400 - 營業系統</option>
                <option value="AS400 - 財務系統">AS400 - 財務系統</option>
                <option value="AS400 - 會計系統">AS400 - 會計系統</option>
                <option value="AS400 - 貿易系統">AS400 - 貿易系統</option>
                <option value="AS400 - 固定資產系統">AS400 - 固定資產系統</option>
                <option value="AS400 - 保代系統">AS400 - 保代系統</option>
                <option value="AS400 - 預算系統">AS400 - 預算系統</option>
                <option value="AS400 - 績效系統">AS400 - 績效系統</option>
                <option value="AS400 - 零件系統">AS400 - 零件系統</option>
                <option value="AS400 - 重工系統">AS400 - 重工系統</option>
                <option value="AS400 - 石油系統">AS400 - 石油系統</option>
                <option value="AS400 - 技師考核系統">AS400 - 技師考核系統</option>

                <option value="PB - DMS服務廠系統">PB - DMS服務廠系統</option>
                <option value="PB - MB服務廠系統">PB - MB服務廠系統</option>

                <option value="WEB - 保代系統">WEB - 保代系統</option>
                <option value="WEB - 租賃系統">WEB - 租賃系統</option>
                <option value="WEB - 資產預約">WEB - 資產預約</option>
                <option value="WEB - 人事考核系統">WEB - 人事考核系統</option>
                <option value="WEB - 扣繳憑單及保費證明查詢">WEB - 扣繳憑單及保費證明查詢</option>
                <option value="WEB - 紅利點數評核系統">WEB - 紅利點數評核系統</option>
                <option value="WEB - 應付帳款查詢平台">WEB - 應付帳款查詢平台</option>
                <option value="WEB - 裕益服務廠查詢系統">WEB - 裕益服務廠查詢系統</option>
                <option value="WEB - 石油部訂貨與庫存系統">WEB - 石油部訂貨與庫存系統</option>
                <option value="WEB - 裕益零件物流系統(YWP)">WEB - 裕益零件物流系統(YWP)</option>
                <option value="WEB - 資訊需求單系統">WEB - 資訊需求單系統</option>
                <!-- <option value="WEB - 順工供應鏈系統(SCMGS)">WEB - 順工供應鏈系統(SCMGS)</option> -->
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn btn-primary">新增</button>
        </div>
    </div>

</form>
<br>

<div class="form-group row m-3">
    <label for="systemType" class="fz-20">目前已填寫的問卷:</label>
</div>

<div class="table-responsive m-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">系統名稱</th>
                <th scope="col">填單者</th>
                <!-- <th scope="col">填寫內容</th>
                <th scope="col">改善舉例說明</th> -->
                <th scope="col">功能</th>
                <th scope="col"></th>
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

                        // $Quest_note = mb_convert_encoding($result_QuestReply[$j][2], "UTF-8", "BIG5");

                        // $obj = json_decode($result_QuestReply[$j][1]);
                        
                        // $Score = getQuest_content($result_QuestReply[$j][1]);

                        $QuestMain_id = $result_QuestReply[$j][4];

                        $username = '';

                        for($i = 0; $i < count($result); $i++)
                        {
                            if($QuestMain_id == $result[$i][0])
                            {
                                $username = $result[$i][1];

                                $username = mb_convert_encoding($username, "UTF-8", "BIG5");
                            }
                        }

                        echo '<tr>';
                        echo '<td>'.$systemName .'</td>';
                        echo '<td>'.$username .'</td>';	
                        // echo '<td>'.$Score .'</td>';	
                        // echo '<td>'.$Quest_note .'</td>';

                        echo '<td>
                                <a href="quest_detailView.php?id='. $result_QuestReply[$j][3] .'">查看</a>
                              </td>';

                        if($QuestMain_id == $id)
                        {
                            echo '<td>
                                    <a href="quest_editView.php?id='. $result_QuestReply[$j][3] .'">修改</a>
                                </td>';
                            echo '<td>
                                <a href="quest_del.php?id='. $result_QuestReply[$j][3] .'" onclick="return confirm(\'確認刪除該筆問卷?\')">刪除</a>
                                </td>';
                        }
                        else
                        {
                            echo '<td></td>';
                            echo '<td></td>';
                        }
                        echo '</tr>';		
                    }
                }
            ?>
        </tbody>
    </table>
</div>


</main>

<?php
    require_once 'footer.php';
?>