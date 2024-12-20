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
        <h1 class="text-light mx-2">Thêm mới </h1>
    </div>
    <div class="container">
        <form action="{{route('issues.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Máy tính</label>
                <select name="computer_id" id="" class="form-control">
                    @foreach($computers as $computer)
                    <option value="{{ $computer->id }}">{{ $computer->computer_name }} - {{ $computer->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Người báo cáo sự cố</label>
                <input type="text" class="form-control" name="reported_by">
            </div>
            <div class="form-group">
                <label for="">Thời gian báo cáo</label>
                <input type="date" class="form-control" name="reported_date">
            </div>
            <div class="form-group">
                <label for="">Mô tả chi tiết</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="form-group">
                <label for="">Mức độ sự cố</label>
                <select name="urgency" id="" class="form-control">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="Hight">Hight</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="open">Open</option>
                    <option value="resolve">Resolve</option>
                    <option value="in program">In Program</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="{{ route('issues.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>