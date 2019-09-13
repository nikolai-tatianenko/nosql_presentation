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
