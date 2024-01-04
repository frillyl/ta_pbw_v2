<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | <?= $sub ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Font: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F8F6F2;
            font-family: "Montserrat", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* 100% viewport height */
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <b>
                            <h3 class="card-title text-center">MASUK</h3>
                        </b>
                        <p class="card-text text-center">Silahkan Masuk Terlebih Dahulu</p>

                        <?php
                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <?php foreach ($errors as $key => $value) { ?>
                                        <li><?= esc($value) ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <?php
                        if (session()->getFlashdata('pesan')) {
                            echo '<div class="alert alert-warning" role="alert">';
                            echo session()->getFlashdata('pesan');
                            echo '</div>';
                        }

                        if (session()->getFlashdata('success')) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo session()->getFlashdata('success');
                            echo '</div>';
                        }
                        ?>

                        <?php echo form_open('login/auth') ?>
                        <div class="mb-3">
                            <b><label for="email" class="form-label">Email</label></b>
                            <input type="email" name="email" class="form-control" id="email" placeholder="johndoe@mail.com" aria-describedby="Email" required>
                        </div>
                        <div class="mb-3">
                            <b><label for="password" class="form-label">Password</label></b>
                            <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
                        </div>
                        <center><button type="submit" class="btn" style="background-color: #8F3797; color: #fff">Masuk</button></center>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- ALERT JS -->
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
</body>

</html>