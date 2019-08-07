<?php
require '../vendor/autoload.php';
$number_items = 1000000;
$get_memcache_results = get_memcache_results($output, $number_items);
$get_memcache_results = get_redis_results($output, $number_items);

echo '<pre>';
var_dump($output);
echo '</pre>';
echo '<table>';
foreach ($output as $key => $value) {
  echo '<tr>';
  echo '<td>' . $key . '</td>';


  foreach ($value as $value2 => $key2) {
    echo '<td>' . $key2 . '|' . $value2 . '</td>';
  }
}
echo '</tr>';
echo '</table>';
function get_memcache_results(&$output, $number_items = 100) {
  $memcached = new Memcached();

  // Connect.
  $memcached->addServer('nosql_memcached', 11211);

  $time_start = microtime(TRUE);
  $next_check = 10;

  for ($i = 0; $i < $number_items; $i++) {
    $memcached->set('key_' . $i, 'value_' . $i);
    if ($i == $next_check) {
      $output['memcache']['set'][$next_check] = microtime(TRUE) - $time_start;
      $next_check *= 10;
    }
  }
  $output['memcache']['set'][$number_items] = microtime(TRUE) - $time_start;

  $write_time_end = microtime(TRUE);
  $next_check = 10;

  $get_time_start = microtime(TRUE);
  for ($i = 0; $i < $number_items; $i++) {
    $memcached->get('key_' . $i);
    if ($i == $next_check) {
      $output['memcache']['get'][$next_check] = microtime(TRUE) - $get_time_start;
      $next_check *= 10;
    }
  }
  $output['memcache']['get'][$number_items] = microtime(TRUE) - $time_start;

  $time_end = microtime(TRUE);
  $output['memcache']['read_time'] = $time_end - $write_time_end;
  $output['memcache']['write_time'] = $time_end - $time_start;

}


function get_redis_results(&$output, $number_items = 100) {
  $client = new Predis\Client([
    "scheme" => "tcp",
    "host" => "nosql_redis", // Host name.
    "port" => 6379,
  ]);


  $time_start = microtime(TRUE);
  $next_check = 10;

  for ($i = 0; $i < $number_items; $i++) {

    $client->set('key_' . $i, 'value_' . $i);

    if ($i == $next_check) {
      $output['redis']['set'][$next_check] = microtime(TRUE) - $time_start;
      $next_check *= 10;
    }
  }
  $output['redis']['set'][$number_items] = microtime(TRUE) - $time_start;

  $write_time_end = microtime(TRUE);
  $next_check = 10;

  $get_time_start = microtime(TRUE);
  for ($i = 0; $i < $number_items; $i++) {
    $client->get('key_' . $i);
    if ($i == $next_check) {
      $output['redis']['get'][$next_check] = microtime(TRUE) - $get_time_start;
      $next_check *= 10;
    }
  }
  $output['redis']['get'][$number_items] = microtime(TRUE) - $time_start;

  $time_end = microtime(TRUE);
  $output['redis']['read_time'] = $time_end - $write_time_end;
  $output['redis']['write_time'] = $time_end - $time_start;
}
