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

def memcached_consistent_hashing():
    """
    Using Memcached with consistent hashing for distributed caching.
    """
    memcached = memcache.Client([
        ('memcached1.example.com', 11211),
        ('memcached2.example.com', 11211)
    ])

    key = 'memcached_key'
    value = 'Hello, Memcached!'
    memcached.set(key, value, key_hash=memcache.hashers.CRC32_HASH)
    result = memcached.get(key, key_hash=memcache.hashers.CRC32_HASH)
    print(result)  # Output: Hello, Memcached!

# Usage example
memcached_consistent_hashing()

def memcached_get_with_callback():
    """
    Using Memcached with a callback to fetch a value if it doesn't exist.
    """
    memcached = memcache.Client(['localhost:11211'])
    memcached.set_option(memcache.Client.PREFIX_KEY, 'myapp:')
    memcached.set_option(memcache.Client.BINARY_PROTOCOL, True)

    def fetch_value(memcached, key, value):
        # Custom logic to fetch the value if it doesn't exist in Memcached
        value[0] = fetchDataFromDatabase(key)
        return True

    key = 'memcached_key'
    value = memcached.get(key, callback=fetch_value)
    print(value[0])  # Output: Value from Memcached or fetched from the database

# Usage example
memcached_get_with_callback()

def memcached_custom_serializer():
    """
    Using Memcached with a custom serializer for complex data structures.
    """
    memcached = memcache.Client(['localhost:11211'])

    class CustomSerializer(object):
        def serialize(self, value):
            # Custom serialization logic
            return str(value)

        def deserialize(self, value):
            # Custom deserialization logic
            return int(value)

    serializer = CustomSerializer()
    memcached.set_option(memcache.Client.SERIALIZER, serializer)
    memcached.set('data', {'name': 'John', 'age': 30, 'hobbies': ['reading', 'gaming', 'coding']})

    result = memcached.get('data')
    print(result)  # Output: {'name': 'John', 'age': 30, 'hobbies': ['reading', 'gaming', 'coding']}

# Usage example
memcached_custom_serializer()

def memcached_cas():
    """
    Using Memcached with CAS (Check-and-Set) operation for optimistic locking.
    """
    memcached = memcache.Client(['localhost:11211'])

    memcached.set('memcached_key', 'initial_value')
    cas_token = None
    result = memcached.get('memcached_key', cas_token=cas_token)
    modified_value = modifyData(result)
    memcached.cas('memcached_key', modified_value, cas_token)

# Usage example
memcached_cas()

def memcached_binary_protocol():
    """
    Using Memcached with binary protocol for improved performance.
    """
    memcached = memcache.Client(['localhost:11211'])
    memcached.set_option(memcache.Client.BINARY_PROTOCOL, True)

    memcached.set('memcached_key', 'Hello, Memcached!')
    result = memcached.get('memcached_key')
    print(result)

# Usage example
memcached_binary_protocol()

def memcached_milliseconds_expiration():
    """
    Using Memcached with expiration time in milliseconds.
    """
    memcached = memcache.Client(['localhost:11211'])

    memcached.set('memcached_key', 'Hello, Memcached!', time=1000)
    result = memcached.get('memcached_key')
    print(result)

# Usage example
memcached_milliseconds_expiration()

