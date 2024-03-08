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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="UserLogin auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <h1><b>SOC Foodi</b></h1>
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" action="#" data-parsley-validate novalidate enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="inEmail" name="inEmail" placeholder="Enter You Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="inPassword" name="inPassword" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="checkLogin()">SIGN IN</a>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('admin.layouts.footer_link_files')
<script>

    function checkLogin() {
        var UseId  = $("#inEmail").val();
        var UseUser  = $("#inPassword").val();
        if (UseId!=''){
            if (UseUser!=''){
                loginNow();
            } else{
                swal({
                    text: "Enter Your Password Here !!",
                    icon: "error",
                    timer: '3000'
                });
            }
        } else{
            swal({
                text: "Enter Your User Email No !!",
                icon: "error",
                timer: '3000'
            });
        }
    }
    function loginNow() {
        url = "{{ url('UserLogin') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".UserLogin form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    window.location.href = 'admin-home';
                    $('.UserLogin form')[0].reset();
                } else if (dataResult.statusCode == 201) {
                    swal({
                        text: "Login Failed",
                        icon: "error",
                        timer: '1500'
                    });
                }
            }, error: function (data) {
                console.log(data);
                swal({
                    title: "Oops",
                    text: "Error occured",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
        return false;
    };

</script>
</body>
</html>