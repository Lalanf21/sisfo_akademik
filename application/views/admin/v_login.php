<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Administrator !</h1>
                                        <?= $this->session->flashdata('pesan') ?>
                                    </div>
                                    <form class="user" method="post" action="<?= site_url('admin/auth/proses_login') ?>">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Username" autofocus>
                                            <div class="text-danger">
                                                <?= form_error('username') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                            <div class="text-danger">
                                                <?= form_error('password') ?>
                                            </div>
                                        </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>