<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
  <title>Pharmacy Management System | รายละเอียดยา</title>
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
        <li><a href="{{ url('/homeAd') }}">หน้าหลัก</a></li>
        <li><a href="{{ url('/aboutAd') }}">เกี่ยวกับเรา</a></li>
        <li><a href="#">โปรโมชั่น</a>
        <ul>
            <li><a href="{{ url('/promotionAd') }}">ดูโปรโมชัน</a></li>
            <li><a href="{{ url('/addpromotionAd') }}">เพิ่มโปรโมชัน</a></li>
          </ul></li>
        <li><a href="#">รายการยา</a><ul>
            <li><a href="{{ url('/stockAd') }}">ดูรายการยา</a></li>
            <li><a href="{{ url('/expAd') }}">ยาที่ใกล้หมดอายุ</a></li>
            <li><a href="{{ url('/outAd') }}">ยาที่ใกล้หมดสต๊อก</a></li>
            <li><a href="{{ url('/addstockAd') }}">เพิ่มข้อมูลยา</a></li>
          </ul></li>
        <li><a href="#">การขาย</a><ul>
            <li><a href="{{ url('/shop') }}">แคชเชียร์</a></li>
            <li><a href="{{ url('/reportAd') }}">รายงานการขาย</a></li>
            <li><a href="{{ url('/topdrug') }}">อันดับยาขายดี</a>
            <li><a href="{{ url('/topstaff') }}">อันดับยอดขายเภสัชกร</a>
          </ul></li>
        <li><a href="#">สมาชิก</a><ul>
            <li><a href="{{ url('/employAd') }}">ดูเภสัชกร</a></li>
            <li><a href="{{ url('/userAd') }}">ดูลูกค้า</a></li>
            <li><a href="{{ url('/adduserAd') }}">เพิ่มสมาชิก</a></li>
          </ul></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">สวัสดี คุณ
                                    {{ Auth::user()->name }} (ADMIN)<span class="caret"></span>
                                </a>
            <ul>
            <li><a href="{{ url('/profileAd') }}">ดูโปรไฟล์</a></li>
            <li><a href="{{ url('/changepassAd') }}">เปลี่ยนรหัสผ่าน</a></li>
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
            <!-- <li><a href="{{ url('/searchdrugAd') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->

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
      <li><a href="{{url('/homeAd')}}">หน้าหลัก</a></li>
      <li><a href="#">/</a></li>
      <li><a href="#"  class="active">รายละเอียดยา</a></li>
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

  <div>
    <div class="row">
        @if(session('info'))
        <div class="col-mg-6 alert alert-success">
          {{session('info')}}
        </div>
        @endif
        <br/><br/>
        <p id="text_center"><img src="{{asset('frontend/images/'.$stocks->name_imgdrug)}}" width="200" height="200" /></p>
        <p id="text_center">รหัสยา : {{ $stocks->code }}</p>
        <p id="text_center">ชื่อยา : {{ $stocks->name }}</p>
        <p id="text_center">ขนาด : {{ $stocks->size }}</p>
        <p id="text_center">ชนิดตัวยา : {{ $stocks->type }}</p>
        <p id="text_center">หมวดหมู่ : {{ $stocks->groups }}</p>
        <p id="text_center">สรรพคุณ : {{ $stocks->description }}</p>
        <p id="text_center">ข้อบ่งใช้ : {{ $stocks->indication }}</p>
        <p id="text_center">ราคา : {{ $stocks->price }}</p>
        <p id="text_center">ส่วนลด : {{ $stocks->sale }}</p>
        <p id="text_center">จำนวน : {{ $stocks->amout }}</p>
        <p id="text_center">หน่วย : {{ $stocks->unit }}</p>
        <p id="text_center">วันผลิต : {{ $stocks->mfd }}</p>
        <p id="text_center">วันหมดอายุ : {{ $stocks->exp }}</p>
      </div>
    </div>
  </div>
</div>
</body>
</html>