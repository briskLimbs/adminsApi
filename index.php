<?php

require 'vendor/autoload.php';
require 'functions.php';
// require 'database.php';

$app = new Slim\App();

$app->get('/versions', function ($request, $response, $args) {
  db("All versions etc");
});

$app->get('/versions/{version}', function ($request, $response, $args) {
  db("Single version " . $args['version']);
});

$app->get('/addons', function ($request, $response, $args) {
	pr($request);
  db("All addons etc");
});

$app->get('/addons/{name}', function ($request, $response, $args) {
  db("Single addon " . $args['name']);
});

$app->get('/addons/search/{keyword}', function ($request, $response, $args) {
  db("Search addon " . $args['keyword']);
});

$app->run();