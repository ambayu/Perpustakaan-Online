<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg">
            <?=form_error('menu_id', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>
            <?=form_error('url', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>
            <?=form_error('title', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>
            <?=form_error('icons', '<div class="alert alert-danger" role="alert">
          ', ' </div>');?>

            <?=$this->session->flashdata('message');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewmenu">
                Add New SubMenu
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;foreach ($Submenu as $sm): ?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$sm['title'];?></td>
                        <td><?=$sm['menu'];?></td>
                        <td><?=$sm['url'];?></td>
                        <td><?=$sm['icons'];?></td>
                        <td><a class="badge badge-pill badge-success" href="" data-toggle="modal"
                                data-target="#Mymodal<?=$sm['id']?>">
                                Edit</a>
                            <a class="badge badge-danger" href="<?=base_url('menu/sqdelete/') . $sm['id'];?>">delete</a>
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
<div class="modal fade" id="addnewmenu" tabindex="-1" role="dialog" aria-labelledby="addnewmenu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewmenu">Add New SubMenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/sub_menu')?>" method="post">
                    <div class="form-group">
                        <p>Menu:</p>
                        <select class="custom-select" name='menu_id' id='menu_id'>
                            <option value="" selected>Open this select menu</option>
                            <?php foreach ($menu as $mm): ?>
                            <option value="<?=$mm['id']?>"><?=$mm['menu']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name='title' placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name='url' placeholder="Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icons" name='icons' placeholder="icons">
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


<?php $i = 1;foreach ($Submenu as $m): ?>
<!-- Modal -->
<div class="modal fade" id="Mymodal<?=$m['id'];?>" tabindex="-1" role="dialog" aria-labelledby="Mymodal<?=$m['id'];?>"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Mymodal<?=$m['id'];?>">Edit Menu : <?=$m['menu'];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/sqedit')?>" method="post">
                    <div class="form-group">
                        <p>Menu:</p>
                        <input type="hidden" name='id' value="<?=$m['id']?>">
                        <select class="custom-select" name='menu_id' id='menu_id'>

                            <?php foreach ($menu as $mm): ?>

                            <?php if ($m['idme'] == $mm['id']): ?>
                            <option selected value="<?=$mm['id']?>"><?=$mm['menu']?></option>
                            <?php else: ?>
                            <option value="<?=$mm['id']?>"><?=$mm['menu']?></option>
                            <?php endif;?>

                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Title:</p>
                        <input type="text" value="<?=$m['title']?>" class="form-control" id="title" name='title'
                            placeholder="Title">
                    </div>
                    <div class="form-group">
                        <p>Url:</p>
                        <input type="text" value="<?=$m['url']?>" class="form-control" id="url" name='url'
                            placeholder="Url">
                    </div>
                    <div class="form-group">
                        <p>Icons:</p>
                        <input type="text" value="<?=$m['icons']?>" class="form-control" id="icons" name='icons'
                            placeholder="icons">
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