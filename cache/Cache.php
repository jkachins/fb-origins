<?php

include('MemcacheSASL.php');

/**
 * Description of Cache
 *
 * @author jkachins
 */
class Cache {
    private $cache;
    
    public function __construct() {
        $this->cache = new MemcacheSASL();
        $servers = getenv("MEMCACHIER_SERVERS");
        $user = getenv("MEMCACHIER_USERNAME");
        $pass = getenv("MEMCACHIER_PASSWORD");
        $this->cache->addServer($servers, '11211');
        $this->cache->setSaslAuthData($user, $pass);
    }
    
    public function get($key) {
        $val = $this->cache->get($key);
        if(!$val) return null;
        return $val;
    }
    
    public function put($key, $value, $expiration = 3600) {
        $this->cache->set($key, $value, $expiration);
    }
    
    public function remove($key) {
        $this->cache->delete($key);
    }
}

?>
