<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="text-align: center;">

<form method="post"> <!--Create user-->
    <input type="text" name="name"/>
    <input type="text" name="text"/>
    <input type="submit" name="submit" value="Create User"/>
</form>

<br>
<!--Show all users-->
<?php
if ($users->num_rows() > 0) {
    $idRow = 1;
    foreach ($users->result() as $row) {
        ?>
        </br></br>
        <tr>
            <form method="post">
                <th><?php echo $row->id ?> |
                <th name="name"><?php echo $row->name ?> |</th>
                <th name="text"><?php echo $row->text ?>  </th>
                <!--delete user-->
                <div id=<?php echo $idRow ?>></div>
            </form>
            <button id="delete<?php echo $idRow ?>" name="button1"
                    onclick='deleteMenu(
                    <?php echo $idRow ?>,
                    <?php echo $users->num_rows() ?>,
                    <?php echo $row->id ?>)'> X
            </button>

        </tr>
        <?php
        $idRow++;
    }
} else {
    ?>
    <h1> Nu exista nici un user.</h1>
    <?php
}
?>
</body>
</html>
<script>
    function deleteMenu(idRow, rowsLemgth, db_id) {
        let deleteBtn = "delete";
        for (let i = 1; i <= rowsLemgth; ++i) {
            let key = deleteBtn + i;
            console.log(deleteBtn);
            document.getElementById(i).innerHTML = '';
            document.getElementById(key).style.visibility = 'visible';
        }
        deleteBtn += idRow;
        document.getElementById(deleteBtn).style.visibility = 'hidden';
        let alertBox = document.getElementById(idRow).innerHTML =
            "<br/><div> <button name='confirmButton' value='" + db_id + "'</button>Yes <button>No</button> </div";
    }
</script>
