<?php

/** @var \Amasty\Trainee\MySQL $connection **/

$connection->query(
    'create table sous
(
name varchar(255) null,
price double null
);
'
);

$connection->query('alter table sous modify id int auto_increment;');