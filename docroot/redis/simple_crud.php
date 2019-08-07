<?php
require '../vendor/autoload.php';
Predis\Autoloader::register();

try {
  // For local Connection.
  // $client = new Predis\Client();

  // For Remote connection.
  $client = new Predis\Client([
    "scheme" => "tcp",
    "host" => "nosql_redis", // Host name.
    "port" => 6379,
  ]);

  $client->set('hello', 'world');
  $value = $client->get('hello');
  var_dump($value);
} catch (Exception $e) {
  die($e->getMessage());
}