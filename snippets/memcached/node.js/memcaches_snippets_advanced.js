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
