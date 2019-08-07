<?php

$memcached = new Memcached();

// Connect.
$memcached->addServer('nosql_memcached', 11211);

// PART 1 | Simple CRUD.
echo '<br>';
echo 'PART 1 | Simple CRUD.';
echo '<br>';
// Set value.
$memcached->set('hello', 'world');

// Get Value.
echo 'Results: ' . $memcached->get('hello');
echo '<br>';
$memcached->delete('hello');
echo '<br>';
echo 'Results: ' . $memcached->get('hello');
echo '<br>';
echo 'PART 2 | Advanced | COmplex CRUD.';
$memcached->set('key_num', 1);
$memcached->set('key_str', '1');
$memcached->set('key_array', ['1', 'nosql']);
$memcached->set('key_array_complex',
  ['company' => 'EPAM', 'db' => 'memcached']);

$my_object = new StdClass();
$my_object->company = 'EPAM';
$my_object->db = 'mamcached';
$memcached->set('key_array', $my_object);
print_r($memcached->getAllKeys());
// Advanced.

echo 'PART 3 | Advanced | Simple CRUD.';
// Set value.
$memcached->set('hello2', 'world', 1);

echo '<br>';

// Get Value.
echo $memcached->get('hello2');

echo '<br>';
sleep(2);

// Get Value.
echo 'check again?<br>';
echo $memcached->get('hello2');


print_r($memcached->fetchAll());

$time_start = microtime(TRUE);

$items = 10000;
for ($i = 0; $i < $items; $i++) {
  $memcached->set('key_' . $i, 'value_' . $i);
}
$write_time_end = microtime(TRUE);
echo '<br>';
print 'Write time : ' . ($write_time_end - $time_start) . ' sec for ' . $items . ' items';
for ($i = 0; $i < $items; $i++) {
  $memcached->get('key_' . $i);
}
$time_end = microtime(TRUE);
echo '<br>';
print 'Read Results : ' . ($time_end - $write_time_end) . ' sec for ' . $items . ' items';
echo '<br>';
print 'Total  Results : ' . ($time_end - $time_start) . ' sec for ' . $items . ' items';