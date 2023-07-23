<body class="bg-gradient-danger">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <br><br>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <br><br><br>
                            <form class="user" method='post' action="<?=base_url('auth/registration')?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name"
                                        placeholder="Username" set_value=<?=set_value('name');?>>

                                    <?=form_error('name', '<small class="text-danger pl-3">', ' </small>');?>



                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="Password"
                                            name="password" placeholder="Password">
                                        <?=form_error('password', '<small class="text-danger pl-3">', ' </small>');?>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="re_password"
                                            name="re_password" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger btn-user btn-block">
                                    Register Accounts
                                </button>


                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?=base_url('auth');?>">Already have an account? Login!</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>