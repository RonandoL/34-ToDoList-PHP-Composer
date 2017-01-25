<?php
    class Task
    {
        private $task;

        function __construct($a_task)
        {
            $this->task = $a_task;
        }

        // SETTER GETTER
        function setTask($new_task)
        {
            $this->task = $new_task;
        }
        function getTask()
        {
            return $this->task;
        }

        // Save Task to array using global variable _SESSION
        function save()
        {
            array_push($_SESSION['list_of_tasks'], $this->task);
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
