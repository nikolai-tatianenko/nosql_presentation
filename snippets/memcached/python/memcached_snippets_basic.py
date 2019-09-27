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

def set_multiple(items):
    """
    Sets multiple items in Memcached.

    Args:
        items (dict): An associative array of key-value pairs.
    """
    client = memcache.Client(['localhost:11211'])
    client.set_multi(items)

# Usage example
set_multiple({'key2': 'value2', 'key3': 'value3'})

def get_multiple(keys):
    """
    Gets multiple items from Memcached.

    Args:
        keys (list): An array of keys to retrieve.

    Returns:
        dict: An associative array of key-value pairs.
    """
    client = memcache.Client(['localhost:11211'])
    return client.get_multi(keys)

# Usage example
result = get_multiple(['key1', 'key2', 'key3'])
print(result)  # Output: {'key1': 'value1', 'key2': 'value2', 'key3': 'value3'}

def delete_key(key):
    """
    Deletes a key from Memcached.

    Args:
        key (str): The key to delete.
    """
    client = memcache.Client(['localhost:11211'])
    client.delete(key)

# Usage example
delete_key('key2')
result = get_value('key2')
print(result)  # Output: None

def flush_cache():
    """
    Flushes all keys from Memcached.
    """
    client = memcache.Client(['localhost:11211'])
    client.flush_all()

# Usage example
flush_cache()

def store_object(key, obj):
    """
    Stores an object in Memcached.

    Args:
        key (str): The key for the object.
        obj (mixed): The object to store.
    """
    client = memcache.Client(['localhost:11211'])
    client.set(key, obj)

# Usage example
store_object('object1', {'name': 'John', 'age': 30})
result = get_value('object1')
print(result)  # Output: {'name': 'John', 'age': 30}

def retrieve_object(key):
    """
    Retrieves an object from Memcached.

    Args:
        key (str): The key of the object.

    Returns:
        mixed: The retrieved object or None if not found.
    """
    client = memcache.Client(['localhost:11211'])
    return client.get(key)

# Usage example
result = retrieve_object('object1')
print(result)  # Output: {'name': 'John', 'age': 30}

def add_server(host, port):
    """
    Adds a new server to an existing Memcached instance.

    Args:
        host (str): The server host.
        port (int): The server port.
    """
    client = memcache.Client(['localhost:11211'])
    client.add_server(host, port)

# Usage example
add_server('127.0.0.1', 11211)

def update_value(key, value):
    """
    Updates a value in Memcached.

    Args:
        key (str): The key of the value.
        value (mixed): The new value.
    """
    client = memcache.Client(['localhost:11211'])
    client.set(key, value)

# Usage example
update_value('key1', 'updated value')
result = get_value('key1')
print(result)  # Output: updated value

def get_stats():
    """
    Retrieves Memcached server statistics.

    Returns:
        dict|bool: An associative array of server statistics or False on failure.
    """
    client = memcache.Client(['localhost:11211'])
    return client.get_stats()

# Usage example
stats = get_stats()
print(stats)  # Output: Server statistics

def set_with_callback(key, value, expiration, expiration_callback):
    """
    Sets a value in Memcached with a custom expiration callback.

    Args:
        key (str): The key for the value.
        value (mixed): The value to set.
        expiration (int): The expiration time in seconds.
        expiration_callback (callable): The callback function for dynamic expiration.
    """
    client = memcache.Client(['localhost:11211'])
    client.set(key, value, 0, expiration, expiration_callback)

# Usage example
def expiration_callback(key, value):
    # Custom expiration logic
    pass

set_with_callback('key1', 'value1', 3600, expiration_callback)

def add_if_not_exists(key, value):
    """
    Sets a value in Memcached only if the key does not exist.

    Args:
        key (str): The key for the value.
        value (mixed): The value to set.
    """
    client = memcache.Client(['localhost:11211'])
    client.add(key, value)

# Usage example
add_if_not_exists('key4', 'value4')
result = get_value('key4')
print(result)  # Output: value4

def replace_if_exists(key, value):
    """
    Sets a value in Memcached only if the key exists.

    Args:
        key (str): The key for the value.
        value (mixed): The value to set.
    """
    client = memcache.Client(['localhost:11211'])
    client.replace(key, value)

# Usage example
replace_if_exists('key4', 'new value')
result = get_value('key4')
print(result)  # Output: new value

def persistent_connection(persistent_id):
    """
    Uses Memcached with a persistent connection.

    Args:
        persistent_id (str): The persistent connection ID.
    """
    client = memcache.Client([persistent_id])
    client.set('localhost:11211')

# Usage example
persistent_connection('my_connection')
set_value('key5', 'value5')
result = get_value('key5')
print(result)  # Output: value5
