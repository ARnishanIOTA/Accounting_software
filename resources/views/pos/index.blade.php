
@extends('layouts.admin')

@section('title', 'POS( Point Of Sale)')
@section('content')
{{--        <!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}

{{--</head>--}}
{{--<body>--}}
{{--<title>Page Title</title>--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
{{--<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />--}}
{{--<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>--}}
<script src="{{ asset('public/datatable/assets/demo/datatables-demo.js') }}"></script>
<style>
    .price-features{
        margin-left: -57px;
    }
    .text-white{
        font-size: 14px !important;
    }
    .btn-apply {
        color: #ffffff;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 500px;
        padding-left: 6px;
        padding-right: 7px;
        border-color: #3C4B64;
        background-color: #3C4B64;
        box-shadow: 0 4px 6px rgba(30, 31, 57, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }
    .btn-extra-sm{
        font-size: 12px;
    }
    .table-header{
        background: #3C4B64;
    }
    .pricing-header{
        height: 239px;
        margin-left: -16px;
    }
    .background-white{
        background: #fff;
    }
</style>


<div class="content">
    <div class="container">



        <div class="row">
            <div class="col-lg-6">

                <div class="price_card text-center">
                    <ul class="price-features">
                        <table class="table">
                            <thead class="table-header">
                            <tr>
                                <th class="text-white">Name</th>
                                <th class="text-white">Quantity</th>
                                <th class="text-white">Unit Price</th>
                                <th class="text-white">Sub Total</th>
                                <th class="text-white">Action</th>

                            </tr>
                            </thead>
                            <tbody class="background-white">

                            <tr>
                                <td>gear lever</td>
                                <td>
                                    <form action="http://localhost:8080/My_Project/Inventory_Management_System/cat-update/370d08585360f5c568b18d1f2e4ca1df" method="post">
                                        <input type="hidden" name="_token" value="oumbygipURtb7L0KxVTD3PF6qiqItZQ3bpQ8lPzH">                            <input type="number" name="qty" value="1" style="width: 40px;">
                                        <button type="submit" class="btn btn-extra-sm btn-apply" style="margin-top :-2px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>1400</td>
                                <td>1400</td>
                                <td><a href="http://localhost:8080/My_Project/Inventory_Management_System/cart-remove/370d08585360f5c568b18d1f2e4ca1df"><i class="fas fa-trash-alt"></i></a></td>

                            </tr>

                            <tr>
                                <td>Woolloongabba</td>
                                <td>
                                    <form action="http://localhost:8080/My_Project/Inventory_Management_System/cat-update/a775bac9cff7dec2b984e023b95206aa" method="post">
                                        <input type="hidden" name="_token" value="oumbygipURtb7L0KxVTD3PF6qiqItZQ3bpQ8lPzH">                            <input type="number" name="qty" value="1" style="width: 40px;">
                                        <button type="submit" class="btn btn-extra-sm btn-apply" style="margin-top :-2px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>2000</td>
                                <td>2000</td>
                                <td><a href="http://localhost:8080/My_Project/Inventory_Management_System/cart-remove/a775bac9cff7dec2b984e023b95206aa"><i class="fas fa-trash-alt"></i></a></td>

                            </tr>
                            </tbody>
                        </table>
                    </ul>
                    <div class="pricing-header bg-primary">
                        <br>
                        <p  class="text-white">Quantity : 0 </p>
                        <p  class="text-white">Sub Total : $0.00 </p>
                        <p  class="text-white">Vat : $0.00 </p>
                        <hr>
                        <span  class="text-white name">Total : $0.00 </span>
                    </div>
                    <br>
                    <form style=" margin-left: -16px;background: #fff;padding: 18px;" method="post" action="http://localhost:8080/My_Project/Inventory_Management_System/create-invoice">
                        <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">        <div class="panel">
                            <h4 class="text-info" style="margin: 10px; margin-bottom: 32px;"><span style="margin-left: 0;">Select Customer</span>
                                <a href="#" style="margin-left: 43%;font-size: 14px;" class="btn btn-sm btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#con-close-modal">Add new</a>
                            </h4>
                            <select style="margin-bottom: 30px;" class="form-control" name="Customer">
                                <option disabled="" selected="">Select Customer</option>
                                <option value="3">Jecey Duprie Roy</option>
                                <option value="4">Jecey Duprie</option>
                                <option value="5">Jecey Duprie</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-sm btn-success">Create Invoice</button>
                        </div>
                    </form>
                </div> <!-- end Pricing_card -->
            </div>
            <div class="col-lg-6">
                <table  class="table" id="dataTable" width="100%" cellspacing="0"  >
                    <thead class="table-header ">
                    <tr>
                        <th class="text-white">Image</th>
                        <th class="text-white">Product Name</th>
                        <th class="text-white">Add</th>
                    </tr>
                    </thead>


                    <tbody class="background-white">

                    <tr>
                        <form action="http://localhost:8080/My_Project/Inventory_Management_System/add-cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">                        <input type="hidden" name="id" value="2">
                            <input type="hidden" name="name" value="gear lever">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="1400">
                            <input type="hidden" name="weight" value="100">
                            <td>
                                <img src="{{ asset('public/img/images.jpg') }}" alt="" style="height:60px;width:60px;"></td>
                            <td>gear lever</td>
                            <td><button  type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>

                    </tr>
                    <tr>
                        <form action="http://localhost:8080/My_Project/Inventory_Management_System/add-cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">                        <input type="hidden" name="id" value="3">
                            <input type="hidden" name="name" value="Woolloongabba">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="2000">
                            <input type="hidden" name="weight" value="100">
                            <td>
                                <img src="{{ asset('public/img/images.jpg') }}" alt="" style="height:60px;width:60px;"></td>
                            <td>Woolloongabba</td>
                            <td><button  type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>

                    </tr>
                    <tr>
                        <form action="http://localhost:8080/My_Project/Inventory_Management_System/add-cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">                        <input type="hidden" name="id" value="4">
                            <input type="hidden" name="name" value="BMW 3 Series GT 320d Luxury Line">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="95000000">
                            <input type="hidden" name="weight" value="100">
                            <td>
                                <img src="{{ asset('public/img/images.jpg') }}" alt="" style="height:60px;width:60px;"></td>
                            <td>BMW 3 Series GT 320d Luxury Line</td>
                            <td><button  type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>

                    </tr>
                    <tr>
                        <form action="http://localhost:8080/My_Project/Inventory_Management_System/add-cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">                        <input type="hidden" name="id" value="5">
                            <input type="hidden" name="name" value="Toyota Rav4">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="5700000">
                            <input type="hidden" name="weight" value="100">
                            <td>
                                <img src="{{ asset('public/img/images.jpg') }}" alt="" style="height:60px;width:60px;"></td>
                            <td>Toyota Rav4</td>
                            <td><button  type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>

                    </tr>
                    <tr>
                        <form action="http://localhost:8080/My_Project/Inventory_Management_System/add-cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak">                        <input type="hidden" name="id" value="6">
                            <input type="hidden" name="name" value="Test Item">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="1400">
                            <input type="hidden" name="weight" value="100">
                            <td>
                                <img src="{{ asset('public/img/images.jpg') }}" alt="" style="height:60px;width:60px;"></td>
                            <td>Test Item</td>
                            <td><button  type="submit" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></button></td>
                        </form>

                    </tr>

                    </tbody>
                </table>
            </div>

        </div>



    </div> <!-- container -->

</div> <!-- content -->

<form action="http://localhost:8080/My_Project/Inventory_Management_System/insert-customer" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="zQkhsFpgrBGqZIKpnn5GHEOB06MmY7u441LXoeak"><div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add a new Customer</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Name</label>
                                <input type="text" class="form-control" id="field-4" name="name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Email</label>
                                <input type="email" class="form-control" id="field-5" name="email" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">Phone</label>
                                <input type="text" class="form-control" id="field-6" name="phone" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Address</label>
                                <input type="text" class="form-control" id="field-4" name="address" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Shop Name</label>
                                <input type="text" class="form-control" id="field-5" name="shop_name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">City</label>
                                <input type="text" class="form-control" id="field-6" name="city" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Account Holder</label>
                                <input type="text" class="form-control" id="field-4" name="account_holder" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Account Number</label>
                                <input type="text" class="form-control" id="field-5" name="account_number" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">Bank Name</label>
                                <input type="text" class="form-control" id="field-6" name="bank_name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Bank Branch</label>
                                <input type="text" class="form-control" id="field-4" name="bank_branch" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <img id="image" src="#">
                                <label for="field-5" class="control-label">Photo</label>
                                <input type="file" name ="photo" accept="image/*" class="upload" required onchange="readURL(this);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<script type="text/javascript">
    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
{{--</body>--}}
{{--</html>--}}
@endsection