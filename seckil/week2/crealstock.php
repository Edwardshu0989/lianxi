<?php  
    $redis=new Redis;
    $redis->connect('127.0.0.1',6379);
    $redis->select(2);
    $pdo=new pdo("mysql:host=127.0.0.1;dbname=else","root","root");
    $data=$pdo->query("select id,stock from tp_good")->fetchAll(PDO::FETCH_ASSOC);
    //把商品库存放入队列
    foreach ($data as $key => $value) 
    {
        for ($i=1; $i <$value['stock'] ; $i++) 
        { 
            $redis->lpush('good'.$i,$i);
        }
    }