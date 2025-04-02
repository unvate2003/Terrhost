<ul>
<?php
    $item = ["Student 1", "Student 2", "Student 3", "Trung Tri"];
    foreach ($item as $item) {
        echo "<li>$item</li>";
    }
    
    
    
    
    $now = new DateTime();
    echo "Today is " . $now->format('d-m-Y');
?>


<form action="process.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Submit">
</form>
</ul>