const Memcached = require('memcached');

/**
 * Storing and retrieving large values using Memcached compression.
 */
function memcachedLargeValue() {
  const memcached = new Memcached('localhost:11211');
  memcached.options.compress = true;

  const largeValue = 'A'.repeat(1024 * 1024); // 1 MB value
  memcached.set('large_value', largeValue, 0, (err) => {
    if (err) {
      console.error('Error setting large value in Memcached:', err);
    }
    memcached.get('large_value', (err, retrievedValue) => {
      if (err) {
        console.error('Error retrieving large value from Memcached:', err);
      } else {
        console.log(retrievedValue.length); // Output: 1048576
      }
      memcached.end();
    });
  });
}

/**
 * Using Memcached with consistent hashing for distributed caching.
 */
function memcachedConsistentHashing() {
  const memcached = new Memcached();
  const servers = [
    { host: 'memcached1.example.com', port: 11211, weight: 33 },
    { host: 'memcached2.example.com', port: 11211, weight: 67 },
  ];
  memcached.addServers(servers);

  const key = 'memcached_key';
  const value = 'Hello, Memcached!';
  memcached.setByKey(servers[1].host, key, value, 0, (err) => {
    if (err) {
      console.error('Error setting value using consistent hashing in Memcached:', err);
    }
    memcached.getByKey(servers[1].host, key, (err, result) => {
      if (err) {
        console.error('Error getting value using consistent hashing from Memcached:', err);
      } else {
        console.log(result); // Output: Hello, Memcached!
      }
      memcached.end();
    });
  });
}

