<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
  <title>Pharmacy Management System | โปรไฟล์</title>
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
                                    {{ Auth::user()->name }}(USER) <span class="caret"></span>
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
            <!-- <li><a href="{{ url('/searchdrugUs') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->

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
      <li><a href="{{url('/homeUs')}}">หน้าหลัก</a></li>
      <li><a href="#">/</a></li>
      <li><a href="#"  class="active">รายละเอียด</a></li>
    </ul>
    <div class="clear"></div>
    <hr />

    <style type="text/css">
.content {
    border:solid 1px #cccccc;
    padding:3px;
    clear:both;
    width:300px;
    margin:3px;
}
#text_center { text-align:center; }
#text_right { text-align:right; }
#text_left { text-align:left; }
</style>

  <div class="row">
        @if(session('info'))
        <div class="col-mg-6 alert alert-success">
          {{session('info')}}
        </div>
        @endif
        <br/><br/>
        <p id="text_center"><img src="{{asset('frontend/images/'.Auth::user()->name_imguser)}}" width="200" height="200" /></p>
        <p id="text_center">รหัส : {{ Auth::user()->code_user }}</p>
        <p id="text_center">ชื่อ-นามสกุล : {{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
        <p id="text_center">อีเมลล์ : {{ Auth::user()->email }}</p>
        <p id="text_center">วันเกิด : {{ Auth::user()->birth }}</p>
        <p id="text_center">อายุ : {{ Auth::user()->age }}</p>
        <p id="text_center">เพศ : {{ Auth::user()->sex }}</p>
        <p id="text_center">เบอร์โทร : {{ Auth::user()->tel }}</p>
        <p id="text_center">โรคประจำตัว : {{ Auth::user()->disease }}</p>
        <p id="text_center">ยาที่แพ้ : {{ Auth::user()->drug }}</p>
      </div>
    </div>
  </div>
</div>
</body>
</html>