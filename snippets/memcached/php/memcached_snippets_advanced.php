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

/**
 * Using Memcached with a callback to fetch a value if it doesn't exist.
 */
function memcached_get_with_callback()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->setOption(Memcached::OPT_PREFIX_KEY, 'myapp:');
    $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

    $key = 'memcached_key';
    $value = $memcached->get($key, function ($memcached, $key, &$value) {
        // Custom logic to fetch the value if it doesn't exist in Memcached
        $value = fetchDataFromDatabase($key);
        return true;
    });

    echo $value; // Output: Value from Memcached or fetched from the database
}

/**
 * Using Memcached with a custom serializer for complex data structures.
 */
function memcached_custom_serializer()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $serializer = new CustomSerializer();
    $memcached->setOption(Memcached::OPT_SERIALIZER, Memcached::SERIALIZER_CUSTOM);
    $memcached->setOption(Memcached::OPT_SERIALIZER_NAME, get_class($serializer));

    $complexData = [
        'name' => 'John',
        'age' => 30,
        'hobbies' => ['reading', 'gaming', 'coding'],
    ];
    $memcached->set('data', $complexData);

    $result = $memcached->get('data');
    print_r($result); // Output: Array containing the complex data structure
}

/**
 * Using Memcached with CAS (Check-and-Set) operation for optimistic locking.
 */
function memcached_cas()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $memcached->set('memcached_key', 'initial_value');
    $result = $memcached->get('memcached_key', null, $casToken);
    $modifiedValue = modifyData($result);
    $memcached->cas($casToken, 'memcached_key', $modifiedValue);
}

/**
 * Using Memcached with binary protocol for improved performance.
 */
function memcached_binary_protocol()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

    $memcached->set('memcached_key', 'Hello, Memcached!');
    $result = $memcached->get('memcached_key');
    echo $result;
}

/**
 * Using Memcached with expiration time in milliseconds.
 */
function memcached_milliseconds_expiration()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $memcached->set('memcached_key', 'Hello, Memcached!', 1000, 0); // Expires in 1 second
    $result = $memcached->get('memcached_key');
    echo $result;
}

/**
 * Using Memcached with consistent timeouts for distributed caching.
 */
function memcached_consistent_timeouts()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $memcached->setOption(Memcached::OPT_SERVER_FAILURE_LIMIT, 3);
    $memcached->setOption(Memcached::OPT_RETRY_TIMEOUT, 2);
    $memcached->setOption(Memcached::OPT_DEAD_TIMEOUT, 30);
}

/**
 * Using Memcached with connection pooling for efficient resource utilization.
 */
function memcached_connection_pooling()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211, 10); // 10 connections in the pool

    $memcached->set('memcached_key', 'Hello, Memcached!');
    $result = $memcached->get('memcached_key');
    echo $result;
}

/**
 * Using Memcached with consistent key hashing for efficient caching.
 */
function memcached_consistent_key_hashing()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $memcached->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, true);

    $memcached->set('memcached_key', 'Hello, Memcached!');
    $result = $memcached->get('memcached_key');
    echo $result;
}

/**
 * Using Memcached with asynchronous I/O.
 */
function memcached_async_io()
{
    $memcached = new Memcached();
    $memcached->setOption(Memcached::OPT_ASYNC_CONNECTION, true);
    $memcached->addServer('localhost', 11211);

    $memcached->set('memcached_key', 'Hello, Memcached!', 0, 3600);
    $memcached->getResultCode(); // Check the result code for success or failure
}

/**
 * Using Memcached with connection pooling and persistent connections.
 */
function memcached_connection_pooling_persistent()
{
    $memcached = new Memcached();
    $memcached->setOption(Memcached::OPT_CONNECT_TIMEOUT, 100); // Timeout in milliseconds
    $memcached->setOption(Memcached::OPT_SERVER_FAILURE_LIMIT, 3);

    $memcached->addServer('localhost', 11211); // Reuse connection for subsequent requests
    $memcached->set('memcached_key', 'Hello, Memcached!', 0, 3600);
    $memcached->getResultCode(); // Check the result code for success or failure
}
/**
 * Using Memcached for caching database query results.
 */
function memcached_caching_database_query()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);

    $query = 'SELECT * FROM users WHERE id = 1';
    $key = 'user_1';

    $result = $memcached->get($key);
    if (!$result) {
        $result = fetchFromDatabase($query); // Fetch data from the database
        $memcached->set($key, $result, 0, 3600); // Cache the result for future use
    }

    print_r($result);
}

