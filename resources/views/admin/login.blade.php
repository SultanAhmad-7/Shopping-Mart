
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CRM Admin Panel</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ url('admin_assets/login/dist/img/ico/favicon.png') }}" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="{{ url('admin_assets/login/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="{{ url('admin_assets/login/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="{{ url('admin_assets/login/dist/css/stylecrm.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        @if (Session::has('error_login'))
                        <div class="alert alert-danger" role="alert">
                           {{ Session::get('error_login') }}
                          </div>
                        @endif
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                           
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.loginpost') }}" id="loginForm" novalidate>
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" required="" value="" name="email" id="username" class="form-control">
                               
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" required="" value="" name="password" id="password" class="form-control">
                               
                            </div>
                            <div>
                                <button class="btn btn-add">Login</button>
                            </div>
                        </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="{{ url('admin_assets/login/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="{{ url('admin_assets/login/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    </body>

<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->
</html>