<?php
#this is Login form page , if user is already logged in then we will not allow user to access this page by executing isset($_SESSION["uid"])
#if below statment return true then we will send user to their profile.php page
//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (isset($_POST["login_user_with_product"])) {
    //this is product list array
    $product_list = $_POST["product_id"];
    //here we are converting array into json format because array cannot be store in cookie
    $json_e = json_encode($product_list);
    //here we are creating cookie and name of cookie is product_list
    setcookie("product_list", $json_e, strtotime("+1 day"), "/", "", "", TRUE);

}
?>

<div class="wait overlay">
    <div class="loader"></div>
</div>
<div class="container-fluid"></div>

<section class="card mt-5">
    <div class="card-header text-center">
        <h3>Login</h3>
    </div>
    <div class="card-body">
        <form action="config.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="login_user" Value="login">Login</button>

            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none">
                    <small>Forgot password?</small>
                </a>
            </div>

            <div class="panel-footer hidden">
                <div class="alert alert-danger">
                    <h4 id="e_msg"></h4>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
<!-- row -->

<!-- Billing Details -->


<!-- /Billing Details -->


<!-- Shiping Details -->

<!-- /Shiping Details -->

<!-- Order notes -->

<!-- /Order notes -->

<!-- Order Details -->

<!-- /Order Details -->

<!-- /row -->