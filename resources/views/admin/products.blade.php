@extends('include_admin.main')

@section('title')
Produits
@endsection

@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('status'))
        <div class="alert alert-success">
            {{Session::get('status')}}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Products</h3>
                        </div>
                        <!-- /.card-header -->
                        <input type="hidden" {{$inc = 1}}>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Num.</th>
                                    <th>Picture</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product Price</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produits as $produit)
                                <tr>
                                    <td>{{$inc}}</td>
                                    <td>
                                        <img src="{{asset('storage/products_img/'.$produit->product_image)}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="{{$produit->product_image}}">
                                    </td>
                                    <td>{{$produit->product_name}}</td>
                                    <td>{{$produit->product_price}}</td>
                                    <td>{{$produit->product_category}}</td>
                                    <td>
                                        @if($produit->status == 1)
                                                <form method="POST" action="{{url('admin/unactprod/'.$produit->id)}}">
                                                    @method('PUT')
                                                    @csrf
                                                <input type="submit" class="btn btn-success" value="Unactivate">
                                                </form>
                                            @else
                                            <form method="POST" action="{{url('admin/actprod/'.$produit->id)}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="submit" class="btn btn-warning"value="Active">
                                            </form>
                                            @endif

                                        <a href="{{url("admin/editprod/$produit->id")}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>

                                        <form method="POST" action="{{url('admin/delprod/'.$produit->id)}}">@csrf @method('DELETE')<button type="submit"  class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></button></form>

                                    </td>
                                </tr>
                                <input type="hidden" {{$inc++}}>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Num.</th>
                                    <th>Picture</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product Price</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
        if (confirmed){
            window.location.href = link;
        };
    });
});
</script>
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endsection
@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
