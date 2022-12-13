<?php
    $today = date('Y-m-d-H-i-s');
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=問卷調查" . $today .".xls");

    require_once 'adodb.inc.php';
    require_once 'adodb-exceptions.inc.php';
    require_once 'database.php';   //資料庫class
    require_once 'config_inc.php';
    require_once 'startsession.php';
    require_once 'Id_chk.php';
    require_once 'change_txt.php';

    error_reporting(E_ALL);
    ini_set('display_errors', false);
    ini_set('html_errors', false);	


    $systemType = isset($_REQUEST["systemType"])? $_REQUEST["systemType"] : "";

    $systemType = iconv("UTF-8", "big5", $systemType);

    $DepartmentType = isset($_REQUEST["DepartmentType"])? $_REQUEST["DepartmentType"] : "";

    $DepartmentType = iconv("UTF-8", "big5", $DepartmentType);


    $where_QuestReply =' where IS_DELETE = \'N\' and QuestType is null ';
    

    if(!empty($systemType))
    {
        $where_QuestReply.='  and systemtype = \''. $systemType .'\' ';
    }

    if(!empty($DepartmentType))
    {
        $where_QuestReply.='  and Department = \''. $DepartmentType .'\' ';
    }

    //建立yyc3資料庫連線
    $db = new Database('oracle', DB_HT_3, '1521',DB_SD_3);
    $db->initDB(DB_UR_3, DB_PD_3);

    $result_QuestReply = $db->selStmt('DBASRM.QuestReply', 'systemtype, Quest_content, Quest_note, id, QuestMain_id,  Department', $where_QuestReply, 'order by systemtype desc, QuestMain_id');


    $where =' where IS_DELETE = \'N\'';

    $result = $db->selStmt('DBASRM.QuestMain', 'id, username, windowName', $where, '');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Colin" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow" />
        <meta name="rating" content="General" />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
        <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />

    </head>

    <body>

        <table border="1">
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
                </tr>
            </thead>
            <tbody>
                <?
                    if(!empty($result_QuestReply))
                    {
                        for($j = 0; $j < count($result_QuestReply); $j++) 
                        {
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

                            echo '</tr>';		
                        }
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>