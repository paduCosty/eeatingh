<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="text-align: center;">
<table class="table table-bordered table-hover">

</table>
<form method="post"> <!--Create user-->
    <input type="text" name="name"/>
    <input type="text" name="text"/>
    <input type="submit" name="submit" value="Create User"/>
</form>
<br>
<!--Show all users-->
<center>
    <div class='tableBox'>
        <?php
        if ($users->num_rows() > 0) {
            $idRow = 1;
            foreach ($users->result() as $row) {
                ?>

                <form method="post">
                    <table class="table table-dark">

                        <tr>
                            <th><?php echo $row->id ?></th>
                            <th name="name"><?php echo $row->name ?></th>
                            <th name="text"><?php echo $row->text ?></th>
                            <th style="background-color: green; text-align: center;" id="delete<?php echo $idRow ?>"
                                name="button"
                                onclick='deleteMenu(
                                <?php echo $idRow ?>,
                                <?php echo $users->num_rows() ?>,
                                <?php echo $row->id ?>)'> X
                            </th>
                            <th id=<?php echo $idRow ?>></th>
                            <th>
                                <button type="submit" value="<?php echo $row->id ?>" name="edit">Edit</button>
                            </th>
                        </tr>

                    </table>
                </form>
                <?php
                $idRow++;
            }
        } else {
            ?>
            <h1> Nu exista nici un user.</h1>
            <?php
        }
        ?>
    </div>
</center>
<style>
    .tableBox {
        width: 600px;
    }
</style>
</body>
</html>
<script>
    function deleteMenu(idRow, rowsLemgth, db_id) {
        let deleteBtn = "delete";
        for (let i = 1; i <= rowsLemgth; ++i) {
            let key = deleteBtn + i;
            document.getElementById(i).innerHTML = '';
            document.getElementById(key).style.visibility = 'visible';
        }
        deleteBtn += idRow;
        document.getElementById(deleteBtn).style.visibility = 'hidden';
        let alertBox = document.getElementById(idRow).innerHTML =
            "<button style='background-color: red' name='confirmButton' value='" + db_id + "'</button>Yes <button style='background-color: green'>No</button>";
    }

</script>


