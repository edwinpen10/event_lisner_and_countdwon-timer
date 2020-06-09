<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-md-3 mb-3">
            <h3 class="text-uppercase">Timer order </h3>
            </div>
            <div class="col-sm-6 offset-md-3">
                <h1>Dengan looping</h1>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Status</th>
                        <th scope="col">Time over</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        @php
                            dd($orders)
                        @endphp
                         <tr>
                            <th scope="row">
                                <div id="alert" class="alert" role="alert" >
                                    {{$key->status_order}}
                              </div></th>
                            <td> <div id-data="{{$key->id}}" data-countdown="{{$key->tgl_order}}" data-value="{{$key->status_order}}"></div> </td>
                          </tr>
                        
                        
                         @endforeach
                     
                    </tbody>
                  </table>
                    
                   
                

                    <h1>tampa looping</h1>
                <div id="mytimer" data="2020-06-05 15:51:00"></div>
                   <div id="clock"></div>
                
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="{{asset('assets/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/moment.js')}}"></script>
<script src="{{asset('assets/moment-timezone-with-data.js')}}"></script>
<script>



$('[data-countdown]').each(function() {
   var $this = $(this), finalDate = $(this).data('countdown');
   var timerx = moment.tz( finalDate, "Asia/Jakarta");
   let id_timer = $this[0].attributes[0].value
   let status = $this[0].attributes[2].value
   $this.countdown(timerx.toDate(), function(event) {
     var x = $this.html(event.strftime('%H:%M:%S'));
     if(x[0].textContent=="00:00:00" && status =="Belum bayar"){
        console.log(id_timer)
    //     $(".alert").addClass("alert-danger")
        $.ajax({
        type: "GET",
         url:"/update/status/"+id_timer,
         success:function(response){
            location.reload(); 
         }
       })
    }
   });
});



var x = document.getElementById("mytimer").getAttribute("data");
var timer = moment.tz(x, "Asia/Jakarta");

$('#clock').countdown(timer.toDate(), function(event) {
    var d =$(this).html(event.strftime('%H:%M:%S'));
    if(d[0].textContent=="00:00:00"){
        
    }

});





// .on('finish.countdown', function(event) {
//   $(this).html('This offer has expired!')
//     .parent().addClass('disabled');
// });

</script>

</body>
</html>