<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
<title>Pharmacy Management System</title>
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
        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li><a href="{{ url('/about') }}">เกี่ยวกับเรา</a></li>
        <li><a href="{{ url('/stock') }}">รายการยา</a></li>
        <li><a href="{{ route('login') }}">เข้าสู่ระบบ</a></li>

        </li>
       <!--  <li><a href="{{ url('/searchdrug') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->
      </ul>
    </div>
    <!--#nav_wrapper-->
  </div>
  <!--grid_12 end here-->
  <div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <div id="slider">
      <div id="slideshow">
        <div class="slide_entry">
          <ul>
            <li>
              <img src="{{asset('frontend/images/slider1.jpg')}}" alt=""  /></li>
            <li>
              <img src="{{asset('frontend/images/slider2.jpg')}}" alt="" /> </li>
            <li>
              <img src="{{asset('frontend/images/slider3.jpg')}}" alt=""  /> </li>
          </ul>
          <div id="number"></div>
        </div>
        <!-- end slide_entry_full div -->
      </div>
      <!-- end slideshow_full div -->
    </div>
    <!--slider end here-->
  </div>
  <!--grid_12 end here-->
  <div class="clear"></div>

   @if(count($stocks) > 0)
    @foreach($stocks as $stock)
  <div class="grid_3">
    <br><br><br>
    <div class=""><a href="#"><img src="{{asset('frontend/images/'.$stock->name_imgdrug)}}"" width="220" height="211" alt="" /></a></div>
    <div  style="border: 3px dashed #f08080; min-height: 150px; background-color:#FFFFE0" ><h2 class="home-items">{{ $stock->name }}</h2>
      <br />
      <h3>สรรพคุณ</h3>
      <p>{{ $stock->description }}</p></div>
  </div>

  @endforeach
    @endif

  <div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <div class="divider"></div>
  </div>
  <!--grid_12 end here-->
  <div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <!--bottom_heading start here-->
    <div class="bottom_heading">ร้านขายยาไถ่ซัวตึ๊ง <br> 006-008 ถนนชายน้ำ ตำบลปากพนัง อำเภอปากพนัง จังหวัดนครศรีธรรมราช 80140 <br>
      เปิดบริการเวลา 08.00น.-19.00น. <br> โทร 075-517-454</div>
    <!--bottom_heading end here-->
    </div>
  <!--grid_12 end here-->
  <div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <div class="divider"></div>
  </div>
  <!--grid_12 end here-->
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
