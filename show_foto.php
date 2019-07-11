<?php 
   //phpinfo(); 
?>
<?php

echo $_SERVER["PATH_INFO"]."</br>";

$uid=$_SERVER["PATH_INFO"];

if ( isset($uid) ) {
    $uid=preg_replace('/[^0-9]/','',$uid);
    $uid=$uid+0;
}
else {
    $uid=0;
}

echo "uid=".$uid."<br>";

//                     host                 username      passwd       database
$mysqli = new mysqli("dbfotos.ucema.edu.ar", "fotoslectura", "fotoslectura", "fotos");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT img FROM fotos WHERE erased=0 AND selected=1 AND user_id=? LIMIT 1"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("i", $uid)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
     echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$stmt->bind_result($foto);

while ($stmt->fetch()) {
    echo "<img src=\"data:image/jpg;base64," . base64_encode($foto). "\" width=60, height=60, alt=\"$uid.jpg\">";
}
$res->close();
?>
