<!-- header.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Quản lý sản phẩm</title>
    <style>
    table {
        width: 60%;
        margin: auto;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
    }

    .btn {
        padding: 5px 10px;
        text-decoration: none;
        color: white;
        border-radius: 5px;
    }

    .btn-edit {
        background-color: #007bff;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-add {
        background-color: #28a745;
        display: block;
        margin: 20px auto;
        width: 100px;
        text-align: center;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Administration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#">Trang chủ</a>
                    <a class="nav-link" href="#">Trang chính</a>
                    <a class="nav-link" href="#">Thể loại</a>
                    <a class="nav-link" href="#">Tác giả</a>
                    <a class="nav-link" href="#">Bài viết</a>
                </div>
            </div>
        </div>
    </nav>