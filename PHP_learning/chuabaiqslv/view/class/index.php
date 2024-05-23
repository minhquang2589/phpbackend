<?php
$this->view('layout/header');
?>
<div class="container">
    <div class="header d-flex justify-content-between">
        <h3>Quan ly lop hoc</h3>
        <a href="<?= site_url("class/addnew")  ?>" class="btn btn-primary">Them moi</a>
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
                        <th>Thao tac</th>
                    </tr>
                </thead>
                <?php
                foreach ($lstClass as $class) {
                ?>
                    <tr>
                        <td><?php echo $class['name'] ?></td>
                        <td><a class="btn btn-primary mr-2" href="<?php echo site_url("class/edit/") . $class["id"]; ?>">Cap nhat</a>
                            <a data-id="<?php echo $class['id'] ?>" class="btn btn-danger btn-delete ml-2" href="#">Xoa</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                <button id="cf_delete" type="button" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<form id="deleteForm" action="<?php echo site_url('class/delete') ?>" method="post">
    <input type="hidden" name="id" id="id" value="" />
</form>

<script type="module">
    const handleClickDelete = () => {
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            let className = $(this).parent().siblings().first().text();
            let id = $(this).data('id');
            $('#id').val(id);
            $('#deleteModal .modal-body').html(`Bạn có chắc chắn muốn xóa lớp <b>${className}</b> không?`);
            $('#deleteModal').modal('show');
        });

        $('#cf_delete').on('click', function(e) {
            e.preventDefault();
            let formData = $('#deleteForm').serialize();
            console.log(formData);
            $.ajax({
                url: $('#deleteForm').attr('action'),
                method: 'post',
                data: formData,
                success: function(res) {
                    console.log(res);
                    if (res) {
                        // window.location.reload();
                        let data = JSON.parse(res);
                        if (data.status) {
                            window.location.reload();
                        } else {
                            toastr.error(data.message);
                            $('#deleteModal').modal('hide');
                        }
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    }

    $(document).ready(function() {
        handleClickDelete();
    });
</script>

<?php
$this->view('layout/footer');
?>