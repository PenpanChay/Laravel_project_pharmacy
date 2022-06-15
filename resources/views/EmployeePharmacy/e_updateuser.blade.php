<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
  <title>Pharmacy Management System | แก้ไขข้อมูลสมาชิก</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{asset('frontend/style/960.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('frontend/style/style.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/script.js')}}"></script>
<script type='text/javascript'>
        function preview_image(event) 
        {
             var reader = new FileReader();
             reader.onload = function()
             {
                  var output = document.getElementById('showimg');
                  output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);
        }
        </script>
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
        <li><a href="{{ url('/homeEm') }}">หน้าหลัก</a></li>
        <li><a href="{{ url('/aboutEm') }}">เกี่ยวกับเรา</a></li>
        <li><a href="#">โปรโมชั่น</a>
        <ul>
            <li><a href="{{ url('/promotionEm') }}">ดูโปรโมชัน</a></li>
            <li><a href="{{ url('/addpromotionEm') }}">เพิ่มโปรโมชัน</a></li>
          </ul></li>
        <li><a href="#">รายการยา</a><ul>
            <li><a href="{{ url('/stockEm') }}">ดูรายการยา</a></li>
            <li><a href="{{ url('/expEm') }}">ยาที่ใกล้หมดอายุ</a></li>
            <li><a href="{{ url('/outEm') }}">ยาที่ใกล้หมดสต๊อก</a></li>
            <li><a href="{{ url('/addstockEm') }}">เพิ่มข้อมูลยา</a></li>
          </ul></li>
        <li><a href="#">การขาย</a><ul>
            <li><a href="{{ url('/shopEm') }}">แคชเชียร์</a></li>
          </ul></li>
        <li><a href="#">สมาชิก</a><ul>
            <li><a href="{{ url('/userEm') }}">ดูลูกค้า</a></li>
            <li><a href="{{ url('/adduserEm') }}">เพิ่มสมาชิก</a></li>
          </ul></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">สวัสดี คุณ
                                    {{ Auth::user()->name }} (STAFF)<span class="caret"></span>
                                </a>
            <ul>
            <li><a href="{{ url('/profileEm') }}">ดูโปรไฟล์</a></li>
            <li><a href="{{url('/changepassEm')}}"  class="active">เปลี่ยนรหัสผ่าน</a></li>
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
            <!-- <li><a href="{{ url('/searchdrugEm') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->

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
      <li><a href="{{url('/homeEm')}}">หน้าหลัก</a></li>
      <li><a href="#">/</a></li>
      <li><a href="#"  class="active">แก้ไขข้อมูลสมาชิก</a></li>
    </ul>
    <div class="clear"></div>
    <hr />
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form class="form-horizotal" method="POST" action="{{ url('/userEm/edit', array($users->id))}}">
          {{csrf_field()}}
  <fieldset>
    <h3>แก้ไขสมาชิก</h3>
    @if(count($errors) >0 )
       @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{$error}}
        </div>

    @endforeach
    @endif
    <div class="form-group">
      <label for="code_user"><h7>รหัสสมาชิก</h7></label>
      <input type="text" name="code_user" class="form-control" id="code_user" value="<?php echo $users->code_user; ?>">
    </div>

    <div class="form-group">
      <label for="image"><h7>รูป</h7></label>
      <input type="file" name="image" id="image">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
    </div>

    <div class="form-group">
      <label for="name"><h7>ชื่อ</h7></label>
      <input type="text" name="name" class="form-control" id="name" value="<?php echo $users->name; ?>">
    </div>

    <div class="form-group">
      <label for="surname"><h7>นามสกุล</h7></label>
      <input type="text" name="surname" class="form-control" id="surname" value="<?php echo $users->surname; ?>">
    </div>


<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="code_admin"><h7>อีเมลล์</h7></label>

                                <input id="email" type="email" class="form-control" name="email" value="<?php echo $users->email; ?>">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                         
                        </div>
              
     <div class="form-group">
      <label for="birth"><h7>วันเกิด</h7></label>
      <input type="date" name="birth" class="form-control" id="birth"  value="<?php echo $users->birth; ?>">
    </div>

    <div class="form-group">
      <label for="age"><h7>อายุ</h7></label>
      <input type="number" name="age" class="form-control" id="age"  value="<?php echo $users->age; ?>">
    </div>

    <div class="form-group">
      <label for="sex"><h7>เพศ</h7></label>
      <input type="text" name="sex" class="form-control" id="sex"  value="<?php echo $users->sex; ?>">
    </div>

    <div class="form-group">
      <label for="tel"><h7>เบอร์โทร</h7></label>
      <input type="text" name="tel" class="form-control" id="tel"  value="<?php echo $users->tel; ?>">
    </div>

    <div class="form-group">
      <label for="disease"><h7>โรคประจำตัว</h7></label>
      <input type="text" name="disease" class="form-control" id="disease"  value="<?php echo $users->disease; ?>">
    </div>

    <div class="form-group">
      <label for="drug"><h7>ยาที่แพ้</h7></label>
      <input type="text" name="drug" class="form-control" id="drug"  value="<?php echo $users->drug; ?>">
    </div>
    <!-- <div class="form-group">
      <label for="images">Image</label>
      <input type="file" class="form-control-file" id="images" aria-describedby="images">
      <small id="images" class="form-text text-muted"></small>
    </div> -->
    <button type="submit" class="btn btn-primary">แก้ไข</button>
    <a href="{{ url('/userEm') }}" class="btn btn-primary">ยกเลิก</a>
  </fieldset>
</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>