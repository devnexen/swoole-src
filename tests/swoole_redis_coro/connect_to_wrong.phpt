--TEST--
swoole_redis_coro: redis client set options
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../include/bootstrap.php';
Co::set(['socket_timeout' => -1]);
go(function () {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect(MYSQL_SERVER_HOST, MYSQL_SERVER_PORT);
    assert(!$redis->set('foo', 'bar'));
    assert($redis->errCode === SWOOLE_REDIS_ERR_PROTOCOL);
});
swoole_event_wait();
echo "DONE\n";
?>
--EXPECT--
DONE
