<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
<title>Pharmacy Management System | เกี่ยวกับเรา</title>
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
  <!--grid_12 end here-->
  <div class="clear"></div>
  <!--grid_12 start here-->
  <div class="grid_12">
    <ul id="q_nav">
      <li><a href="{{url('/homeEm')}}">หน้าหลัก</a></li>
      <li><a href="#">/</a></li>
      <li><a href="{{url('/aboutEm')}}"  class="active">เกี่ยวกับเรา</a></li>
    </ul>
    <div class="clear"></div>
    <hr />
  </div>
  <!--grid_12 end here-->
  <div class="clear"></div>
  
  <div class="grid_12">
    <!--main_heading start here-->
    <div class="main_heading">
      <h2>ร้านขายยา<font class="pink">ไถ่ซัวตึ๊ง </font>ปากพนัง นครศรีธรรมราช</h2>

      <div class="clear"></div>
  <!--grid_3 start here-->
    <table border="0">
      <tr>
        <td><img src="{{asset('frontend/images/pharmacyhome.jpg')}}" width="300" height="220" alt="" /></td>
        <td><img src="{{asset('frontend/images/pharmacyhome2.jpg')}}" width="300" height="220" alt="" /></td>
        <td><img src="{{asset('frontend/images/pharmacyhome3.jpg')}}" width="300" height="220" alt="" /></td>
      </tr>
    </table>

    </div>
    <!--main_heading end here-->
  </div>


  <div class="grid_9"> <br />
    <p>ตั้งขึ้นเมื่อ วันที่ 2 กุมภาพันธ์ ปี พ.ศ.2502 บน ถนนชายน้ำ อำเภอปากพนัง จังหวัดนครศรีธรรมราช โดยเริ่มแรกได้จำหน่ายยาแผนโบราณสมุนไพร และ ยาแผนปัจจุบัน ต่อมาได้เปลี่ยนมาจำหน่ายเฉพาะยาแผนปัจุบัน บรรจุเสร็จ ที่ไม่ใช่ยาอันตรายหรือยาควบคุมพิเศษ</p>
    <br />
    <br />
    <br />

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.5544126832606!2d100.1978641147818!3d8.346992293995749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3052e1d96152a379%3A0x9b0ccd9e8920312a!2z4Lij4LmJ4Liy4LiZ4LiC4Liy4Lii4Lii4Liy4LmE4LiW4LmI4LiL4Lix4LmI4Lin4LiV4Li24LmJ4LiH!5e0!3m2!1sth!2sth!4v1537713830701" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    

    <br/>
    <br/>

    <p>ร้านขายยาไถ่ซัวตึ๊ง <br> 006-008 ถนนชายน้ำ ตำบลปากพนัง อำเภอปากพนัง จังหวัดนครศรีธรรมราช 80140 <br>
    เปิดบริการเวลา 08.00น.-19.00น. <br> โทร 075-517-454</p>    
    
    <br/>
    <br/>
    <br/>
    <br/>
  <!--grid_12 end here-->
  <!--grid_9 start here-->
  
  <!--grid_3 end here-->
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
