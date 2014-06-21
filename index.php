<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

  <meta charset="utf-8">
 </head>

 <body class="docs ">
 	<table class="pve center table" style="width:auto">
<tbody>
	<tr style="vertical-align:bottom;">
	<th> cnname </th> <th> name</th><th> pic </th><th> map </th><th>way_point</th><th>code</th>
	</tr>
	<?php
		require_once("config.php");
		$config_map = array(
			'Black Citadel' => '',
			'Blazeridge Steppes' => '',
			'Bloodtide Coast' => '',
			'Brisban Wildlands' => '',
			'Caledon Forest' => '',
			'Cursed Shore' => '',
			'Diessa Plateau' => '',
			'Divinity\'s Reach' => '',
			'Dredgehaunt Cliffs' => '',
			'Fields of Ruin' => '',
			'Fireheart Rise' => '',
			'Frostgorge Sound' => '',
			'Gendarran Fields' => '',
			'Harathi Hinterlands' => '',
			'Hoelbrak' => '',
			'Iron Marches' => '',
			'Kessex Hills' => '',
			'Lornar\'s Pass' => '',
			'Malchor\'s Leap' => '',
			'Metrica Province' => '',
			'Mount Maelstrom' => '',
			'Plains of Ashford' => '',
			'Queensdale' => '',
			'Rata Sum' => '',
			'Snowden Drifts' => '',
			'Southsun Cove' => '',
			'Sparkfly Fen' => '',
			'Straits of Devastation' => '',
			'The Grove' => '',
			'Timberline Falls' => '',
			'Wayfarer Foothills' => ''
		);
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
		<td><?=$row['cnname'];?></td><td><?=$row['name'];?></td><td><img width="360px" src="http://106.186.18.29/img/<?=$row['pic_url'];?>"></td><td><?=$row['map'];?></td><td><?=$row['way_point'];?></td><td><?=$row['code'];?></td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>
 </body>
 </html>