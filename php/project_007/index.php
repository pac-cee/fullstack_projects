<?php

$fruits = ['apple', 'banana', 'cherry'];
array_push($fruits, 'date');
array_pop($fruits);

foreach ($fruits as $fruit) {
    echo "$fruit\n";
}
