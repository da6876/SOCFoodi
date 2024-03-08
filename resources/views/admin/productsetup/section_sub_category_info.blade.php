<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- base:css -->

    @include('admin.layouts.header_link_file')
</head>


<body>
<div class="container-scroller">

@include('admin.layouts.nav_bar_top')

<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-6">
                                        </div>

                                    <div class="col-sm-6">
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="pe-1 mb-3 mb-xl-0">
                                                    <button type="button" onclick="showModel()" class="btn btn-outline-inverse-info btn-icon-text">
                                                        Add Sub-Category
                                                        <i class="mdi mdi-loupe btn-icon-append"></i>
                                                    </button>
                                                </div>
                                                <div class="pe-1 mb-3 mb-xl-0">
                                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                                        Print
                                                        <i class="mdi mdi-printer btn-icon-append"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <h4 class="card-title">Sub-Category Data table</h4>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sub-Category Name</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Update Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($SubCategoryData as $article)
                                                <tr>
                                                    <td>{{$article->sub_category_id}}</td>
                                                    <td>{{$article->sub_category_name}}</td>
                                                    <td>
                                                        @if($article->sub_category_status=="A")
                                                            <label class="badge badge-success">Active</label>
                                                        @elseif($article->sub_category_status=="I")
                                                            <label class="badge badge-warning">InActive</label>
                                                        @else
                                                            <label class="badge badge-danger">Pending</label>
                                                        @endif
                                                    </td>
                                                    <td>{{$article->create_info}}</td>
                                                    <td>{{$article->update_info}}</td>
                                                    <td>
                                                        <button class="btn btn-outline-primary" onclick="editSubCategory('{{$article->sub_category_id}}')">View</button>
                                                        <button class="btn btn-outline-danger" onclick="deleteSubCategory('{{$article->sub_category_id}}')">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>

                    </div>

                    <div class="modal fade addSubCategory" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SubCategory Add</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">SubCategory Name</label>
                                                <input type="hidden" id="inSubCategoryId" name="inSubCategoryId">
                                                <input type="text" class="form-control" id="inSubCategoryName" name="inSubCategoryName" placeholder="User Type Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Category</label>
                                                <select id="slCategory" name="slCategory" class="form-control form-control-lg" required>
                                                    <option value="S">Select Category</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1"> Status</label>
                                                <select id="slSubCategoryStatus" name="slSubCategoryStatus" class="form-control form-control-lg" required>
                                                    <option value="S">Select User Type</option>
                                                    <option value="A">Active</option>
                                                    <option value="I">InActive</option>
                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="addSubCategory()" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('admin.layouts.footer_bar')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('admin.layouts.footer_link_files')
<script>
    function showModel() {
        $('.addSubCategory').modal('show');
    }

    var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
    url = "{{ url('ShowCategory') }}";
    $.ajax({
        url: url,
        type: 'POST',
        data: {"_token": csrf_tokens},
        datatype: 'JSON',
        success: function (data) {
            //console.log(data);
            var sub_cat = $.parseJSON(data);
            if (sub_cat != '') {
                var markup = "<option value=''>Select Category</option>";
                for (var x = 0; x < sub_cat.length; x++) {
                    markup += "<option value=" + sub_cat[x].category_id + ">" + sub_cat[x].category_name + "</option>";
                }
                $("#slCategory").html(markup).show();
            } else {
                var markup = "<option value=''>Select Category</option>";
                $("#slCategory").html(markup).show();
            }


        },
        error: function (data) {
            swal({
                title: "Oops",
                text: "Some Thing Is .... !!",
                icon: "error",
                timer: '1500'
            });
        }
    });

    function addSubCategory() {
        url = "{{ url('SubCategoryInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".addSubCategory form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.addSubCategory').modal('hide');
                    swal("Success", dataResult.statusMsg).then((value) => {
                        window.location.reload();
                    });
                    ;
                    $('.addSubCategory form')[0].reset();
                } else if (dataResult.statusCode == 201) {
                    swal({
                        title: "Oops",
                        text: dataResult.statusMsg,
                        icon: "error",
                        timer: '1500'
                    }).then((value) => {
                        window.location.reload();
                    });
                }
            }, error: function (data) {
                console.log(data);
                swal({
                    title: "Oops",
                    text: data.responseText,
                    icon: "error"
                });
            }
        });
        return false;
    };

    function editSubCategory(id) {
        $(".btnAdd").hide();
        $(".btnUpdate").show();
        $.ajax({
            url: "{{ url('SubCategoryInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.addSubCategory').modal('show');
                $('.modal-titles').text(data[0].sub_category_name + ' Information');
                $('#inSubCategoryId').val(data[0].sub_category_id);
                $('#inSubCategoryName').val(data[0].sub_category_name);
                $('#slCategory').val(data[0].category_id);
                $('#slSubCategoryStatus').val(data[0].sub_category_status);
            }, error: function () {
                swal({
                    title: "Oops",
                    text: "aa",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    function deleteSubCategory(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ url('SubCategoryInfo') }}" + '/' + id,
                    type: "POST",
                    data: {'_method': 'DELETE', '_token': csrf_token},
                    success: function (data) {
                        console.log(data);
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            $('#Categories-dataTabel').DataTable().ajax.reload();
                            swal({
                                title: "Delete Done",
                                text: "Poof! Your data file has been deleted!",
                                icon: "success",
                                button: "Done"
                            }).then((value) => {
                                window.location.reload();
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    }, error: function (data) {
                        swal({
                            title: "Opps...",
                            text: "Error occured !",
                            icon: "error",
                            button: 'Ok ',
                        }).then((value) => {
                            window.location.reload();
                        });
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    };
</script>
</body>
</html>