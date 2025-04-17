<?php

$target = rand(1, 100);
echo "Guess a number between 1 and 100: ";

while (true) {
    $input = trim(fgets(STDIN));
    if (!is_numeric($input)) {
        echo "Please enter a valid number: ";
        continue;
    }
    $guess = (int)$input;
    if ($guess < $target) {
        echo "Too low. Try again: ";
    } elseif ($guess > $target) {
        echo "Too high. Try again: ";
    } else {
        echo "Congratulations! You guessed $target.\n";
        break;
    }
}
