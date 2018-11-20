<?php  
    $pdo=new pdo("mysql:host=127.0.0.1;dbname=else","root","root");
    $data=$pdo->query("select id,starttime from tp_good")->fetchAll(PDO::FETCH_ASSOC);
    //计算距离抢购活动开始的时分秒
    foreach ($data as $key => $value) 
    {
        $now=time();
        $starttime=$value['starttime'];
        $sum=$starttime-$now;
        $hour=floor($sum/3600);
        $minute=floor(($sum-$hour*3600)/60);
        $second=$sum-$hour*3600-$minute*60;

        $attr[$key]['id']=$value['id'];
        $attr[$key]['hour']=$hour;
        $attr[$key]['minute']=$minute;
        $attr[$key]['second']=$second;
    }
    echo json_encode($attr);