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
            <p><textarea cols="36" rows="25">选项2	小茅屋老人
选项2-2	带壁炉上的小刀
选项4	杉树林
选项4-1	帝蜘蛛
选项4-2	蘑菇
选项4-3	精灵
选项4-5	进入流水小巷
选项W-1	拉普拉斯
选项W-2	狱卒的餐盘
选项W-4	典狱长
选项W-5	森林精灵欧拉
选项W-7	拉普拉斯的房间进入圣城
选项A-1-2	悠闲的雷纳德带走小鱼
选项D-1	伊萨拉爵士
选项D-2	艾维拉爵士
选项E-1	阴影拿出毒液
选项F-1-2	卡珊德拉昏迷
选项F-3	斯特拉
选项B-1	白袍达文西
选项B-2	克拉苏斯的房间
选项X-1-2	杀死尤利西斯
选项X-2	贡献鲜血</textarea></p>
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
            <p>3.提交项目会自动过滤其中非字母、数字、'-'的文字和符号，以及空行</p>
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
