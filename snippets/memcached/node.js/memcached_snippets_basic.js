const Memcached = require('memcached');

/**
 * Sets a value in Memcached.
 *
 * @param {string} key The key for the value.
 * @param {*} value The value to set.
 * @param {number} expiration The expiration time in seconds (default: 0).
 */
function setMemcachedValue (key, value, expiration = 0) {
  const memcached = new Memcached('localhost:11211');
  memcached.set(key, value, expiration, (err) => {
    if (err) {
      console.error('Error setting value in Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Gets a value from Memcached.
 *
 * @param {string} key The key of the value.
 * @returns {*} The retrieved value or null if not found.
 */
function getMemcachedValue (key) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.get(key, (err, data) => {
      if (err) {
        console.error('Error getting value from Memcached:', err);
        reject(err);
      } else {
        resolve(data);
      }
      memcached.end();
    });
  });
}

/**
 * Increments the value of an item in Memcached.
 *
 * @param {string} key The key of the item.
 * @param {number} amount The amount to increment by (default: 1).
 * @returns {number|boolean} The new value or false on failure.
 */
function incrementMemcachedValue (key, amount = 1) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.increment(key, amount, (err, newValue) => {
      if (err) {
        console.error('Error incrementing value in Memcached:', err);
        reject(err);
      } else {
        resolve(newValue);
      }
      memcached.end();
    });
  });
}

/**
 * Decrements the value of an item in Memcached.
 *
 * @param {string} key The key of the item.
 * @param {number} amount The amount to decrement by (default: 1).
 * @returns {number|boolean} The new value or false on failure.
 */
function decrementMemcachedValue (key, amount = 1) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.decrement(key, amount, (err, newValue) => {
      if (err) {
        console.error('Error decrementing value in Memcached:', err);
        reject(err);
      } else {
        resolve(newValue);
      }
      memcached.end();
    });
  });
}

/**
 * Checks if a key exists in Memcached.
 *
 * @param {string} key The key to check.
 * @returns {boolean} True if the key exists, false otherwise.
 */
function checkMemcachedKeyExists (key) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.get(key, (err, data) => {
      if (err) {
        console.error('Error checking key existence in Memcached:', err);
        reject(err);
      } else {
        resolve(data !== undefined);
      }
      memcached.end();
    });
  });
}

/**
 * Sets multiple items in Memcached.
 *
 * @param {Object} items An object with key-value pairs.
 */
function setMultipleMemcachedValues (items) {
  const memcached = new Memcached('localhost:11211');
  memcached.setMulti(items, (err) => {
    if (err) {
      console.error('Error setting multiple values in Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Gets multiple items from Memcached.
 *
 * @param {Array<string>} keys An array of keys to retrieve.
 * @returns {Object} An object with key-value pairs.
 */
function getMultipleMemcachedValues (keys) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.getMulti(keys, (err, data) => {
      if (err) {
        console.error('Error getting multiple values from Memcached:', err);
        reject(err);
      } else {
        resolve(data);
      }
      memcached.end();
    });
  });
}

/**
 * Deletes a key from Memcached.
 *
 * @param {string} key The key to delete.
 */
function deleteMemcachedKey (key) {
  const memcached = new Memcached('localhost:11211');
  memcached.del(key, (err) => {
    if (err) {
      console.error('Error deleting key from Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Flushes all keys from Memcached.
 */
function flushMemcached () {
  const memcached = new Memcached('localhost:11211');
  memcached.flush((err) => {
    if (err) {
      console.error('Error flushing Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Stores an object in Memcached.
 *
 * @param {string} key The key for the object.
 * @param {*} object The object to store.
 */
function storeObjectInMemcached (key, object) {
  const memcached = new Memcached('localhost:11211');
  memcached.set(key, object, 0, (err) => {
    if (err) {
      console.error('Error storing object in Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Retrieves an object from Memcached.
 *
 * @param {string} key The key of the object.
 * @returns {*} The retrieved object or null if not found.
 */
function retrieveObjectFromMemcached (key) {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.get(key, (err, data) => {
      if (err) {
        console.error('Error retrieving object from Memcached:', err);
        reject(err);
      } else {
        resolve(data);
      }
      memcached.end();
    });
  });
}
/**
 * Adds a new server to an existing Memcached instance.
 *
 * @param {string} host The server host.
 * @param {number} port The server port.
 */
function addMemcachedServer (host, port) {
  const memcached = new Memcached();
  memcached.addServer(host, port);
}

/**
 * Updates a value in Memcached.
 *
 * @param {string} key The key of the value.
 * @param {*} value The new value.
 */
function updateMemcachedValue (key, value) {
  const memcached = new Memcached('localhost:11211');
  memcached.replace(key, value, (err) => {
    if (err) {
      console.error('Error updating value in Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Retrieves Memcached server statistics.
 *
 * @returns {Object|boolean} An object with server statistics or false on failure.
 */
function getMemcachedStats () {
  const memcached = new Memcached('localhost:11211');
  return new Promise((resolve, reject) => {
    memcached.stats((err, data) => {
      if (err) {
        console.error('Error retrieving Memcached stats:', err);
        reject(err);
      } else {
        resolve(data);
      }
      memcached.end();
    });
  });
}

/**
 * Sets a value in Memcached with a custom expiration callback.
 *
 * @param {string} key The key for the value.
 * @param {*} value The value to set.
 * @param {number} expiration The expiration time in seconds.
 * @param {Function} expirationCallback The callback function for dynamic expiration.
 */
function setMemcachedValueWithCallback (
  key, value, expiration, expirationCallback) {
  const memcached = new Memcached('localhost:11211');
  memcached.set(key, value, 0, expiration, (err) => {
    if (err) {
      console.error('Error setting value with callback in Memcached:', err);
    }
    memcached.end();
  }, expirationCallback);
}

/**
 * Sets a value in Memcached only if the key does not exist.
 *
 * @param {string} key The key for the value.
 * @param {*} value The value to set.
 */
function addMemcachedValueIfNotExists (key, value) {
  const memcached = new Memcached('localhost:11211');
  memcached.add(key, value, (err) => {
    if (err) {
      console.error('Error adding value if not exists in Memcached:', err);
    }
    memcached.end();
  });
}

/**
 * Sets a value in Memcached only if the key exists.
 *
 * @param {string} key The key for the value.
 * @param {*} value The value to set.
 */
function replaceMemcachedValueIfExists (key, value) {
  const memcached = new Memcached('localhost:11211');
  memcached.replace(key, value, (err) => {
    if (err) {
      console.error('Error replacing value if exists in Memcached:', err);
    }
    memcached.end();
  });
}
