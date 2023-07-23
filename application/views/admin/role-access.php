<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>
    <h5>Role : <?=$role['role'];?></h5>
    <div class="row">
        <div class="col-lg-6">
            <?=form_error('menu', '<div class="alert alert-danger" role="alert">
            Menu tidak boleh kosong!.',
    ' </div>');?>
            <?=form_error('nama', '<div class="alert alert-danger" role="alert">
            Menu tidak boleh kosong!.',
    ' </div>');?>

            <?=$this->session->flashdata('message');?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;foreach ($menu as $r): ?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$r['menu'];?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1"
                                    <?=check_access($role['id'], $r['id']);?> data-role="<?=$role['id']?>"
                                    data-menu="<?=$r['id']?>">

                            </div>
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