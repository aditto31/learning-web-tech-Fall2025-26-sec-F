<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration Form</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h2>User Information Form</h2>
    <form action="process.php" method="post">
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age">
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" id="male"> <label for="male" style="display:inline;">Male</label>
            <input type="radio" name="gender" value="Female" id="female"> <label for="female" style="display:inline;">Female</label>
        </div>

        <div class="form-group">
            <label>Skills (Select at least one):</label>
            <input type="checkbox" name="skills[]" value="PHP" id="php"> <label for="php" style="display:inline;">PHP</label>
            <input type="checkbox" name="skills[]" value="HTML" id="html"> <label for="html" style="display:inline;">HTML</label>
            <input type="checkbox" name="skills[]" value="CSS" id="css"> <label for="css" style="display:inline;">CSS</label>
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <select name="country" id="country">
                <option value="">Select Country</option>
                <option value="USA">USA</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="UK">UK</option>
            </select>
        </div>

        <button type="submit">Submit Information</button>
    </form>
</body>
</html>