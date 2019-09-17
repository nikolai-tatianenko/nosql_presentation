import memcache

def set_value(key, value, expiration=0):
    """
    Sets a value in Memcached.

    Args:
        key (str): The key for the value.
        value (mixed): The value to set.
        expiration (int, optional): The expiration time in seconds (default: 0).
    """
    client = memcache.Client(['localhost:11211'])
    client.set(key, value, expiration)

def get_value(key):
    """
    Gets a value from Memcached.

    Args:
        key (str): The key of the value.

    Returns:
        mixed: The retrieved value or None if not found.
    """
    client = memcache.Client(['localhost:11211'])
    return client.get(key)

# Usage example
set_value('key1', 'value1')
result = get_value('key1')
print(result)  # Output: value1

def increment_value(key, amount=1):
    """
    Increments the value of an item in Memcached.

    Args:
        key (str): The key of the item.
        amount (int, optional): The amount to increment by (default: 1).

    Returns:
        int|bool: The new value or False on failure.
    """
    client = memcache.Client(['localhost:11211'])
    client.incr(key, amount)
    return client.get(key)

# Usage example
increment_value('counter', 5)
result = get_value('counter')
print(result)  # Output: 5

def decrement_value(key, amount=1):
    """
    Decrements the value of an item in Memcached.

    Args:
        key (str): The key of the item.
        amount (int, optional): The amount to decrement by (default: 1).

    Returns:
        int|bool: The new value or False on failure.
    """
    client = memcache.Client(['localhost:11211'])
    client.decr(key, amount)
    return client.get(key)

# Usage example
decrement_value('counter', 2)
result = get_value('counter')
print(result)  # Output: 3

def key_exists(key):
    """
    Checks if a key exists in Memcached.

    Args:
        key (str): The key to check.

    Returns:
        bool: True if the key exists, False otherwise.
    """
    client = memcache.Client(['localhost:11211'])
    return client.get(key) is not None

# Usage example
exists = key_exists('key1')
print(exists)  # Output: True
