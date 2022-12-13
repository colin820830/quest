<?
function getSystemName($System){    
    switch ($System)
    {
        case "rent":
            return "租賃系統";
            break;

        case "person":
            return "人事系統";
            break;

        default:
            return $System;
            break;
    }
}


function getQuest_content($Quest_content)
{
    $obj = json_decode($Quest_content);

    $stablize = getScore($obj->{'stablize'});
    $speed = getScore($obj->{'speed'});
    $operate = getScore($obj->{'operate'});
    $program = getScore($obj->{'program'});
    $ability = getScore($obj->{'ability'});

    $stablizeReason = $obj->{'stablizeReason'};
    $speedReason = $obj->{'speedReason'};
    $operateReason = $obj->{'operateReason'};
    $programReason = $obj->{'programReason'};
    $abilityReason = $obj->{'abilityReason'};


    $stablizeReason = getReason($stablizeReason, $obj->{'stablize'}, "執行穩定度：");
    $speedReason = getReason($speedReason, $obj->{'speed'}, "執行速度：");
    $operateReason = getReason($operateReason, $obj->{'operate'}, "系統操作界面：");
    $programReason = getReason($programReason, $obj->{'program'}, "程式功能：");
    $abilityReason = getReason($abilityReason, $obj->{'ability'}, "資訊人員處理能力：");
    

    // $result = "執行穩定度： $stablize $stablizeReason <br> 執行速度：$speed $speedReason <br> 系統操作界面：$operate $operateReason <br> 程式功能：$program $programReason <br> 資訊人員處理能力：$ability $abilityReason";

    $result = "$stablizeReason $speedReason $operateReason $programReason $abilityReason";

    return $result;
}

function getScore($score)
{
    switch ($score)
    {
        case "1":
            return "非常滿意";
            break;

        case "2":
            return "滿意";
            break;
        case "3":
            return "普通";
            break;
        case "4":
            return "<font color='red'>不滿意</font>";
            break;
        case "5":
            return "<font color='red'>非常不滿意</font>";
            break;

        default:
            return $score;
            break;
    }
}

function getReason($reason, $score, $name)
{
    if(!empty($reason) && ($score == "4" || $score == "5"))
    {
        $reason = $name.getScore($score)."<br>".$reason."<br>";
    }
    else
    {
        $reason = "";
    }

    return $reason;
}

?>