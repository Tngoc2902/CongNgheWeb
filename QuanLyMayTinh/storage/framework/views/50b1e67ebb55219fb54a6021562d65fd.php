<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Quản Lý Sự Cố</title>
</head>

<body>
    <div class="navbar bg-dark ">
        <h1 class="text-light mx-2">Sửa thông tin vấn đề </h1>

    </div>
    <div class="container">
        <form action="<?php echo e(route('issues.update',$issue->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="">Máy tính</label>
                <select name="computer_id" id="" class="form-control">
                    <?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($computer->id); ?> " <?php echo e($issue->computer_id==$computer->id?'selected': ''); ?>><?php echo e($computer->computer_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Người báo cáo sự cố</label>
                <input type="text" value="<?php echo e($issue->reported_by); ?>" class="form-control" name="reported_by">
            </div>
            <div class="form-group">
                <label for="">Thời gian báo cáo</label>
                <input type="datetimelocal" value="<?php echo e($issue->reported_date); ?>" class="form-control" name="reported_date">
            </div>
            <div class="form-group">
                <label for="">Mô tả chi tiết vấn đề </label>
                <input type="text" class="form-control" value="<?php echo e($issue->description); ?>" name="description">
            </div>
            <div class="form-group">
                <label for="">Mức độ sự cố</label>
                <select name="urgency" id="" class="form-control">
                    <option value="Low" <?php echo e($issue->urgency=='Low'?'selected':''); ?>>Low</option>
                    <option value="Medium" <?php echo e($issue->urgency=='Medium'?'selected':''); ?>>Medium</option>
                    <option value="Hight" <?php echo e($issue->urgency=='Hight'?'selected':''); ?>>Hight</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-control">
                    <option value="open" <?php echo e($issue->status=='Open'?'selected':''); ?>>open</option>
                    <option value="Resolved" <?php echo e($issue->status=='Resolved'?'selected':''); ?>>Resoloved</option>
                    <option value="In Progress" <?php echo e($issue->status=='In Progress'?'selected':''); ?>>In Program</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Sửa</button>
            <a href="<?php echo e(route('issues.index')); ?>" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\QuanLyMayTinh\resources\views/issues/edit.blade.php ENDPATH**/ ?>