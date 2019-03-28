<?php

require 'vendor/autoload.php';
require 'functions.php';
require 'database.php';

$app = new Slim\App();

$app->get('/versions', function ($request, $response, $args) {
  displayMessage("All versions etc");
});

$app->get('/versions/{version}', function ($request, $response, $args) {
  displayMessage("Single version " . $args['version']);
});

$app->get('/addons[/{params:.*}]', function ($request, $response, $args) {
  displayMessage("All addons etc");
});

$app->get('/addons/{name}', function ($request, $response, $args) {
  displayMessage("Single addon " . $args['name']);
});

$app->get('/addons/search/{keyword}', function ($request, $response, $args) {
  displayMessage("Search addon " . $args['keyword']);
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

$app->get('/news', function ($request, $response, $args) {
  displayMessage("Get news ");
});


$app->run();