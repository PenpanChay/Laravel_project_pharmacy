<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
<title>Pharmacy Management System | เปลี่ยนรหัสผ่าน</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{asset('frontend/style/960.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('frontend/style/style.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/script.js')}}"></script>
</head>
<body>
<!--container_12 start here-->
<div class="container_12">
  <!--grid_12 start here-->
  <div class="grid_12">
    <!--logo_container start here-->
    <div id="logo_container"> <a href="#" id="logo"></a>
      <div class="clear"></div>
      <div class="tag_line">Pharmacy Management System</div>
    </div>
    <!--logo_container end here-->
    <div id="nav_wrapper">
      <ul id="nav">
        <li><a href="{{ url('/homeUs') }}">หน้าหลัก</a></li>
        <li><a href="{{ url('/aboutUs') }}">เกี่ยวกับเรา</a></li>
        <li><a href="#">โปรโมชั่น</a>
        <ul>
            <li><a href="{{ url('/promotionUs') }}">ดูโปรโมชัน</a></li>
          </ul></li>
        <li><a href="{{ url('/stockUs') }}">รายการยา</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">สวัสดี คุณ
                                    {{ Auth::user()->name }} (USER)<span class="caret"></span>
                                </a>
            <ul>
            <li><a href="{{ url('/profileUs') }}">ดูโปรไฟล์</a></li>
            <li><a href="{{ url('/changepassUs') }}">เปลี่ยนรหัสผ่าน</a></li>
            <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            ออกจากระบบ
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               {{ csrf_field() }}
            </form>
            </li>
            </ul>
            </li>
           <!--  <li><a href="{{ url('/searchdrugUs') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->

@section('content')
                    @if (session('status'))
                            {{ session('status') }}
                    @endif
@endsection

      </ul>
    </div>
  </div>
  <div class="grid_12">
    <ul id="q_nav">
      <li><a href="{{url('/')}}">หน้าหลัก</a></li>
      <li><a href="#">/</a></li>
      <li><a href="{{url('/promotionUs')}}"  class="active">โปรโมชั่น</a></li>
    </ul>
    <div class="clear"></div>
    <hr />

    <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('change/passwordus') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('passwordold') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">รหัสผ่านปัจุบัน</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="passwordold" required>

                                @if ($errors->has('passwordold'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passwordold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">รหัสผ่านใหม่</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4  control-label">ยืนยันรหัสผ่านใหม่</label>
                            <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                              เปลี่ยนรหัสผ่าน
                            </button>
                          </div>
                        </div>

                            
                    </form>
                </div>


    
<div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <!--footer start here-->
    
    <div class="copyright">Copyright©2018 - Pharmacy</div>
    
  </div>
  <!--grid_12 start here-->
  <div class="clear"></div>
</div>
<!--container_12 end here-->
</body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/alertifyjs/1.9.0/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/defult.min.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/semantic.min.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/bootstrap.min.css">
 
 @if (session('success'))
 <script type="text/javascript">
   $(document).ready(function(){
    alertify.success('{{session('success')}}');
   });
 </script>
 @endif

@if (session('error'))
 <script type="text/javascript">
   $(document).ready(function(){
    alertify.error('{{session('error')}}');
   });
 </script>
 @endif