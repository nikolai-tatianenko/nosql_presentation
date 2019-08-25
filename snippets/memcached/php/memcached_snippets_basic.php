<?php

/**
 * Sets a value in Memcached.
 *
 * @param string $key The key for the value.
 * @param mixed $value The value to set.
 * @param int $expiration The expiration time in seconds (default: 0).
 */
function memcached_set($key, $value, $expiration = 0)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->set($key, $value, $expiration);
}

/**
 * Gets a value from Memcached.
 *
 * @param string $key The key of the value.
 * @return mixed|null The retrieved value or null if not found.
 */
function memcached_get($key)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    return $memcached->get($key);
}

/**
 * Increments the value of an item in Memcached.
 *
 * @param string $key The key of the item.
 * @param int $amount The amount to increment by (default: 1).
 * @return int|bool The new value or false on failure.
 */
function memcached_increment($key, $amount = 1)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->increment($key, $amount);
    return $memcached->get($key);
}

/**
 * Decrements the value of an item in Memcached.
 *
 * @param string $key The key of the item.
 * @param int $amount The amount to decrement by (default: 1).
 * @return int|bool The new value or false on failure.
 */
function memcached_decrement($key, $amount = 1)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->decrement($key, $amount);
    return $memcached->get($key);
}

/**
 * Checks if a key exists in Memcached.
 *
 * @param string $key The key to check.
 * @return bool True if the key exists, false otherwise.
 */
function memcached_exists($key)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    return $memcached->exists($key);
}

/**
 * Sets multiple items in Memcached.
 *
 * @param array $items An associative array of key-value pairs.
 */
function memcached_set_multi(array $items)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->setMulti($items);
}

/**
 * Gets multiple items from Memcached.
 *
 * @param array $keys An array of keys to retrieve.
 * @return array An associative array of key-value pairs.
 */
function memcached_get_multi(array $keys)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    return $memcached->getMulti($keys);
}

/**
 * Deletes a key from Memcached.
 *
 * @param string $key The key to delete.
 */
function memcached_delete($key)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->delete($key);
}

/**
 * Flushes all keys from Memcached.
 */
function memcached_flush()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->flush();
}

/**
 * Stores an object in Memcached.
 *
 * @param string $key The key for the object.
 * @param mixed $object The object to store.
 */
function memcached_store_object($key, $object)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->set($key, $object);
}

/**
 * Retrieves an object from Memcached.
 *
 * @param string $key The key of the object.
 * @return mixed|null The retrieved object or null if not found.
 */
function memcached_retrieve_object($key)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    return $memcached->get($key);
}

/**
 * Adds a new server to an existing Memcached instance.
 *
 * @param string $host The server host.
 * @param int $port The server port.
 */
function memcached_add_server($host, $port)
{
    $memcached = new Memcached();
    $memcached->addServer($host, $port);
}

/**
 * Updates a value in Memcached.
 *
 * @param string $key The key of the value.
 * @param mixed $value The new value.
 */
function memcached_update($key, $value)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->set($key, $value);
}

/**
 * Retrieves Memcached server statistics.
 *
 * @return array|bool An associative array of server statistics or false on failure.
 */
function memcached_stats()
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    return $memcached->getStats();
}

/**
 * Sets a value in Memcached with a custom expiration callback.
 *
 * @param string $key The key for the value.
 * @param mixed $value The value to set.
 * @param int $expiration The expiration time in seconds.
 * @param callable $expirationCallback The callback function for dynamic expiration.
 */
function memcached_set_with_callback($key, $value, $expiration, $expirationCallback)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->set($key, $value, 0, $expiration, $expirationCallback);
}

/**
 * Sets a value in Memcached only if the key does not exist.
 *
 * @param string $key The key for the value.
 * @param mixed $value The value to set.
 */
function memcached_add_if_not_exists($key, $value)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->add($key, $value);
}

/**
 * Sets a value in Memcached only if the key exists.
 *
 * @param string $key The key for the value.
 * @param mixed $value The value to set.
 */
function memcached_replace_if_exists($key, $value)
{
    $memcached = new Memcached();
    $memcached->addServer('localhost', 11211);
    $memcached->replace($key, $value);
}

/**
 * Uses Memcached with a persistent connection.
 *
 * @param string $persistentId The persistent connection ID.
 */
function memcached_persistent($persistentId)
{
    $memcached = new Memcached($persistentId);
    $memcached->addServer('localhost', 11211);
}
