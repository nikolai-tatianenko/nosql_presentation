<?php
$memcached = new Memcached();

// Connect.
// Connection arguments 'host_name' , default port name.
//$memcached->addServer('localhost', 11211);
$memcached->addServer('nosql_memcached', 11211);

// PART 1 | Simple CRUD.
echo '<br>';
echo 'PART 1 | Simple CRUD.';
echo '<br>';
// Set value.
$memcached->set('hello', 'world');
$memcached->set('array_value', ['first_value', 'second_value']);
$memcached->set('expired_value', 'world', time() + 3);

// Get Value.
echo 'Results: <br>';
var_dump($memcached->get('hello'));
var_dump($memcached->get('array_val'));
var_dump($memcached->get('expired_value'));
echo 'Wait for 3 sec';
sleep(3);
if (!empty($memcached->get('expired_value'))) {
  var_dump($memcached->get('expired_value'));
}
