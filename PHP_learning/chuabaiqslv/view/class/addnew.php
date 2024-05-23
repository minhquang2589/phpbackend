<?php
$this->view('layout/header');
?>
<div class="container">
    <div class="header d-flex justify-content-between">
        <h3>Them moi</h3>
        <a href="#" class="btn btn-primary">Quay lai</a>
    </div>
    <div class="row">
        <div class="col-3">
            <?php
            $this->view('layout/sidebar');
            ?>
        </div>
        <div class="col-9">
            <form action="<?= site_url("class/save") ?>" method="post">
                <div class="form-group">
                    <label for="name">Ten lop</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhap ten lop">
                    <button type="submit" class="btn btn-primary mt-2">Luu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$this->view('layout/footer');
?>