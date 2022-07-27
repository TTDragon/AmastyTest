<?php

/** @var \Amasty\Trainee\MySQL $connection **/

$connection->query(
    'create table trainee.pizza_sizes
(
	size int null,
	price double null
);
'
);