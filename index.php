<?php

require 'vendor/autoload.php';
require 'functions.php';
require 'database.php';
require 'model/Addons.php';

use Psr\Http\Message\ResponseInterface;
global $database;
$app = new Slim\App(['database' => $database]);

$app->get('/versions', function ($request, $response, $args) {
  displayMessage("All versions etc");
});

$app->get('/versions/{version}', function ($request, $response, $args) {
  displayMessage("Single version " . $args['version']);
});

$app->get('/addons', function ($request, $response, $args) {
  displayMessage("All addons etc");
});

$app->get('/addons/{name}', function ($request, $response, $args) {
  displayMessage("Single addon " . $args['name']);
});

$app->get('/addons/search/{keyword}', function ($request, $response, $args) {
  $keyword = $args['keyword'];
  if (empty($keyword) || strlen($keyword) < 3) {
  	return $response->withJson(array('error' => 'Invalid keyword length'), 400);
  }

  $addons = new Addons($this->database);
  return $response->withJson(
  	array(
  		'status' => 'success',
  		'data' => $addons->list()
  	)
  , 200);
});

$app->get('/skins', function ($request, $response, $args) {
  displayMessage("All skins etc");
});

$app->get('/skins/{name}', function ($request, $response, $args) {
  displayMessage("Single skin " . $args['name']);
});

$app->get('/skins/search/{keyword}', function ($request, $response, $args) {
  displayMessage("Search skin " . $args['keyword']);
});

$app->get('/news', function ($request, $response) {
  $news = $this->database->get('news', 10);
	return $response->withJson($news);
});


$app->run();