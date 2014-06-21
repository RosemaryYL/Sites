<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

  <meta charset="utf-8">
 </head>

 <body class="docs ">
 	<table class="pve center table" style="width:auto">
<tbody>
	<?php
		$config_map = array(
			'Black Citadel' => '黑烟壁垒',
			'Blazeridge Steppes' => '裂脊山脉',
			'Bloodtide Coast' => '血潮海岸',
			'Brisban Wildlands' => '布里斯班野地',
			'Caledon Forest' => '卡勒顿之森',
			'Cursed Shore' => '诅咒海岸',
			'Diessa Plateau' => '底耶沙高地',
			'Divinity\'s Reach' => '神佑之城',
			'Dredgehaunt Cliffs' => '掘洞悬崖',
			'Fields of Ruin' => '废墟原野',
			'Fireheart Rise' => '炎心高地',
			'Frostgorge Sound' => '霜谷之音',
			'Gendarran Fields' => '甘达拉战区',
			'Harathi Hinterlands' => '哈希拉腹地',
			'Hoelbrak' => '霍布雷克',
			'Iron Marches' => '钢铁平原',
			'Kessex Hills' => '凯西斯山',
			'Lornar\'s Pass' => '罗纳通道',
			'Malchor\'s Leap' => '马尔科之跃',
			'Metrica Province' => '度量领域',
			'Mount Maelstrom' => '旋涡山',
			'Plains of Ashford' => '阿什福德平原',
			'Queensdale' => '女王谷',
			'Rata Sum' => '拉塔索姆',
			'Snowden Drifts' => '漂流雪径',
			'Southsun Cove' => '南阳海湾',
			'Sparkfly Fen' => '闪萤沼泽',
			'Straits of Devastation' => '浩劫海峡',
			'The Grove' => '圣林之地',
			'Timberline Falls' => '林线瀑布',
			'Wayfarer Foothills' => '旅者丘陵'
		);
		foreach ($config_map as $key => $value) {
			echo '<a href="/?map='.urlencode($key).'">'.$value.'</a><br>';
		}
	?>
	<tr style="vertical-align:bottom;">
	<th> cname </th> <th> name</th><th> 图片 </th><th> 地图名称 </th><th>中文名称</th><th>传送点代码</th>
	</tr>
	<?php
		require_once("config.php");

		if (isset($_GET['map'])) {
			$maps = explode(',', $_GET['map']);
		} else {
			$maps = array();
		}
		$arrRows = $config;
		$i = 0;
		foreach ($arrRows as $row) {
			if ($maps && !in_array($row['map'], $maps)) {
				continue;
			}
			$i++;
			if ($i%2 == 0) {
				$style = ' style="background-color: #fff8e8;"';
			} else {
				$style = '';
			}
	?>
	<tr<?=$style;?>>
		<td><?=$row['cnname'];?></td><td><?=$row['name'];?></td><td><img width="360px" src="http://106.186.18.29/img/<?=$row['pic_url'];?>"></td><td><?=$row['map'];?></td><td><?=$config_map[$row['map']];?></td><td><?=$row['code'];?></td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>
 </body>
 </html>