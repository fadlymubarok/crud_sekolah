<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- SweetAlert2 CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                </div>
                <form class="user" action="<?= base_url('login/proses') ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user" id="exampleInputUserName" aria-describedby="UserNameHelp" placeholder="Enter Username..." autofocus>
                        <div class="text-danger"><?= form_error('username') ?></div>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                        <div class="text-danger"><?= form_error('password') ?></div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Done',
                text: "<?= $this->session->flashdata('success') ?>"
            })
        <?php elseif ($this->session->flashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "<?= $this->session->flashdata('error'); ?>"
            })
        <?php endif;
        $this->session->unset_userdata(array('success', 'error'));
        ?>
    </script>
</body>

</html>