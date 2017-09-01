<?php
/**
 * Created by PhpStorm.
 * User: deli13
 * Date: 26.08.17
 * Time: 13:20
 */
print_r($find);
print_r($name);
$find_img=file_get_contents($find);
$DOM=new DOMDocument();
libxml_use_internal_errors(true);
$DOM->loadHTML($find_img);
$img=$DOM->getElementsByTagName('img');
print_r($img);
foreach ($img as $row){
    if($row->getAttribute("title")){
        (file_get_contents($row->getAttribute("src")));
    }
}
