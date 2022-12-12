<?php
libxml_use_internal_errors(true);
$content = file_get_contents('https://dias.dev');

$contentDOM = new DOMDocument();

$contentDOM->loadHTML($content);

$xPath = new DOMXPath($contentDOM);

$domNodeList = $xPath->query('.//h2[@itemprop="headline"]');
// var_dump($domNodeList);
foreach ($domNodeList as $elemento) {
  echo $elemento->textContent . PHP_EOL;
}
