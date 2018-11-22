<?php  
    $slices=$_FILES['slices'];
    $num=$_POST['num'];
    $sum=$_POST['sum'];
    $name=$_POST['name'];
    $blob=$slices['tmp_name'];
    $filename='./images/no_'.$num;
    move_uploaded_file($blob ,$filename);
    if ($num==$sum) 
    {
        $str='';
        for ($i=1; $i <=$sum ; $i++)
         { 
            $filename='./images/no_'.$i;
           $str.=file_get_contents($filename);
        }
        file_put_contents('./images/'.$name, $str);
    }
    //     <br />
// <b>Notice</b>:  Undefined index: slices in <b>F:\long\lvliu.com\tp19\compound.php</b> on line <b>2</b><br />
// 1214