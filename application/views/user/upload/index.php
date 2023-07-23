<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?=form_error('n_pass', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>


            <form action="<?=base_url('user/editp')?>" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Judul Buku</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Judul Buku" name="j_surat"
                        aria-label="judul buku" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Jenis Folder</label>
                    </div>
                    <select name='fn' class="custom-select" id="inputGroupSelect01">
                        <option selected value="">Choose...</option>
                        <?php foreach ($nama_folder as $nf): ?>
                        <option value="<?=$nf['id_folder']?>"><?=$nf['nama_folder']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Tanggal Buku</span>
                    </div>
                    <input type="text" class="datepicker" name="tanggal" aria-label="judul buku"
                        aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Keterangan Buku</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Keterangan Buku" name="k_surat"
                        aria-label="Keterangan buku" aria-describedby="basic-addon1">
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Foto Buku</div>
                    <div class="col-sm-10">
                        <div class="row">

                            <div class="col-sm-3">
                                <img class="img-thumbnail" src='<?=base_url('Asset/img/profil/placeholder.png');?>'
                                    id="image-preview" alt="image preview">

                            </div>

                            <div class="col-sm-9">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image-source"
                                        onchange="previewImage();">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload Buku</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="doc" aria-describedby="inputGroupFileAddon01"
                            name="doc">
                        <label class="custom-file-label" for="doc">Choose Buku</label>
                    </div>
                </div>
                <div class="from-group">
                    <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- /.container-fluid -->

</div>