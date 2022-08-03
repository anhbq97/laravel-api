@extends('layouts.admin')

@section('title')
Admin Manager
@endsection

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <h2>Danh sách sản phẩm</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <td>Thương Hiệu</td>
                <td>Danh Mục</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td>john@example.com</td>
                <td>john@example.com</td>
            </tr>
            
            </tbody>
        </table>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')
    @parent
@endsection
