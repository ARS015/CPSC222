<?php
session_start();
function readAuthFile($file)
{
    $users = array();
    if(file_exists($file))
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line)
        {
            $parts = explode("\t", $line);
            if(count($parts) >= 2)
                $users[trim($parts[0])] = trim($parts[1]);
        }
    }
    return $users;
}

function Authentication($username, $password)
{
    $users = readAuthFile("auth.db");
    if(isset($users[$username]))
        return password_verify($password, $users[$username]);
    return false;
}

function showUserList()//This stupid thing breaks when fidding with something completely unrelated
{
    $file = "/etc/passwd";
    if(!file_exists($file))
    {
        echo "<p><b>Error:</b> Cannot read $file.</p>";
        return;
    }
    echo "<h2>User list</h2>";
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Username</th><th>Password</th><th>UID</th><th>GID</th>";
    echo "<th>Display Name</th><th>Home Directory</th><th>Default Shell</th>";
    echo "</tr>";
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line)
    {
        $f = explode(":", $line);//This is the delimiting part, don't forget
        if(count($f) < 7) continue;//A regular if statement doesn't want to work here 
        echo "<tr>";
        echo "<td>" . htmlspecialchars($f[0])       . "</td>";
        echo "<td>" . htmlspecialchars($f[1])       . "</td>"; 
        echo "<td>" . htmlspecialchars($f[2])       . "</td>"; 
        echo "<td>" . htmlspecialchars($f[3])       . "</td>"; 
        echo "<td>" . htmlspecialchars($f[4])       . "</td>"; 
        echo "<td>" . htmlspecialchars($f[5])       . "</td>"; 
        echo "<td>" . htmlspecialchars(trim($f[6])) . "</td>"; 
        echo "</tr>";
    }
    echo "</table>";
}

function showGroupList()
{
    $file = "/etc/group";
    if(!file_exists($file))
    {
        echo "<p><b>Error:</b> Cannot read $file.</p>";
        return;
    }
    echo "<h2>Group list</h2>";
    echo "<table border=1>";
    echo "<tr><th>Group Name</th><th>Password</th><th>GID</th><th>Members</th></tr>";
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line)
    {
        $f = explode(":", $line);//Delimit
        if(count($f) >= 4)
        {
         echo "<tr>";
         echo "<td>" . htmlspecialchars($f[0])."</td>"; 
         echo "<td>" . htmlspecialchars($f[1])."</td>"; 
         echo "<td>" . htmlspecialchars($f[2])."</td>"; 
         echo "<td>" . htmlspecialchars(trim($f[3]))."</td>"; 
         echo "</tr>";
        }
    }
    echo "</table>";
}

function showSyslog()
{
    $file = "/var/log/syslog";
    if(!file_exists($file))//Had to change syslog permission to access but does work otherwise
    {
        echo "<p><b>Error:</b> Cannot read $file.</p>";
        return;
    }
    echo "<h2>Syslog</h2>";
    echo "<table border=1>";
    echo "<tr><th>Date</th><th>Host Name</th><th>Application[PID]</th><th>Message</th></tr>";
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line)
     {
        $parts = preg_split('/\s+/',$line,5);
        if (count($parts) < 5) continue;
         $date = "{$parts[0]} {$parts[1]} {$parts[2]}";
         $host = $parts[3];
         $appmsg = explode(":",$parts[4],2);
         $app = $appmsg[0];
         $message = trim($appmsg[1] ?? "");
	 
	 echo "<tr>";
	 echo "<td>". htmlspecialchars($date) ."</td>";
	 echo "<td>". htmlspecialchars($host) ."</td>";
	 echo "<td>". htmlspecialchars($app) ."</td>";
	 echo "<td>". htmlspecialchars($message) ."</td>";
	 echo "</tr>";
     }
    echo "</table>";
}

$FormFilled = ($_SERVER['REQUEST_METHOD'] === 'POST');
$error      = "";

if($FormFilled)
{
    $username = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['username']);
    $password = $_POST['password'];

    if(Authentication($username, $password))
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    }
    else
    {
        $error = "Authorization Failed: Invalid username or password.";
    }
}

$LoggedIn= isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$page= isset($_GET['page']) ? (int)$_GET['page'] : null;
$validPages= array(1, 2, 3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CPSC222 Final Exam</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <style>
        body  { font-family: "Times New Roman", Times, serif; margin: 10px 20px; }
        h1    { font-size: 2.2em; font-weight: bold; }
        h2    { font-size: 1.4em; font-weight: bold; margin-top: 12px; }
        table { border-collapse: collapse; font-size: 0.95em; }
        th, td { padding: 2px 8px; }
        hr    { margin: 6px 0; }
        ul    { margin: 4px 0 4px 20px; }
        li    { margin: 2px 0; }
        a     { color: #551A8B; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h1>CPSC222 Final Exam</h1>

<?php if($LoggedIn): ?>

    <b>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?><!Don't have to fight with this if use endif>
    (<a href="final_logout.php">Log Out</a>)</b>
    <br/>

    <?php if($page !== null): ?>

        <a href="final.php">&lt; Back to Dashboard</a>
        <br/><br/>

        <?php
        if(!in_array($page, $validPages))
        {
            echo "<p class='error'>Error: Invalid page."
               . "Please select a valid report from the Dashboard.</p>";
        }
        elseif($page == 1) { showUserList();}
        elseif($page == 2) { showGroupList();}
        elseif($page == 3) { showSyslog();}
        ?>

    <?php else: ?>

        <br/>
        Dashboard:
        <ul>
            <li><a href="final.php?page=1">User list</a></li>
            <li><a href="final.php?page=2">Group list</a></li>
            <li><a href="final.php?page=3">Syslog</a></li>
        </ul>

    <?php endif; ?><!THIS IS SO MUCH EASIER THAN FIGHTING SPECIAL CHARS THING>

<?php else: ?>

    <?php if($error != ""): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        Username: <input type="text"     name="username"/><br/>
        Password: <input type="password" name="password"/><br/>
        <input type="submit" name="login" value="Login"/>
    </form>

<?php endif; ?>

<hr/>
<p><?php echo date("Y-m-d h:i:s A"); ?></p>

</body>
</html>
