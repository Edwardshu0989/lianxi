<?php 
    $city=$_POST['city'];
    function curls($city)
    {
        $url="https://free-api.heweather.com/s6/weather/forecast?location=$city&key=1d7b1ea1af8643de8540fa2ca9e975ff";
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data=curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    $redis=new Redis;
    $redis->connect('127.0.0.1',6379);
    $res=$redis->exists($city);
    if (!$res) 
    {
        $str=curls($city);
        $data=json_decode($str,true);
        $data=$data['HeWeather6'][0]['daily_forecast'];
        $pdo=new PDO('mysql:host=127.0.0.1;dbname=else',"root","root");
        foreach ($data as $key => $value) 
        {
            $pdo->exec("insert into tp_weather (date_ci,tmp_min,tmp_max) value('".$value['date']."',".$value['tmp_min'].",".$value['tmp_max'].")");
        }
         // $redis->set($city,$str);
        $das=array_column($data,'date');
          $temp_max=array_column($data,'tmp_max');
          $temp_min=array_column($data,'tmp_min');
          foreach ($data as $key => $value) 
          {
              $skj[$key][]=floatval($value['tmp_min']);
              $skj[$key][]=floatval($value['tmp_max']);
          }
          foreach ($das as $key => $value) 
          {
              $attr[]="$value";
          }
          $attrs=$attr;
         $result =array('wea'=>$attrs,'temp'=>$skj);
         echo json_encode($result);
    }
    else
    {
          $str=$redis->get($city);
          $data=json_decode($str,true);
          $data=$data['HeWeather6'][0]['daily_forecast'];
          $das=array_column($data,'date');
          $temp_max=array_column($data,'tmp_max');
          $temp_min=array_column($data,'tmp_min');
          foreach ($data as $key => $value) 
          {
              $skj[$key][]=floatval($value['tmp_min']);
              $skj[$key][]=floatval($value['tmp_max']);
          }
          foreach ($das as $key => $value) 
          {
              $attr[]="$value";
          }
          $attrs=$attr;
         $result =array('wea'=>$attrs,'temp'=>$skj);
         echo json_encode($result);
        // echo $str;
    }
    