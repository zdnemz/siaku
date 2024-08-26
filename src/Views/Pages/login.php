<?php
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
?>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="wrap">
            <div class="p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h1 class="mb-4">Login</h1>
                    </div>
                </div>
                <form action="/login" method="post" class="signin-form">
                    <div class="form-group">
                        <label class="form-control-placeholder" for="email">Email</label>
                        <input type="email" name="email" class="form-control" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-placeholder" for="password">Password</label>
                        <div class="form-control-wrap">
                            <input id="password-field" name="password" type="password" class="form-control" required="">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Masuk</button>
                    </div>
                </form>
                <p class="text-center">Belum punya akun? <a href="/register">Daftar disini</a></p>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto text-danger">Error!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $error; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('liveToast').dataset.errorMessage = "<?php echo htmlspecialchars($error); ?>";
</script>

<?php
unset($_SESSION['error']);
?>