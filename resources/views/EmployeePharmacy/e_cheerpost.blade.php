<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
<title>Pharmacy Management System | แคชเชียร์/เลือกยา</title>
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
      <li><a href="{{url('/shopEm')}}"  class="active">แคชเชียร์/เลือกยา</a></li>
    </ul>
    <div class="clear"></div>
    <hr />
    <div class="panel panel-primary">
    <div class="panel-body">
        <form action="" method="POST" role="form" id="stocks">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            @if(isset($delete) && $delete==1)
                            <th></th>
                            @endif
                            <th><center>ลำดับที่</center></th>
                            <th><center>รหัสยา</center></th>
                            <th><center>ชื่อยา</center></th>
                            <th><center>ประเภท</center></th>
                            <th><center>จำนวน</center></th>
                            <th><center>ราคา</center></th>
                            <th><center>ส่วนลด</center></th>
                            <th><center>วันผลิต</center></th>
                            <th><center>วันหมดอายุ</center></th>
                            <th><center>เลือก</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $n=1;?>
                        @foreach($stocks as $item)
                        <tr>
                            @if(isset($delete) && $delete==1)
                            <td><input type="checkbox" name="checkbox[]" value="{{$item->id}}"></td>
                            @endif
                            <td><center>{{$n}}</center></td>
                            <td><center>{{$item->code}}</center></td>
                            <td><center>{{$item->name}}</center></td>
                            <td><center>{{$item->type}}</center></td>
                            <td><center>{{$item->amout}}</center></td>
                            <td><center>{{$item->price}}</center></td>
                            <td><center>{{$item->sale}}</center></td>
                            <td><center>{{$item->mfd}}</center></td>
                            <td><center>{{$item->exp}}</center></td>
                            <td><center><a href="adddrugEm/{{$item->id}}" class="btn btn-edit">Add</a></center></td>

                        </tr>
                         <?php $n++;?>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div></div>

    </div>
    
</body>
</html>
