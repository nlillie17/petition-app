<?php                                           // functions.php
  require_once "login.php";
  @$connection = new mysqli($hn, $un, $pw, $db);
  if ($connection->connect_error)
    die($connection->connect_error);
  
  function findUser($username, $password){
    $result = queryMysql("SELECT * FROM user WHERE username='$username' AND password='$password'");
    return $result;
  }
  // function insertUser($name, $email, $username, $pass1, $class, $dorm, $pass2){
//     if($pass1 == $pass2) {
//      if(checkEmail($email) && checkUsername($username)) {
//        $query = "INSERT INTO user (NULL, $name, $email, $username, $password, $class, $dorm)";
//        $result = $conenction->query($query);
//        if(!$result) {
//          echo "User insert error";
//        }
//      }
//     }
//   }
  
  function checkEmail($email) {
    $pattern = '/\w{1,15}\b^[0-9]{2}$@cmc\.edu/';
    // preg_match($pattern,$email,@$matches,PREG_OFFSET_CAPTURE);
    // print_r($matches);
    // $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

    if (preg_match($pattern, $email) === 1) {
      echo "valid email";
        return true;
    }
    return true;
  }
  
  function getUserID($username){
    $result = queryMysql("SELECT * FROM user WHERE username='$username'");
    $result->data_seek(0);
    print_r($result);
    $id = $result->fetch_assoc()['user_id'];
    echo "id is " . $id;
    return $id;
  }

  function insertPetitions($title, $body){
    //get session username
    session_start();
    var_dump($_SESSION);
    $username = $_SESSION['un'];
    print_r($username);
    $userID = getUserID($username);
    $result = "INSERT INTO petitions VALUES ('$userID','$title','$body','NULL',0,CURRENT_TIMESTAMP)";
    $conn = new mysqli("localhost", "root", "", "petition");
    $result = $conn->query($result);
    if(!$result) {
      echo "User insert error";
      echo "<a href='feed.php'>Feed</a>";
      die();
    }
    echo "<a href='feed.php'>Feed</a>";
  }

  function getPopularPetitions(){
    $result = queryMysql("SELECT * FROM petitions ORDER BY num_backers DESC");
    return $result;
  }

  function getPetitions(){
    $result = queryMysql("SELECT * FROM petitions ORDER BY time_submitted DESC");
    return $result;
  }
  //returns true if username is unique
  function uniqueUser($username) {
    $username = sanitizeString($username);
    echo $username."<br>";
    $connection = new mysqli("localhost", "root", "", "petition");
    $query = queryMysql("SELECT * FROM user WHERE username = '$username'");
    $rowNum = @mysqli_num_rows($query);
      if($rowNum > 0) {
        echo "Username exists<br>";
        echo "Please pick another username<br>";
        echo "<a href='homePage.php'>Home</a>";
        return false;
      }
      else {
        return true;
      }
  //}
  }
  
  function displayAll($result){
     if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>name</th>";
                echo "<th>email</th>";
                echo "<th>username</th>";
                echo "<th>password</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
  }
  function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }
  function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }
  function destroySession() {
    $_SESSION=array();
    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');
    session_destroy();
  }
  function sanitizeString($var) {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }
  function showProfile($user) {
    if (file_exists("$user.jpg")) {
      echo "<img src='$user.jpg'><br>";
    }
    
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    if ($result->num_rows) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    }
  }
  
?>
