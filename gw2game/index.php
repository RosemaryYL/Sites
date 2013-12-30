<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <div style="height: 500px;width: 1000px;">
        <div style="float: left;width: 300px">
            <p>选项</p>
            <p><textarea cols="36" rows="25"></textarea></p>
            <p><input id="submit" type="button" value="提交" /></p>
        </div>
        <div style="float: left;margin-left: 20px">
            <p>结果</p>
            <div id="result" style="width: 300px;height: 430px;border: solid 1px;overflow: auto;"></div>
        </div>
        <div style="float: left;margin-left: 20px">
            <p>背包物品</p>
            <div id="bag" style="width: 300px;height: 400px;border: solid 1px"></div>
            <p>总分：<span id="score"></span></p>
        </div>
        </div>
        <div>
            <p>说明</p>
            <p>1.有2个选项的路线，选择第二项，需要在选项后面加-2，比如C-2-3，选择继续追货，需要写C-2-3-2;</p>
            <p>2.第三天C开头的选项，需要在前面加3，比如第三天的C-1，需要写3C-1</p>
        </div>
        <script>
            $("#submit").click(function(event) {

                var choose = $("textarea").val();
                var url = '/gw2game/api.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {choose: choose},
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var str = data.content;
                        if (data.code > 0) {
                            str += '<span style="color:red;">'+data.result+'</span>'
                        }
                        $("#result").html(str);
                        $("#bag").html(data.bags);
                        $("#score").html(data.score);
                    },
                });
            });
        </script>
    </body>
</html>
