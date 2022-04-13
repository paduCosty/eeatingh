<html>
<body>
<div class="container">
    <h3>All Users</h3>
    <?php
    if ($data->num_rows() > 0) {
    $idRow = 1;
    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Text</th>
            <th width="220px">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data->result() as $row) {
            ?>

            <tr>
                <form method="post">

                    <!--                        <th>--><?php //echo $row->id ?><!--</th>-->
                    <th name="name"><?php echo $row->name ?></th>
                    <th name="text"><?php echo $row->text ?></th>
                    <th>
                        <buton type="button" id=<?php echo $idRow ?>></buton>
                        <input type="button" id="delete<?php echo $idRow ?>"
                               value="Delete"
                               class="btn btn-danger"
                               name="button"
                               onclick='deleteMenu(
                               <?php echo $idRow ?>,
                               <?php echo $data->num_rows() ?>,
                               <?php echo $row->id ?>)'>
                        <button class="btn btn-info" id="editBtn<?php echo $idRow ?>" type="submit"
                                value="<?php echo $row->id ?>" name="edit">
                            Edit
                        </button>
                    </th>
                </form>

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
        </tbody>
    </table>
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
        let editBtn = "editBtn";
        for (let i = 1; i <= rowsLemgth; ++i) {
            let key = deleteBtn + i;
            document.getElementById(i).innerHTML = '';
            document.getElementById(key).style.visibility = 'visible';
            document.getElementById(editBtn + i).style.visibility = 'visible';
        }
        deleteBtn += idRow;
        document.getElementById(deleteBtn).style.visibility = 'hidden';
        let alertBox = document.getElementById(idRow).innerHTML =
            "<form method='post'>" +
            "<button class='btn btn-info' style='background-color: red' name='confirmButton' value='" + db_id + "'</button>Are you sure? <button class='btn btn-info'  style='background-color: green'>No</button> </form>";
        editBtn += idRow;
        document.getElementById(editBtn).style.visibility = 'hidden';
    }

</script>