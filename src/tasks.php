<?php
    class Task
    {
        private $description;

        function __construct($task_description)
        {
            $this->description = $task_description;
        }

        // Setter Getter
        function setDescription($new_description)
        {
            $this->description = $new_description;
        }
        function getDescription()
        {
            return $this->description;
        }

        // Save Task to array using global variable _SESSION
        function save()
        {
            array_push($_SESSION['list_of_tasks'], $this);
        }

        // Display array of tasks with getAll() - remember it's a static function
        static function getAll()
        {
            return $_SESSION['list_of_tasks'];
        }

        // Delete tasks in array by emptying array - remember it's a static function
        static function deleteAll()
        {
            $_SESSION['list_of_tasks'] = array();
        }


    }


?>
