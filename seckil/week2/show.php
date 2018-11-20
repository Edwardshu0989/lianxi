<?php  
    $pdo=new pdo("mysql:host=127.0.0.1;dbname=else","root","root");
    $data=$pdo->query("select id,name,price,path,stock from tp_good")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="jquery-3.2.1.min.js"></script>
</head>
<body>
    <?php foreach ($data as $key => $value) { ?>
        <div style="float: left;">
            <p>
                <span id="<?php echo 's'.$value['id']; ?>">时分秒</span>
            </p>
            <img src="<?php echo $value['path']; ?>" alt=""><br>
            商品名称 <?php echo $value['name']; ?><br>
            商品价格 <?php echo $value['price']; ?><br>
            商品库存 <?php echo $value['stock']; ?><br>
            <input type="button" value="抢购" id="<?php echo $value['id']; ?>">
        </div>
    <?php }  ?>
    
</body>
</html>
<script>
    $(document).ready(function(){
        window.setInterval(function()
        {
            $.ajax({
                url:'dealtime.php',
                type:'get',
                dataType:'json',
                success:function(data)
                {
                    for (var i = 0; i < data.length; i++) 
                    {
                        $("#s"+data[i]['id']+"").text(data[i]['hour']+"时"+data[i]['minute']+"分"+data[i]['second']+"秒");
                    }
                }
            })
        })
        $("input[type=button]").click(function(){
            var id=$(this).attr('id');
            $.ajax({
                url:'seckil.php',
                type:'get',
                data:{id:id},
                success:function(data)
                {
                    alert(data);
                }
            })
        })
    })
</script>
