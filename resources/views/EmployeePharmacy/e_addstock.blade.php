<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo2.png')}}" />
  <title>Pharmacy Management System | เพิ่มยา</title>
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
           <!--  <li><a href="{{ url('/searchdrugEm') }}"><img src="{{asset('frontend/images/search.png')}}" width="20" height="25" alt="" /></a></li> -->

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
      <li><a href="{{url('/addstockEm')}}"  class="active">เพิ่มยา</a></li>
    </ul>
    <div class="clear"></div>
    <hr />

  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form class="form-horizotal" method="POST" action="{{ url('addstockEm/insert')}}" enctype="multipart/form-data">
          {{csrf_field()}}
  <fieldset>
    <h3>เพิ่มยา</h3>
    @if(count($errors) >0 )
       @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{$error}}
        </div>

    @endforeach
    @endif
    <div class="form-group">
      <label for="code"><h7>รหัสยา</h7></label>
      <input type="text" name="code" class="form-control" id="code" >
    </div>

    <div class="form-group">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <label for="image"><div class="col-md-7"><br><img  id="showimg" alt="" width="200" height="200"><br><br></div>
</label>
      <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/gif " onchange="preview_image(event)">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
    </div>


      <div class="form-group">
      <label for="name"><h7>ชื่อยา</h7></label>
      <input type="text" name="name" class="form-control" id="name">
    </div>

    <div class="form-group">
      <label for="size"><h7>ขนาด</h7></label>
      <input type="text" name="size" class="form-control" id="size">
    </div>


    <div class="form-group">
      <label for="type"><h7>ชนิดตัวยา</h7></label>
      <select name="type" class="form-control" id="type">
        <option>เม็ด</option>
        <option>น้ำ</option>
        <option>แคปซูล</option>
        <option>ผง</option>
        <option>ขี้ผึ้ง ครีม และเจล</option>
        <option>เหน็บ</option>
        <option>ฉีด</option>
      </select>
    </div>

    <div class="form-group">
      <label for="groups"><h7>หมวดหมู่</h7></label>
      <select name="groups" class="form-control" id="groups">
        <option>ยาแก้ปวดท้อง ท้องอืด ท้องขึ้น ท้องเฟ้อ</option>
        <option>ยาแก้ท้องเสีย</option>
        <option>ยาระบาย</option>
        <option>ยาถ่ายพยาธิลําไส้</option>
        <option>ยาบรรเทาปวด ลดไข้</option>
        <option>ยาแก้อักเสบ ติดเชื้อ</option>
        <option>ยาแก้ไอ ขับเสมหะ</option>
        <option>ยาดมหรือทาแก้วิงเวียน คัดจมูก แมลงกัดต่อย</option>
        <option>ยาแก้เมารถ เมาเรือ</option>
        <option>ยาสําหรับโรคตา</option>
        <option>ยาสําหรับโรคปากและลําคอ</option>
        <option>ยาใส่แผล ล้างแผล</option>
        <option>ยาบรรเทาอาการปวดกล้ามเนื้อ</option>
        <option>ยาสําหรับโรคผิวหนัง</option>
        <option>ยาบํารุงร่างกาย</option>
        <option>อุปกรณ์ทางการแพทย์</option>
      </select>
    </div>

    <div class="form-group">
      <label for="description">สรรพคุณ</label>
      <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>

    <div class="form-group">
      <label for="indication">ข้อบ่งใช้</label>
      <textarea name="indication" class="form-control" id="indication" rows="3"></textarea>
    </div>


    <div class="form-group">
      <label for="price"><h7>ราคา</h7></label>
      <input type="number" name="price" class="form-control" id="price" >
    </div>

    <div class="form-group">
      <label for="sale"><h7>ส่วนลด</h7></label>
      <input type="number" name="sale" class="form-control" id="sale" >
    </div>
    
    <div class="form-group">
      <label for="amout"><h7>จำนวน</h7></label>
      <input type="number" name="amout" class="form-control" id="amout" >
    </div>

    <div class="form-group">
      <label for="unit"><h7>หน่วย</h7></label>
      <select name="unit" class="form-control" id="unit">
        <option>ขวด</option>
        <option>แคปซูล</option>
        <option>ชุด</option>
        <option>ชิ้น</option>
        <option>ซอง</option>
        <option>แผง</option>
        <option>แผ่น</option>
        <option>เม็ด</option>
        <option>หลอด</option>
      </select>
    </div>

    <div class="form-group">
      <label for="mfd"><h7>วันผลิต</h7></label>
      <input type="date" name="mfd" class="form-control" id="mfd">
    </div>


    <div class="form-group">
      <label for="exp"><h7>วันหมดอายุ</h7></label>
      <input type="date" name="exp" class="form-control" id="exp">
    </div>
    <!-- <div class="form-group">
      <label for="images">Image</label>
      <input type="file" class="form-control-file" id="images" aria-describedby="images">
      <small id="images" class="form-text text-muted"></small>
    </div> -->
    <button type="submit" class="btn btn-primary">เพิ่ม</button>
    <a href="{{ url('/stockEm') }}" class="btn btn-primary">ยกเลิก</a>
  </fieldset>
</form>
      </div>
    </div>
  </div>
</body>
</html>