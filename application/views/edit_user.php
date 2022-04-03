<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<div style="text-align: center;">
    <form method="post">
        <input id="name" name="name" value=<?php echo $name ?>><input name="text" value=<?php echo $text ?>>
        <button type="submit" name="confirmEdit" value=<?php echo $id ?>>Edit</button>
        <button type="submit" name="cancelEdit" value="cancel">Cancel</button>
    </form>

</div>

</body>
</html>
