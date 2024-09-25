<section class="card mt-5">
    <div class="card-header text-center">
        <h3>Register</h3>
    </div>
    <div class="card-body">
        <form action="config.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password_1">Password</label>
                <input type="password" class="form-control" id="password_1" name="password_1" required>
            </div>
            <div class="form-group">
                <label for="password_2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_2" name="password_2" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="reg_user">Register</button>
        </form>
    </div>
</section>