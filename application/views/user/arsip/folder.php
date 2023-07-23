<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mb-5">
        <label for="">Sort by :</label>
        <a href="<?=base_url('user/folder/') . $link . '/tgl'?>" class="badge badge-primary">Tanggal</a>
        <a href="<?=base_url('user/folder/') . $link . '/nm'?>" class="badge badge-secondary">Nama</a>
        <a href="<?=base_url('user/folder/') . $link . '/typ'?>" class="badge badge-success">Type</a>


        <form action="<?=base_url('user/folder/') . $link?>" method="post"
            class="form-inline d-flex  md-form form-sm mt-0 float-right">
            <a class="fas fa-search ml-auto mr-4" href="" type="submit"></a>
            <input class="form-control form-control-sm  w-45" type="text" name="search" placeholder="Search"
                aria-label="Search">
        </form>
    </div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg">
            <?=form_error('n_pass', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>

            <div class="container">
                <div class="row">


                    <?php foreach ($berkas as $b): ?>
                    <div class="col-md-3 ">
                        <div class="row text-center">
                            <a data-toggle="modal" data-target="#hapus_file<?=$b['id_surat']?>"
                                class=" text-decoration-none" href="<?=base_url('user/folder/') . $b['id_folder'];?>">

                                <i class="<?=$b['icons']?> fa-10x fa-fw mb"></i>

                                <br>
                                <span><?=$b['Judul'];?></span></a>
                        </div>
                        <div class="form-group" style="margin-left: 40px;margin-top: -9px;">
                            <a href="<?=base_url('user/mendelete/') . $link . '/' . $b['id_surat']?>"
                                class="nav-link pb-0 mb-3"
                                onclick="return confirm('Are you sure you want to delete this item')"><span
                                    class="  fa-layers-counter far fa-trash-alt ">
                                    Delete</span></a>

                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>


        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>


<?php foreach ($berkas as $b): ?>
<!-- Modal -->
<div class="modal fade" id="hapus_file<?=$b["id_surat"];?>" tabindex="-1" aria-labelledby="hapus_file"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_file"> Document : <?=$b["Judul"];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('user/download')?>" method="post" enctype="multipart/form-data">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">

                                <i class="<?=$b['icons']?> fa-10x card-img"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$b['Judul'];?></h5>
                                    <table class="table">

                                        <tbody>
                                            <tr>


                                                <td>Judul Document</td>
                                                <td><?=$b['Judul'];?></td>
                                            </tr>
                                            <tr>


                                                <td>tanggal</td>
                                                <td><?=$b['tanggal'];?></td>
                                            </tr>
                                            <tr>


                                                <td>Keterangan</td>
                                                <td><?=$b['keterangan'];?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?=$link?>" name="link">
                    <input type="hidden" value="<?=$b['id_surat']?>" name="id_surat">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Download</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php endforeach;?>


<!-- Modal -->