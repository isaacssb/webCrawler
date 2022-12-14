<?php

libxml_use_internal_errors(true);
$content = file_get_contents('https://owldb.net/blog/naruto-opening-and-ending-songs-list/');

$contentDOM = new DOMDocument();

$contentDOM->loadHTML($content);

$xPath = new DOMXPath($contentDOM);

$namesMusic = $xPath->query('.//table//th[(count(preceding-sibling::*)+1) = 2]|.//table//td[(count(preceding-sibling::*)+1) = 2]');
$namesSinger = $xPath->query('.//table//th[(count(preceding-sibling::*)+1) = 3]|.//table//td[(count(preceding-sibling::*)+1) = 3]');

$listMusic = [];

if (!$namesMusic || !$namesSinger) {
    var_dump('Erro no Xpath');
}
if (count($namesMusic) !== count($namesSinger)) {
    var_dump('Existe uma divergencia na contagem das musicas');
}

foreach ($namesMusic as $nameMusic) {
    $listMusic[] = array(
      'name' => $nameMusic->textContent,
      'singer' => ''
    );
}

foreach ($namesSinger as $key => $nameSinger) {
    $listMusic[$key]['singer'] = $nameSinger->textContent;
}

echo '<div style="width: 90%; margin: 5px auto; padding: 5px; border: 1px solid #999; border-radius: 5px; background-color: #ccffff;">';
echo '<pre style="text-align: left;">';
echo   '<hr>';
echo   str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__) . ' (Linha ' . __LINE__ . ')';
echo   '<hr>';
var_dump($listMusic);
// var_dump( $_POST );
echo   '<hr>';
echo '</pre>';
echo '</div>';
