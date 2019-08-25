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