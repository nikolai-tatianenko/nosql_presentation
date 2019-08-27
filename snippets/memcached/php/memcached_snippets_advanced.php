<?php

/**
 * Storing and retrieving large values using Memcached compression.
 */
function memcached_large_value()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->setOption(Memcached::OPT_COMPRESSION, true);

    $largeValue = str_repeat('A', 1024 * 1024); // 1 MB value
    $memcached->set('large_value', $largeValue);
    $retrievedValue = $memcached->get('large_value');
    echo strlen($retrievedValue); // Output: 1048576
}
