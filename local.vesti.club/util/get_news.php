<?php

//по возрастанию
function sort_by_time($a, $b) {
    if ($a['pubDate'] == $b['pubDate']) {
        return 0;
    }
    return ($a['pubDate'] < $b['pubDate']) ? -1 : 1;
}

//по убыванию
function sort_by_time_rev($a, $b) {
    if ($a['pubDate'] == $b['pubDate']) {
        return 0;
    }
    return ($a['pubDate'] > $b['pubDate']) ? -1 : 1;
}

require_once 'categories.php';

$output_array = [];
$last_array = [];

$data = file_get_contents('http://www.vesti.ru/vesti.rss');

$news = new SimpleXMLElement($data);

$news_descr = $news->xpath('//yandex:full-text');

$i = 0;
foreach ($news->channel->item as $item) {
    if (array_search($item->category, $categories)) {
        $pos = strrpos($item->link, 'id=') + 3;
        $news_item = [
            'id' => substr($item->link, $pos, strlen($item->link) - $pos),
            'title' => (string)$item->title,
            'description' => (string)$item->description,
            'pubDate' => strtotime((string)$item->pubDate),
            'category' => (string)$item->category,
            'img' => isset($item->enclosure[0]) ? (string)$item->enclosure[0]->attributes()['url'] : NULL,
            'video' => isset($item->enclosure[1]) ? (string)$item->enclosure[1]->attributes()['url'] : NULL,
            'text' => (string)$news_descr[$i][0]
        ];
        $output_array[array_search($item->category, $categories)][] = $news_item;
        $last_array[] = $news_item;
    }

    $i++;
}

foreach ($output_array as $category=>$items) {
    $json_string = @file_get_contents("$category.json");
    $data_json_output = $json_string !== false ? json_decode($json_string, true) : [];

    if (array_column($data_json_output, 'id') === []) {
        foreach ($items as $item) {
            $data_json_output[] = $item;
        }
    }
    else {
        foreach ($items as $item) {
            if (array_search($item['id'], array_column($data_json_output, 'id')) === false) {
                $data_json_output[] = $item;
            }
        }

    }
    usort($data_json_output, 'sort_by_time_rev');
    $file = fopen(__DIR__ . "/$category.json", "w");
    fwrite($file, json_encode($data_json_output, JSON_PRETTY_PRINT));
    fclose($file);
}

usort($last_array, 'sort_by_time');
$json_string = @file_get_contents("last_news.json");
$data_json_output = $json_string !== false ? json_decode($json_string, true) : [];
if (array_column($data_json_output, 'id') === []) {
    foreach ($last_array as $item) {
        array_unshift($data_json_output, $item);
    }
}
else {
    foreach ($last_array as $item) {
        if (array_search($item['id'], array_column($data_json_output, 'id')) === false) {
            array_unshift($data_json_output, $item);
        }
    }

}

$file = fopen(__DIR__."/last_news.json", "w");
fwrite($file, json_encode($data_json_output, JSON_PRETTY_PRINT));
fclose($file);