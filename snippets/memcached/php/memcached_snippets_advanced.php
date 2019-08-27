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

/**
 * Using Memcached with consistent hashing for distributed caching.
 */
function memcached_consistent_hashing()
{
    $memcached = new Memcached();
    $servers = [
        ['memcached1.example.com', 11211, 33],
        ['memcached2.example.com', 11211, 67],
    ];
    $memcached->addServers($servers);

    $key = 'memcached_key';
    $value = 'Hello, Memcached!';
    $memcached->setByKey($servers[1][0], $key, $value);
    $result = $memcached->getByKey($servers[1][0], $key);
    echo $result; // Output: Hello, Memcached!
}
