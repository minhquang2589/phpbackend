<?php
$this->view('layout/header');
?>
<div class="container">
    <div class="header d-flex justify-content-between">
        <h3>Quan ly sinh vien</h3>
        <a href="#" class="btn btn-primary">Them moi</a>
    </div>
    <div class="row">
        <div class="col-3">
            <?php
            $this->view('layout/sidebar');
            ?>
        </div>
        <div class="col-9">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Ten</th>
                        <th>Lop</th>
                        <th>Nam sinh</th>
                        <th>Gioi tinh</th>
                        <th>Mon hoc</th>
                        <th>Thao tac</th>
                    </tr>
                </thead>
                <?php
                foreach ($students as $student) {
                ?>
                    <tr>
                        <td><?php echo $student['name'] ?></td>
                        <td><?php echo $student['class_id'] ?></td>
                        <td><?php echo $student['birthday'] ?></td>
                        <td><?php echo $student['gender'] ==  1 ? 'Nam' : 'Nu' ?></td>
                        <td></td>
                        <td><a class="btn btn-primary mr-2" href="#">Cap nhat</a><a class="btn btn-danger" href="#">Xoa</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
$this->view('layout/footer');
?>