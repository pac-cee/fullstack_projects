<?php
// Variables and data types
$name = "John";               // String
$age = 25;                    // Integer
$height = 1.75;               // Float
$isStudent = true;            // Boolean
$hobbies = ["reading", "coding", "music"]; // Array

// Echo and print statements
echo "Hello, " . $name . "!\n";
print("You are $age years old\n");

// If-else condition
if ($age >= 18) {
    echo "You are an adult\n";
} else {
    echo "You are a minor\n";
}

// Loops
// For loop
for ($i = 0; $i < 3; $i++) {
    echo "Counter: $i\n";
}

// While loop
$counter = 0;
while ($counter < 3) {
    echo "While counter: $counter\n";
    $counter++;
}

// Functions
function greet($person) {
    return "Hello, $person!";
}

echo greet($name);

// Associative array
$person = [
    "name" => "John",
    "age" => 25,
    "city" => "New York"
];

// Accessing associative array
echo "\nPerson details:\n";
foreach ($person as $key => $value) {
    echo "$key: $value\n";
}


// ...existing code...

// User Input Handling
echo "\nPlease enter your name: ";
$userInput = trim(fgets(STDIN));  // Reading console input
echo "Welcome, $userInput!\n";

// POST handling (for web forms)
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
}
*/

// Error Handling
function divideNumbers($a, $b) {
    try {
        if ($b == 0) {
            throw new Exception("Division by zero!");
        }
        return $a / $b;
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

echo divideNumbers(10, 2) . "\n";  // Output: 5
echo divideNumbers(10, 0) . "\n";  // Output: Error message

// Classes and Objects
class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getInfo() {
        return "Name: {$this->name}, Age: {$this->age}";
    }
}

$person1 = new Person("Alice", 30);
echo $person1->getInfo() . "\n";

// Working with Files
$filename = "test.txt";
// Writing to file
file_put_contents($filename, "Hello World\n");
// Reading from file
echo "File contents: " . file_get_contents($filename);

// Regular Expressions
$pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$email = "test@example.com";
if (preg_match($pattern, $email)) {
    echo "\nValid email format";
}

// Date and Time Handling
$date = new DateTime();
echo "\nCurrent date: " . $date->format('Y-m-d H:i:s');

// Array Functions
$numbers = [1, 2, 3, 4, 5];
$squared = array_map(function($n) {
    return $n * $n;
}, $numbers);
echo "\nSquared numbers: " . implode(", ", $squared);

?>
