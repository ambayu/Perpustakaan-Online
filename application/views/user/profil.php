<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src='<?=base_url('Asset/img/profil/') . $user['Foto'];?>' class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?=$user['nama'];?></h5>
                    <table class="table">

                        <tbody>
                            <tr>


                                <td>Nama</td>
                                <td><?=$user['nama'];?></td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td><?=$user['jabatan'];?></td>
                            </tr>
                            <tr>

                                <td>Nomor Hp</td>
                                <td><?=$user['no_hp'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->