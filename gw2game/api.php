<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'config.php';

$choose = $_POST['choose'];
$choose = str_replace('选项', '', $choose);
$route = explode("\n", $choose);
//var_dump($route);
$total = count($route);
if ($total > 25) {
    result(1, $str);
}
$user = array(
    'money' => 0,
    'score' => 0,
    '+score' => 0,
    '-score' => 0,
    'item' => array(),
    'mission' => array(),
    'end_mission' => array(),
    'step' => array(),
);
$count = 0;
$str = '';
foreach ($route as $step) {
    if (!$config_step[$step]) {
        result(2, $str);
    }
    $current_step = $config_step[$step];
    $count++;
    $str .= sprintf('<p title="%s">第%d步，选项%s，%s', $current_step['description'], $count, $step, $current_step['title']);
    if ($current_step['need']['item']) {
        foreach ($current_step['need']['item'] as $_need_item) {
            if (!in_array($_need_item, $user['item'])) {
                result(3, $str, $_need_item);
            }
        }
    }
    if ($current_step['need']['itemOR']) {
        $need_or = false;
        foreach ($current_step['need']['itemOR'] as $_need_item_or) {
            if (in_array($_need_item_or, $user['item'])) {
                $need_or = true;
                break;
            }
        }
        if (!$need_or) {
            result(3, $str, implode(',', $current_step['need']['itemOR']));
        }
    }
    if ($current_step['need']['step']) {
        foreach ($current_step['need']['step'] as $_need_step) {
            if (!in_array($_need_step, $user['step'])) {
                result(4, $str, $_need_step);
            }
        }
    }
    if ($current_step['money']) {
        $user['money'] += $current_step['money'];
        $str .= (string) $current_step['money'] . "铜币,";
        if ($user['money' < 0]) {
            result(5, $str);
        }
    }

    if ($current_step['score']) {
        $user['score'] += $current_step['score'];
        $str .= '加' . (string) $current_step['score'] . "分,";
    }

    if ($current_step['fixscore'] > 0) {
        $user['+score'] += 1;
        $str .= "秩序分,";
    }

    if ($current_step['fixscore'] < 0) {
        $user['-score'] += 1;
        $str .= "混乱分,";
    }

    if ($current_step['unset_step']) {
        unset($config_step[$current_step['unset_step']]);
    }

    if ($current_step['item']) {
        if (!is_array($current_step['item'])) {
            $current_step['item'] = array($current_step['item']);
        }
        $user['item'] = array_merge($user['item'], $current_step['item']);
    }

    if ($current_step['mission']) {
        $user['mission'] = array_merge($user['mission'], array($current_step['mission']));
        $str .= "任务" . $current_step['mission'] . "开始,";
    }

    if ($current_step['end_mission']) {
        if (!is_array($current_step['end_mission'])) {
            $current_step['end_mission'] = array($current_step['end_mission']);
        }
        $user['end_mission'] = array_merge($user['end_mission'], $current_step['end_mission']);
        $str .= "任务" . $current_step['mission'][0] . "结束,";
    }
    $str .= '</p>';
    $user['step'][] = $step;
}

result(0, $str);

function result($code, $content, $ext = '')
{
    global $user, $config_mission, $config_score_item;
    $total_score = count_total_score($user, $config_mission, $config_score_item);
    $error = array(
        1 => '总步数超过25步',
        2 => '不存在这个选项',
        3 => '缺少必须物品',
        4 => '缺少必须步骤',
        5 => '缺少铜币'
    );
    if ($code > 0) {
        $result = $error[$code] . $ext;
    }
    $bags = '';
    foreach ($user as $_k => $_v) {
        $bags .= sprintf('<p>%s：%s</p>', $_k, is_array($_v) ? implode(',', $_v) : $_v);
    }
    echo json_encode(array('code' => $code, 'content' => $content, 'result' => $result, 'bags' => $bags, 'score' => $total_score, 'user' => $user));
    exit();
}

function count_total_score($user, $config_mission, $config_score_item)
{
    $total_score = $user['score'];
    if (in_array('X-3', $user['step'])) {
        $total_score += $user['+score'] * 10;
    } else if (in_array('X-2', $user['step'])) {
        $total_score += $user['-score'] * 10;
    }
    foreach ($user['mission'] as $_mission) {
        if (in_array($_mission, $user['end_mission'])) {
            $total_score += (int) $config_mission[$_mission];
        }
    }
    foreach ($config_score_item as $_item) {
        if (in_array($_item, $user['item'])) {
            $total_score += 10;
        }
    }
    return $total_score;
}
