<?php
/*
Template name: HEL API News EN
Description: Proxy page for parsing articles from HEL API
*/

// header( 'Content-Type: text/xml; charset=utf-8 ');


$catalog_feed = "https://content-api.hel.fi/helfirest/Category/en/wcmrest%3Ac67fa55f-5d20-4bf4-aa35-f71fd06f30ec%20";

$feed = implode(file($catalog_feed));
$xml = simplexml_load_string($feed);
$json = json_encode($xml->children('atom', true));
$array = json_decode($json,TRUE);

$items = array();

foreach($array['entry'] as $Item) {
  $items[] = $Item['id'];
}

$counter = 0;
$maxArticles = 10;

$articles = []; // An array containing all articles

foreach ($items as $fetch) {

  $content = 'https://content-api.hel.fi/helfirest/Content/'.$fetch.'';

  $feed = implode(file($content));
  // print_r($feed);
  $xml = simplexml_load_string($feed, null, LIBXML_NOCDATA);
  if (!is_object($xml)) return FALSE;

  $ns = $xml->getNamespaces(true);

  // Arrays for article details and image details
  $articleDetails = [];
  $articleImageDetails = [];

  // Article details (id, title, summary, updated, published)
  foreach($xml->xpath('//atom:entry') as $details) {
    foreach ($details->children($ns['atom']) as $k => $v) {
      if($k == "title"){$k = "articleTitle";}
      $articleDetails[$k] = $v;
    }
  }

  // Image details (rights, title, type, image/altText, image/fileName, image/resourceUri)
  foreach($xml->xpath('//atom:content/wcm:element[1]') as $event) {
    foreach ($event->children($ns['wcm']) as $k => $v) {
      $articleImageDetails[$k] = $v;
    }
  }

  // Article excerpt
  foreach($xml->xpath('//atom:content/wcm:element[3]') as $event) {
    foreach ($event->children($ns['wcm']) as $k => $v) {
     $excerpt = $v;
    }
  }

  // Article contents
  foreach($xml->xpath('//atom:content/wcm:element[4]') as $event) {
    foreach ($event->children($ns['wcm']) as $k => $v) {
      $content = $v;
    }
  }

  // Article translation link (destination), SV
  foreach($xml->xpath('//atom:content/wcm:element[5]') as $languageLinkKey => $languageLinkVal) {
    foreach ($languageLinkVal->children($ns['wcm']) as $k => $v) {
      if($k == "data"){$k = "sv-language-link";}
      $articleDetails[$k] = $v;
    }
  }

  // Article translation link (destination), EN
  foreach($xml->xpath('//atom:content/wcm:element[6]') as $languageLinkKey => $languageLinkVal) {
    foreach ($languageLinkVal->children($ns['wcm']) as $k => $v) {
      if($k == "data"){$k = "en-language-link";}
      $articleDetails[$k] = $v;
    }
  }

  // Article translation link (destination), FI
  foreach($xml->xpath('//atom:content/wcm:element[7]') as $languageLinkKey => $languageLinkVal) {
    foreach ($languageLinkVal->children($ns['wcm']) as $k => $v) {
      if($k == "data"){$k = "fi-language-link";}
      $articleDetails[$k] = $v;
    }
  }

  $post_content = [];
  $post_content["excerpt"] = $excerpt;
  $post_content["post_content"] = $content;

  // Added this manually for the language versions, othewise may be needed to check which xx-language-link node is empty for determining the language version for the article
  $post_content["post_language"] = "fi"; 

  if(is_array($articleDetails) && is_array($articleImageDetails) && is_array($post_content)){
    // Merge 1) article details 2) image details...
    $articleDetailsMergedArray = array_merge($articleDetails, $articleImageDetails);
    // ...and finally merge 3) post_content (excerpt+post_content)
    $articleArray = array_merge($articleDetailsMergedArray, $post_content);
    $articles[] = $articleArray;
  } else {
    break;
  }

  $counter = $counter+1;
  if($counter > (int)$maxArticles-1){ // set this value as needed
    break;
  }
}
header('Content-Type: application/json');
echo json_encode($articles);
?>