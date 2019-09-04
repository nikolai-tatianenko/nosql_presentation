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

/**
 * Using Memcached with a callback to fetch a value if it doesn't exist.
 */
function memcachedGetWithCallback() {
  const memcached = new Memcached('localhost:11211');
  memcached.options.prefix = 'myapp:';
  memcached.options.binary = true;

  const key = 'memcached_key';
  memcached.get(key, (err, value) => {
    if (err) {
      console.error('Error getting value from Memcached with callback:', err);
    } else if (value === undefined) {
      fetchDataFromDatabase(key, (data) => {
        memcached.set(key, data, 0, (err) => {
          if (err) {
            console.error('Error setting value in Memcached with callback:', err);
          }
          memcached.end();
        });
      });
    } else {
      console.log(value); // Output: Value from Memcached or fetched from the database
      memcached.end();
    }
  });
}

/**
 * Using Memcached with a custom serializer for complex data structures.
 */
function memcachedCustomSerializer() {
  const memcached = new Memcached('localhost:11211');
  const serializer = new CustomSerializer();
  memcached.options.serializer = serializer;
  memcached.options.transcoder = false;

  const complexData = {
    name: 'John',
    age: 30,
    hobbies: ['reading', 'gaming', 'coding'],
  };
  memcached.set('data', complexData, 0, (err) => {
    if (err) {
      console.error('Error setting value with custom serializer in Memcached:', err);
    } else {
      memcached.get('data', (err, result) => {
        if (err) {
          console.error('Error getting value with custom serializer from Memcached:', err);
        } else {
          console.log(result); // Output: Object containing the complex data structure
        }
        memcached.end();
      });
    }
  });
}

/**
 * Using Memcached with CAS (Check-and-Set) operation for optimistic locking.
 */
function memcachedCAS() {
  const memcached = new Memcached('localhost:11211');
  const key = 'memcached_key';

  memcached.get(key, (err, value, cas) => {
    if (err) {
      console.error('Error getting value with CAS in Memcached:', err);
    } else {
      const modifiedValue = modifyData(value);
      memcached.cas(key, modifiedValue, 0, cas, (err) => {
        if (err) {
          console.error('Error setting value with CAS in Memcached:', err);
        }
        memcached.end();
      });
    }
  });
}

/**
 * Using Memcached with binary protocol for improved performance.
 */
function memcachedBinaryProtocol() {
  const memcached = new Memcached('localhost:11211');
  memcached.options.binary = true;

  memcached.set('memcached_key', 'Hello, Memcached!', 0, (err) => {
    if (err) {
      console.error('Error setting value with binary protocol in Memcached:', err);
    } else {
      memcached.get('memcached_key', (err, result) => {
        if (err) {
          console.error('Error getting value with binary protocol from Memcached:', err);
        } else {
          console.log(result); // Output: Hello, Memcached!
        }
        memcached.end();
      });
    }
  });
}

/**
 * Using Memcached with expiration time in milliseconds.
 */
function memcachedMillisecondsExpiration() {
  const memcached = new Memcached('localhost:11211');

  memcached.set('memcached_key', 'Hello, Memcached!', 1000, (err) => {
    if (err) {
      console.error('Error setting value with milliseconds expiration in Memcached:', err);
    } else {
      memcached.get('memcached_key', (err, result) => {
        if (err) {
          console.error('Error getting value with milliseconds expiration from Memcached:', err);
        } else {
          console.log(result); // Output: Hello, Memcached!
        }
        memcached.end();
      });
    }
  });
}
