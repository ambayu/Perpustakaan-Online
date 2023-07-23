<body class="bg-gradient-danger">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-position-x: 49%;">
                            </div>
                            <div class="col-lg-6">

                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 ">EBOOK ELEKTRONIK
                                            <hr>
                                        </h1>
                                        <i class="fas fa-book-reader fa-6x"
                                            style="float: left; color: #e44738;width: 95px;margin-top: 14px;margin-left: -9px;margin-right: 11px;"></i>

                                        <div>
                                            <h1 class="h4 text-gray-900 mb-4 text-left  ml-2">
                                                <br>E-EBOOK<br>ELEKTRONIK<br>
                                                EBOOK SRG
                                            </h1>
                                        </div>
                                    </div>

                                    <?=$this->session->flashdata('message');?>
                                    <form class="user" method="post" action="<?=base_url('auth')?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name"
                                                name="name" placeholder="Username" value=<?=set_value('name');?>>
                                            <?=form_error('name', '<small class="text-danger pl-3">', ' </small>')?>
                                        </div>
                                        <div class="form-group">

                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password">
                                            <?=form_error('password', '<small class="text-danger pl-3">', ' </small>');?>
                                        </div>

                                        <!-- <button type='submit' class="btn btn-primary btn-user btn-block"> -->
                                        <button type='submit' class="btn btn-danger btn-user btn-block">
                                            Login
                                        </button>
                                        <div class="form-group">

                                        </div>



                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('auth/registration'); ?>">Create an
                                            Account!</a>
                                    </div>
                                    <br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>