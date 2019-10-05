import memcache

def memcached_large_value():
    """
    Storing and retrieving large values using Memcached compression.
    """
    memcached = memcache.Client(['localhost:11211'])
    memcached.set_option(memcache.Client.COMPRESSOR, True)

    large_value = 'A' * (1024 * 1024)  # 1 MB value
    memcached.set('large_value', large_value)
    retrieved_value = memcached.get('large_value')
    print(len(retrieved_value))  # Output: 1048576

# Usage example
memcached_large_value()
