<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?=form_error('n_pass', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>

            <div class="container fa-fw">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row text-center">
                            <a class="nav-link pb-0" href="" data-toggle="modal" data-target="#tambahfolder">
                                <i class="fas fa-folder-plus fa-10x"></i><br>
                                <span>Tambah Folder</span></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row text-center">
                            <a class="nav-link pb-0" href="" data-toggle="modal" data-target="#hapus_folder">
                                <i class="fas fa-folder-minus fa-10x"></i><br>
                                <span>Hapus Folder</span></a>
                        </div>
                    </div>
                    <?php foreach ($berkas as $b): ?>
                    <div class="col-md-3 fa-fw">
                        <div class="row text-center">
                            <a class="nav-link pb-0" href="<?=base_url('user/folder/') . $b['id_folder'];?>">
                                <i class="fas fa-folder fa-10x"></i></i><br>
                                <span><?=$b['nama_folder'];?></span></a>
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



<!-- Modal -->
<div class="modal fade" id="tambahfolder" tabindex="-1" aria-labelledby="tambahfolderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahfolderLabel">Tambah Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('user/tambahfolder')?>" method="post">
                    <div class="form-group">
                        <label for="name"> Tulis Nama Folder Baru</label>
                        <input type="text" class="form-control" id="name" name='name' placeholder="Nama Folder">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="hapus_folder" tabindex="-1" aria-labelledby="hapus_folderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_folderLabel">Hapus Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('user/hapus_folder')?>" method="post">

                    <label for="hapus_folder">Pilih Folder Yang Ingin Dihapus :</label>
                    <select class="custom-select" name='menu_id' id='menu_id'>
                        <option value="" selected>Open this select menu</option>
                        <?php foreach ($berkas as $mm): ?>
                        <option value="<?=$mm['id_folder']?>"><?=$mm['nama_folder']?></option>
                        <?php endforeach;?>
                    </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>