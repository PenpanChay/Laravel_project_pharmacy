<!DOCTYPE html>
<html>
<head>
    <title>สรุปรายงานการซื้อ-ขายยา</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabunNew";
        }

        table, td, th {
        border: 1px solid black;
        }

        table {
        border-collapse: collapse;
        width: 100%;
        }

        th {
        height: 50px;
        }
    </style>
</head>
<body>
    <h1>สรุปรายงานการซื้อ-ขายยา ร้านขายยาไถซัวตึ๊ง</h1>

<div>
    <div class="panel panel-primary">
        <div class="panel-body">
        <br><br>
            <table style="font-size: 16px;">
                <thead>
                    <tr>
                        <th><center>วันที่ขาย</center></th>
                        <th><center>บิลที่</center></th>
                        <th><center>รหัสยา</center></th>
                        <th><center>ชื่อยา</center></th>
                        <th><center>จำนวนที่ซื้อ</center></th>
                        <th><center>ราคา/หน่วย</center></th>
                        <th><center>ส่วนลด/หน่วย</center></th>
                        <th><center>ราคารวม</center></th>
                       
                    </tr>
                </thead>
                <tbody>
                    @if(isset($count))
                    @if($count > 0)
                   <?php
                         @$sum_amount = 0; 
                         $date = 0;
                         $i = 0;

                    ?>

                    @foreach($result as $var)
                     <tr>
                            
                            <?php
                               
                                $sum_amount += $var->sum_amount;
                               
                                $date = $var->updated_at;
                                

                            ?>
                            <td><center>{{ $var->updated_at }}</center></td>
                            <td><center>{{ $var->bill_id }}<center></td>
                            <td><center>{{ $var->code }}<center></td>
                            <td><center>{{ $var->name }}<center></td>
                            <td><center>{{ $var->amout }}<center></td>
                            <td><center>{{ $var->price }}<center></td>
                            <td><center>{{ $var->sale }}<center></td>
                            <td><center>{{$var->amout * ($var->price-$var->sale) }}</center></td>
                            

                           
                        </tr>
                     {{--*/ $i++; /*--}}
                     @endforeach
                    @endif
                    @endif
                </tbody>
            </table><center>
            <div class="pagination"></div></center>
        </div>
    </div>
  </div>

  </body>
</html>