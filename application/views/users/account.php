<div class="container">
    <h2>Welcome <?php echo $user['first_name']; ?>!</h2>
    <div class="regisFrm">
        <p><b>Name: </b><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
        <p><b>Email: </b><?php echo $user['email']; ?></p>
    </div>
</div>