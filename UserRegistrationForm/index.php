<!DOCTYPE html>
<html>
<head>
    <title>User Registration Form</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
    </script>
</head>
<body>
    <div class="regForm">
    <h2>User Registration Form</h2>
    <h4>Sign up</h4>
    <form id="registrationForm" method="post" action="process_form.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" id="submit" value="Submit">
    </form>
    </div>
</body>
</html>
