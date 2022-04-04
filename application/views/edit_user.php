<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<head>
    <title>Edit User</title>
</head>
<body>
<h2 style="text-align: center"> User edit Page</h2>
<div style="text-align: center;">
    <form method="post">
        <input type="text" id="name" name="name" value="<?php echo $name ?>"><input name="text" value="<?php echo $text ?>">
        <button type="submit" name="confirmEdit" value="<?php echo $id ?>">Edit</button>
        <button type="submit" name="cancelEdit" value="cancel">Cancel</button>
    </form>

</div>

</body>
</html>
