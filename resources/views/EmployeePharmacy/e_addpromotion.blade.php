<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
  <title>Pharmacy Management System | เพิ่มโปรโมชัน</title>
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
      <li><a href="{{url('/addpromotionEm')}}"  class="active">เพิ่มโปรโมชัน</a></li>
    </ul>
    <div class="clear"></div>
    <hr />
    <div class="col-md-7"><br><img  id="showimg" alt="" width="280" height="230"><br><br></div>

  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form class="form-horizotal" method="POST" action="{{ url('addpromotionEm/insert')}}" enctype="multipart/form-data">
          {{csrf_field()}}
  <fieldset>
    
    @if(count($errors) >0 )
       @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{$error}}
        </div>

    @endforeach
    @endif
    

    <div class="form-group">
      <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/gif " onchange="preview_image(event)">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
    </div>

    <div class="form-group">
      <label for="description_pro">คำอธิบาย</label>
      <textarea name="description_pro" class="form-control" id="description_pro" rows="3" placeholder="เพิ่มข้อมูลโปรโมชั่น เช่น ชื่อยา ส่วนลด ระยะเวลา ของโปรโมชั่น"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">เพิ่ม</button>
    <a href="{{ url('/homeEm') }}" class="btn btn-primary">ยกเลิก</a>
  </fieldset>
</form>
      </div>
    </div>
  </div>
</body>
</html>