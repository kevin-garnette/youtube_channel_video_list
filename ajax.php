<?php
require_once "config.php";

$url = "https://www.googleapis.com/youtube/v3/search?channelId=". $_GET['channel'] ."&order=date&part=snippet&type=video&maxResults=". $_GET['max_result'] ."&pageToken=". $_GET['nextPageToken'] ."&key=". DEVELOPER_KEY;

$arr_list = getYTList($url);

$arr_result = array();
if (!empty($arr_list)) {
    foreach ($arr_list->items as $yt) {
        array_push($arr_result, ['title' => $yt->snippet->title, 'id' => $yt->id->videoId]);
    }
    if (isset($arr_list->nextPageToken)) {
        array_push($arr_result, ['nextPageToken' => $arr_list->nextPageToken]);
    }
}

echo json_encode($arr_result);