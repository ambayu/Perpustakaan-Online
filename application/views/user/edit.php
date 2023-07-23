<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>
    <div class="row">
        <div class="col-lg-10">

            <?=form_error('name', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=form_error('jabatan', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=form_error('no_hp', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>
            <?=form_error('username', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>
            <?=form_error('n_pass', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>
            <form action="<?=base_url('user/edit')?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name='name' value="<?=$user['nama']?>" class="form-control" id="inputnama"
                            placeholder="Nama">
                    </div>

                    <input type="hidden" name='id' value="<?=$user['id']?>">
                </div>



                <div class="form-group row">
                    <label for="inputjabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" name='jabatan' value="<?=$user['jabatan']?>" class="form-control"
                            id="inputjabatan" placeholder="Jabatan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputno_hp" class="col-sm-2 col-form-label">Nomor Hp</label>
                    <div class="col-sm-10">
                        <input type="text" name='no_hp' value="<?=$user['no_hp']?>" class="form-control" id="inputno_hp"
                            placeholder="Nomor Hp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name='username' value="<?=$user['username']?>" value='<?=$user['username']?>'
                            class="form-control" id="inputUsername" placeholder="Username">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="inputNewpass" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="n_pass" id="inputnew_pass"
                            placeholder="New Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNewpass" class="col-sm-2 col-form-label">Retype New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="ren_pass" id="inputnew_pass"
                            placeholder="Retypr New Password">
                    </div>
                </div>
                <div class="form-group row ml-auto">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="yakin" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Ganti Password ?</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">

                            <div class="col-sm-3">
                                <img class="img-thumbnail" src='<?=base_url('Asset/img/profil/') . $user['Foto'];?>'>

                            </div>
                            <div class="col-sm-9">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="form-group row justify-content-end">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->