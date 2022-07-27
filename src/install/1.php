<?php

/** @var \Amasty\Trainee\MySQL $connection **/

$connection->query(
    'create table trainee.pizza
(
	name varchar(255) null,
	price double null
);
'
);
