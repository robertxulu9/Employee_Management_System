<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="toast show" style="position: absolute; top: 20px; right: 20px;">
                        <div class="toast-header">
                        <strong class="mr-auto">Success</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                        </div>
                        <div class="toast-body">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="toast show" style="position: absolute; top: 20px; right: 20px;">
                                <div class="toast-header">
                                    <strong class="mr-auto">Error</strong>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                                </div>
                                <div class="toast-body">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    <form action="login_handler.php" method="post">
                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <input type="checkbox" id="show-password" class="show-password"> Show Password
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Login</button>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><label href="register.html">Contact Admin to Sign up!</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
        document.getElementById('show-password').addEventListener('change', function () {
            const passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
    </body>
</html>
