<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?=form_error('n_pass', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>

                        <th scope="col">Hak Akses</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;foreach ($Submenu as $sm): ?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$sm['username'];?></td>
                        <td><?=$sm['nama'];?></td>
                        <td><?=$sm['menu'];?></td>
                        <td><a class="badge badge-pill badge-warning" href="" data-toggle="modal"
                                data-target="#Mymodal<?=$sm['id']?>">
                                Change Password</a>
                            <a class="badge badge-pill badge-success" href="" data-toggle="modal"
                                data-target="#Mymodals<?=$sm['id']?>">
                                Change Hak Akses</a>
                            <a class="badge badge-danger" href="<?=base_url('menu/adelete/') . $sm['id'];?>">delete</a>
                        </td>
                    </tr>
                    <?php $i++;endforeach;?>

                </tbody>
            </table>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>

<!-- Modal -->

<?php $i = 1;foreach ($Submenu as $m): ?>
<!-- Modal -->
<div class="modal fade" id="Mymodal<?=$m['id'];?>" tabindex="-1" role="dialog" aria-labelledby="Mymodal<?=$m['id'];?>"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Mymodal<?=$m['id'];?>">Edit Password : <?=$m['nama'];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/account')?>" method="post">
                    <div class="form-group">
                        <p>Menu:</p>
                        <input type="hidden" name='id' value="<?=$m['id']?>">

                    </div>
                    <div class="form-group">
                        <p>Name:</p>
                        <input type="text" value="<?=$m['nama']?>" readonly class="form-control" id="Nama" name='nama'
                            placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <p>Username:</p>
                        <input type="text" value="<?=$m['username']?>" readonly class="form-control" id="url" name='url'
                            placeholder="Url">
                    </div>
                    <div class="form-group">
                        <p>Password:</p>
                        <input type="password" class="form-control" id="n_pass" name='n_pass'
                            placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <p>Retype Password:</p>
                        <input type="password" class="form-control" id="ren_pass" name='ren_pass'
                            placeholder="Retype New Password">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php $i++;endforeach;?>
<!-- End of Main Content -->


<?php $i = 1;foreach ($Submenu as $m): ?>
<!-- Modal -->
<div class="modal fade" id="Mymodals<?=$m['id'];?>" tabindex="-1" role="dialog" aria-labelledby="Mymodals<?=$m['id'];?>"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Mymodals<?=$m['id'];?>">Change Hak Akses : <?=$m['nama'];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/achange')?>" method="post">
                    <input type="hidden" name="id" value="<?=$m['id'];?>">
                    <select class="custom-select" name='menu_id' id='menu_id'>
                        <option value="" selected>Open this select menu</option>
                        <?php foreach ($akses as $mm): ?>
                        <?php if ($m['id'] == $mm['id']): ?>
                        <option selected value="<?=$mm['id']?>"><?=$mm['menu']?></option>
                        <?php else: ?>
                        <option value="<?=$mm['id']?>"><?=$mm['menu']?></option>
                        <?php endif;?>
                        <?php endforeach;?>
                    </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php $i++;endforeach;?>