<?php
#phpinfo();
error_reporting(E_ALL);

echo "view the source of the page... i don't html anymore <br><br>\n";

# connecting to the docker instance that is simply known as 'redis' on the docker network layer
$redis = new Redis();
$redis->connect('redis');
#var_dump($redis);

# set/get stuff
# echo "before set, if you have a longer ttl \"" . var_export( $redis->get('key'), 1 ) . "\"\n";
# # 3 second TTL
# $redis->setEx('key', 3, 'this_be_my_value');
# echo "after set \"" . var_export( $redis->get('key'), 1 ) . "\"\n";



# only do this mysql stuff if no value set in redis, we get a ttl so redis auto expires records
$mydate = $redis->get('mydate');
if ( false === $mydate )
{
  # do a query and with a long sleep and set a key for more real world magic
  # http://www.w3schools.com/php/php_mysql_connect.asp
  $pdo = new PDO('mysql:host=mysql;dbname=test', 'root', '111111');

  $statement = $pdo->query("select sleep(5), now() as now");
  $row = $statement->fetch(PDO::FETCH_ASSOC);
  $redis->setEx( 'mydate', 10, $row['now'] );
  $mydate = $row['now'];
  echo "\nhad to go get your value from mysql, and i took a 5 second nap, thus the long page load\n\n";
}
else
{
  echo "\n value was in redis with a valid ttl\n";
}
echo "\nmydate is\n";
var_dump($mydate);
