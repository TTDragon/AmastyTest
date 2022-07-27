<?php

/** @var \Amasty\Trainee\MySQL $connection **/

if (!$connection->fetchAll('SELECT * from pizza')) {
    $connection->query("INSERT INTO pizza (name, price) VALUES ('pepperoni', 5);");
    $connection->query("INSERT INTO pizza (name, price) VALUES ('Derevenskaya', 5);");
    $connection->query("INSERT INTO pizza (name, price) VALUES ('Gavajskaya', 5);");
    $connection->query("INSERT INTO pizza (name, price) VALUES ('Gribnaya', 5);");
}

if (!$connection->fetchAll('SELECT * from pizza_sizes')) {
    $connection->query("INSERT INTO pizza_sizes (size, price) VALUES (21, 7);");
    $connection->query("INSERT INTO pizza_sizes (size, price) VALUES (26, 10);");
    $connection->query("INSERT INTO pizza_sizes (size, price) VALUES (31, 13);");
    $connection->query("INSERT INTO pizza_sizes (size, price) VALUES (45, 17);");
}

if (!$connection->fetchAll('SELECT * from sous')) {
    $connection->query("INSERT INTO sous (name, price) VALUES ('syrnyj', 2);");
    $connection->query("INSERT INTO sous (name, price) VALUES ('kislo-sladkij', 2);");
    $connection->query("INSERT INTO sous (name, price) VALUES ('chesnochnyj', 2);");
    $connection->query("INSERT INTO sous (name, price) VALUES ('barbekq', 2);");
}
