<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div>
        <?php foreach ($berkas as $b): ?>
        <embed height="900px" width="100%"
            src="<?=base_url('Asset/document/') . $b['nama_folder'] . '/' . $b['document_file'];?>">
        <?php endforeach;?>
    </div>
</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->