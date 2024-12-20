<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Quản Lý Issues</title>
</head>

<body>
    <div class="navbar bg-dark ">
        <h1 class="text-light mx-2">Chi tiết</h1>
        <a href="<?php echo e(route('issues.index')); ?>"><button class="btn btn-success mx-2">Quay lại</button></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="mt-3"><b>Mã vấn đề</b><span class="ml-5"><?php echo e($issue['id']); ?></span></p>
                <p class="mt-3"><b>Tên máy tính</b><span class="ml-5"><?php echo e($issue->computer->computer_name); ?></span></p>
                <p class="mt-3"><b>Người báo cáo </b><span class="ml-5"><?php echo e($issue->reported_by); ?></span></p>
                <p class="mt-3"><b>Ngày báo cáo</b><span class="ml-5"><?php echo e($issue->reported_date); ?></span></p>
                <p class="mt-3"><b>Mô tả</b><span class="ml-5"><?php echo e($issue->description); ?></span></p>
                <p class="mt-3"><b>Mức độ</b><span class="ml-5"><?php echo e($issue->urgency); ?></span></p>
                <p class="mt-3"><b>Trạng thái</b><span class="ml-5"><?php echo e($issue->status); ?></span></p>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\QuanLyMayTinh\resources\views/issues/show.blade.php ENDPATH**/ ?>