<?php  
    $id=$_GET['id'];
    $redis=new Redis;
    $pdo=new pdo("mysql:host=127.0.0.1;dbname=else","root","root");
    $redis->connect('127.0.0.1',6379);
    $redis->select(2);
    //队列是否有库存，减少库存，生成订单
    if ($redis->llen('good'.$id)>0) 
    {
        if ($redis->lpop('good'.$id)) 
        {
            $dsql="update tp_good set stock=stock-1 where id=$id";
            $order_id=time().$id;
            $now=time();
            $asql="insert into tp_order (order_id,goods_id,addtime) value('$order_id','$id','$now')";
            if ($pdo->exec($dsql)) 
            {
                $pdo->exec($asql);
                echo "秒杀成功";
            }
        }
    }
    else
    {
        echo "秒杀结束";
    }