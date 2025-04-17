<?php
$tasksFile = 'tasks.json';
if (!file_exists($tasksFile)) {
    file_put_contents($tasksFile, json_encode([]));
}
$tasks = json_decode(file_get_contents($tasksFile), true);
$command = $argv[1] ?? '';
switch ($command) {
    case 'add':
        $task = $argv[2] ?? '';
        if ($task) {
            $tasks[] = $task;
            file_put_contents($tasksFile, json_encode($tasks));
            echo "Added: $task\n";
        } else {
            echo "Usage: php index.php add \"Task\"\n";
        }
        break;
    case 'list':
        if (empty($tasks)) {
            echo "No tasks.\n";
        } else {
            foreach ($tasks as $i => $t) {
                echo ($i + 1) . ". $t\n";
            }
        }
        break;
    case 'remove':
        $index = (int)($argv[2] ?? 0);
        if ($index > 0 && isset($tasks[$index - 1])) {
            $removed = $tasks[$index - 1];
            array_splice($tasks, $index - 1, 1);
            file_put_contents($tasksFile, json_encode($tasks));
            echo "Removed: $removed\n";
        } else {
            echo "Usage: php index.php remove INDEX\n";
        }
        break;
    default:
        echo "Commands: add, list, remove\n";
        break;
}
?>
