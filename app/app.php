<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/tasks.php";

    session_start();                          // For global variable, saving in browser cache
    if (empty($_SESSION['list_of_tasks'])) {
        $_SESSION['list_of_tasks'] = array();
    }

    $app = new Silex\Application();

    $app->get("/", function() {

        $output = "";                             // 1. create output variable that will hold HTML & PHP Tasks
        $all_tasks = Task::getAll();      // 2. create variable to hold array of tasks using key
                                                  // 3. print out home page stuff above list of tasks and form
        $output .= "
            <!DOCTYPE html>
            <html>
              <head>
                <meta charset='utf-8'>
                <title>To Do List</title>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
              </head>

              <body>
                <div class='container'>
                  <h1>To Do List</h1>
                  <div class='row'>
                    <div class='col-md-4'>
                      <ul>
        ";

        if (!empty($all_tasks)) {                     // 3. if variable is NOT empty, then print tasks
          foreach ($all_tasks as $task) {             // 4. Roll through array of tasks, print each task
            $output .= "<li>" . $task->getDescription() . "</li>";  // 5. prints task into <li> using get method
          }
        }
                                                  // 6. prints form below the list of tasks - still home page
        $output .= "
                      </ul>
                      <form action='/tasks' method='post'>
                        <div class='form-group'>
                          <label for='description'>Enter Task to do</label>
                          <input type='text' name='description' id='description' class='form-control' placeholder='wash dishes'>
                        </div>
                        <button type='submit' class='btn btn-lg btn-primary'>Submit Task</button>
                      </form>
                    </div> <!-- .col-md-4 -->
                  </div> <!-- .row -->
                </div> <!-- .container -->
              </body>
            </html>
        ";

        return $output;

    });

    $app->post('/tasks', function() {            // 7. New route to confirmation page
        $task = new Task($_POST['description']);       // 8. Instantiate task using $_POST, save to variable
        $save = $task->save();                  // 9. Save new task into array

        return "
            <h3>Your new task</h3>
            <p>" . $task->getDescription() . "</p>
            <p><a href='/'>Home</a>
        ";
    });

    return $app;









?>
