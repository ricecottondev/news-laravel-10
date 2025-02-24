@extends('waiters/layout')

@section('konten')
    <style media="screen">
        /* * {outline: solid 1px green;} */

        .category-list .category-item .card .card-img-overlay {
            bottom: unset;
        }

        .category-item {
            margin-bottom: 1.5rem;
        }

        .category-item:last-of-type {
            margin-bottom: 0;
        }
    </style>

<header class="text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
    <div class="container py-4">
        <div class="row">
            {{-- <div class="col">
                <h3 class="fw-bold text-capitalize fs-4 mb-0">

                    <br class="d-md-none">
                    <!-- jika account active / user menginputkan nama sebagai tamu (guest) wording "welcome" hilang digantikan nama user -->
                    <!-- <span>pradhokot</span> -->
                </h3>
            </div> --}}
            <div class="col col-auto mx-auto">
                <a class="navbar-brand me-0" href="{{ url('menu') }}">
                    <img src="../images/logo-baru-dark.svg" height="auto" style="width: 36vw; max-width: 160px;" alt="">
                 </a>
            </div>
        </div>
    </div>
</header>






    <main class="wrapper">

        <div class="container">
            {{-- <h6 class="mb-4">Profile</h6> --}}

            {{-- <form action="" method="POST" enctype="multipart/form-data" class=""> --}}
                {{-- @csrf --}}

                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div id="carousel-detail-img" class="carousel slide">
                            <div class="carousel-indicators">
                                <button data-bs-target="#carousel-detail-img" data-bs-slide-to="0" class="active"></button>
                                <button data-bs-target="#carousel-detail-img" data-bs-slide-to="1"></button>
                                {{-- <button data-bs-target="#carousel-detail-img" data-bs-slide-to="2"></button> --}}
                            </div>

                            <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="{{ url('files/info-images/') . '/' . 'banner-1.jpg' }}"
                                    class="d-block w-100" alt="">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ url('files/info-images/') . '/' . 'banner-2.jpg' }}" class="d-block w-100"
                                    alt="">
                            </div>

                            {{-- <div class="carousel-item">
                                <img src="{{ url('files/imagenotavailable.jpg') }}" class="d-block w-100"
                                    alt="">
                            </div> --}}

                            </div>
                            <button class="carousel-control-prev" data-bs-target="#carousel-detail-img" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" data-bs-target="#carousel-detail-img" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                         </div>
                    </div>

                    <div class="col-lg-12 mb-2">
                        <div class="card text-center my-auto" style="width: 100%; height: 225px;">
                            <div class="card-body align-items-center justify-content-center">
                                <div class="text-center">
                                    {{ Str::ucfirst($email) }}
                                   </div><div id="memberinfo"></div>
                                <div class="text-center" style="font-size:12px; font-weight:300;">
                                    Total Akumulasi Poin Anda
                                   </div>
                                   <div class="text-center">
                                    <div id="pointmember"></div>
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Total Poin Dari
                                    <div style="font-weight: 600">{{ $joindate }} - Saat Ini</div>


                                   </div>
                            </div>
                        </div>


                    </div>
                    {{-- <div class="col-lg-12 mb-4">
                        <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                            <input class="form-control border-0 px-0 bg-transparent" placeholder="Name" name="name"
                                value="{{ old('name') }}" style="font-size: 1rem!important;">
                        </div>
                    </div> --}}

                    <div class="col-lg-12 mb-2 ">
                        <div class="card text-center my-auto" style="width: 100%;">
                            {{-- <button type="button" class="btn text-bg-dark" data-bs-toggle="modal" data-bs-target="#modal-kodeunik">
                                Submit Kode Unik
                            </button> --}}
                            <a href="{{ url('funiquecode') }}">
                            <div class="btn text-bg-dark w-100">
                                Submit Kode Unik
                            </div>
                            </a>

                        </div>
                    </div>

                    <div class="col-lg-12 mb-2 d-none">
                        <div class="mx-auto" style="width: 100%; max-width: 250px;">
                            <nav class="nav flex-nowrap nav-justified">
                               <a href="{{ url('home') }}" class="nav-link">
                               <img src="https://www.supresso.com/int/public/files/navdown/house.svg" alt="">
                               </a>
                               <a href="https://www.supresso.com/int/public/fproducts" class="nav-link active">
                               <img src="https://www.supresso.com/int/public/files/navdown/bijikopi.svg" alt="">
                               </a>

                               <a data-bs-toggle="modal" data-bs-target="#tes" class="nav-link">
                               <img src="https://www.supresso.com/int/public/files/navdown/list.svg" alt="">
                               </a>
                               <a href="https://www.supresso.com/int/public/member/board" class=" nav-link ">
                               <img src="https://www.supresso.com/int/public/files/navdown/person.svg" alt="">
                               </a>
                            </nav>
                         </div>
                    </div>

                    <div class="col-lg-12 mb-2 ">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="card-body align-items-center justify-content-center">
                                    <div class="text-center">
                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                        TOP 5 BULAN {{ Str::upper($month_string) }} {{ Str::upper($year) }}
                                    </h3>
                                   </div>

                                   <div class="text-center" style="font-size: 10px">
                                    Data Terakhir Terupdate Pada
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Dapatkan 10 poin untuk setiap kode unik terdaftar dan menagkan hadiah e-wallet @rp. 2.000.000,00 TOP 5 setiap bulannya
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Belum ada TOP 5
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    *Leader Board Ini Bersifat Sementara Dan Belum Final
                                   </div>
                                   <div class="text-left" style="font-size: 10px">
                                    <br>
                                    <a data-bs-toggle="modal" data-bs-target="#modal-leadersmonth" class="nav-link" style="color: #fd4f00">
                                        Lihat *Month
                                    </a>
                                   </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12 mb-2 ">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="card-body align-items-center justify-content-center">
                                    <div class="text-center">
                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                        LEADER BOARD
                                    </h3>
                                   </div>

                                   <div class="text-center" style="font-size: 10px">
                                    Data Terakhir Terupdate Pada
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Dapatkan 10 poin untuk setiap kode unik terdaftar dan menagkan hadiah e-wallet @rp. 2.000.000,00 TOP 5 setiap bulannya
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Belum ada TOP 5
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    *Leader Board Ini Bersifat Sementara Dan Belum Final
                                   </div>
                                   <div class="text-left" style="font-size: 10px">
                                    <br>
                                    <a data-bs-toggle="modal" data-bs-target="#modal-leaders" class="nav-link" style="color: #fd4f00">
                                        Lihat Semua
                                    </a>
                                   </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4 mt-1">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="card-header">
                                Voucher Saya
                              </div>

                            <div class="card-body align-items-center justify-content-center">
                                <div class="accordion accordion-flush"  id="accordionFlushExample">

                                    <div id="alllistvouchermember"></div>
                                 </div>
                            </div>
                        </div>


                        {{-- <ol class="list-group list-group-numbered"> --}}

                        {{-- </ol> --}}
                    </div>

                    {{-- {{ $iduser }} --}}
                    <div class="col-lg-12 mb-2 d-none">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                                <input class="form-control border-0 px-0 bg-transparent" placeholder="Email" name="email" id="email"
                                    value="admin@gmail.com" style="font-size: 1rem!important;">
                            </div>
                            <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                                <input class="form-control border-0 px-0 bg-transparent" placeholder="Password" name="password" id="password"
                                    value="123456" style="font-size: 1rem!important;">
                            </div>
                            <button onclick="testapi()" class="btn text-bg-dark" >
                                Login
                            </button>
                        </div>
                    </div>




                </div>
                {{-- <div class="text-center pt-5">
                    <button class="btn text-bg-dark" type="submit">OK</button>
                </div> --}}
            {{-- </form> --}}
        </div>

    </main>

    <footer id="copyright">
        <div class="container" style="padding-bottom: 81px;">
            <hr>
            <p class="small text-center text-lg-end opacity-50">&copy; 2023 INDRACO. All rights reserved.</p>
        </div>
    </footer>
@endsection


{{-- @foreach ($allproduct as $modalitem)
    @include('waiters/component/modal-detail')
@endforeach --}}
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/member/GetLeader.js') }}"></script>
<script src="{{ URL::asset('/assets/js/member/GetMemberInfo.js') }}"></script>
<script src="{{ URL::asset('/assets/js/member/UpdatePassword.js') }}"></script>
<script src="{{ URL::asset('/assets/js/member/UpdateImage.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 {{-- <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script> --}}
 <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
 {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
 <script src="html5-qrcode-demo.js"></script>
<script>
    const baseapi = "{{ URL::to('/') }}";
    var iduser = "{{ $iduser }}";
    var nameuser = "{{ $nameuser }}";
    var monthleaderboard = "{{ $month_int }}";
    var yearleaderboard = "{{ $year }}";


    var totalmemberpoint = 0;
    GetMemberPoint();
    MemberInfo(iduser);
    GetMemberVouchers()
    console.log(totalmemberpoint);
    GetVouchers();
    GetLeaderMonth();
    GetLeader();
   function testapi()
   {
    $('#loading').collapse('show');
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    alert(email + " - " + password);
    axios({
                    method: 'post',
                    url: `https://indis.id/api/login`,
                    headers: {
                        // Authorization: 'Bearer ' + '',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    data: {
                        "email" : email,
                        "password" : password,
                    }
                })
                .then(response => {
                    console.log(response.data.success);
                    $('#loading').collapse('hide');
                })
                .catch(error => {
                    console.log('Error:' + error.message);
                });
   }

   function MemberInfo(iduser)
   {
    GetMemberInfo(iduser);
   }

   function UpdatePasswordMember()
   {

    var password =  document.getElementById('newpassword').value;
    UpdatePassword(password);
   }

   function UpdateImageMember()
   {
    // var image =  document.getElementById('fileupload').files;
    UpdateImage();

   }

   //inisialisasi function GetLeaders
   function GetLeader()
   {
    console.log("Top Leader All")
    GetLeaders(null,null,"listleaders");
   }

    //inisialisasi function GetLeaders
    function GetLeaderMonth()
   {
    console.log("Top Leader Month")
    GetLeaders(monthleaderboard,yearleaderboard,"listleadersmonth");
   }

   function GetMemberPoint()
   {
    $.ajax({
            type: 'post',
            url: baseapi +'/api/pointmember',
            // headers: {
            //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {
                "iduser" : iduser,
            },
            success: function(data) {
                console.log(data);
                if (data.point===null) {
                    document.getElementById('pointmember').innerHTML = "<h3 class='fw-bold text-capitalize fs-3 mb-0'>0 POIN</h3>"
                }
                else
                {
                    document.getElementById('pointmember').innerHTML = "<h3 class='fw-bold text-capitalize fs-3 mb-0'>"+data.point+" POIN</h3>"
                    totalmemberpoint = data.point;
                }

                $('#loading').collapse('hide');
            },
            error: function(error) {
                console.log(error);
                $('#loading').collapse('hide');
            }
        });
   }



   function claimvoucher(idvoucher,kodevoucher, pointneed)
   {
    if (pointneed > totalmemberpoint) {
        alert('Point Tidak Cukup');
    }
    else
    {
        alert('claimed '+kodevoucher );
        $.ajax({
            type: 'post',
            url: baseapi +'/api/claimvouchermember',
            // headers: {
            //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {
                "id" : idvoucher,
                "kodevoucher" : kodevoucher,
                "iduser" : iduser,
            },
            success: function(data) {
                console.log(data);
                GetMemberPoint()
                GetMemberVouchers()
                //$('#loading').collapse('hide');
            },
            error: function(error) {
                console.log(error);
                //$('#loading').collapse('hide');
            }
        });
    }

   }

   function GetVouchers()
   {

    //$('#loading').collapse('show');
    $.ajax({
            type: 'get',
            url: baseapi +'/api/allvouchers',
            // headers: {
            //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            // data: {
            //     "iduser" : iduser,
            // },
            success: function(data) {
                console.log(data.vouchers);
                var arraymerchant = data.vouchers;

                var stringmerchant = "";
                var label="";


                arraymerchant.forEach(merchant => {
                var stringvouchers = "";
                if ( (merchant.vouchers.length > 0)) {
                    merchant.vouchers.forEach(vouchers => {
                                if (vouchers.disctype ==="Diskon") {
                                    label = vouchers.disctype+' '+vouchers.discvalue+'%'+" ("+vouchers.label.toUpperCase()+")";
                                }
                                else if (vouchers.disctype ==="Cashback") {
                                    label = vouchers.disctype+' Rp.'+vouchers.discvalue+" ("+vouchers.label.toUpperCase()+")";
                                }
                                else {
                                    label = vouchers.disctype+' Rp.'+vouchers.discvalue+" ("+vouchers.label.toUpperCase()+")";
                                }
                                if (vouchers.qtyvoucher-vouchers.claimed!=0) {
                                     stringvouchers += '<li class="list-group-item d-flex justify-content-between align-items-start">'+
                                                '<div class="ms-2 me-auto">'+
                                                '<div style="font-size:12px; font-weight:600;">'+label+'</div>'+
                                                '<div style="font-size:10px">Tukarkan dengan '+vouchers.pointneed +' Point</div>'+
                                                '</div>'+
                                                '<span class="badge bg-dark rounded-pill" '+
                                                "onclick='claimvoucher("+vouchers.id+","+'"'+vouchers.kode_voucher+'"'+","+vouchers.pointneed+")'>CLAIM</span>"+
                                                '</li>'
                                }


                            });
                stringmerchant +=   '<div class="accordion-item">'+
                                    '<h2 class="accordion-header" id="headingThree">'+
                                    '  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeModal_'+merchant.id+'" aria-expanded="false" aria-controls="collapseThree">'+
                                    merchant.merchant_name.toUpperCase() +
                                    '  </button>'+
                                    '</h2>'+
                                    '<div id="collapseThreeModal_'+merchant.id+'" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">'+
                                    '  <div class="accordion-body px-0">'+
                                    ' <ol class="list-group list-group-numbered">'+
                                    stringvouchers +
                                    ' </ol>'+
                                    '  </div>'+
                                    '</div>';
                }

                });


                document.getElementById('alllistvoucher').innerHTML = stringmerchant;


                $('#loading').collapse('hide');
            },
            error: function(error) {
                console.log(error);
                // $('#loading').collapse('hide');
            }
        });
   }

   function GetMemberVouchers()
   {
    //$('#loading').collapse('show');
    $.ajax({
            type: 'post',
            url: baseapi +'/api/vouchermember',
            // headers: {
            //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {
                "iduser" : iduser,
            },
            success: function(data) {
                console.log(data.data);
                var arrayvouchermember = data.data;
                var stringmerchant = "";
                var label="";

                arrayvouchermember.forEach(merchant => {
                var stringvouchers = "";

                if ( (merchant.vouchers.length > 0)) {
                    merchant.vouchers.forEach(vouchers => {
                                if (vouchers.disctype ==="Diskon") {
                                    label = vouchers.disctype.toUpperCase()+' '+vouchers.discvalue+'%';
                                }
                                else if (vouchers.disctype ==="Cashback") {
                                    label = vouchers.disctype.toUpperCase()+' Rp.'+vouchers.discvalue;
                                }
                                else {
                                    label = vouchers.disctype.toUpperCase()+' Rp.'+vouchers.discvalue;
                                }
                                // console.log("test");
                                     stringvouchers += "<li class='list-group-item justify-content-between align-items-center' onclick='usedvoucher("+vouchers.id+","+'"'+vouchers.kode_voucher+'"'+","+vouchers.pointneed+")'>"+
                                    //   '<div class="ms-2 me-auto">'+
                                      '<div style="font-size:12px; font-weight:600;">'+label+'</div>'+
                                      '<div style="font-size:10px">'+vouchers.short_desc +' ('+vouchers.date_start+' - '+vouchers.date_end+')</div>'+
                                    //   '</div>'+
                                      '<span class="badge bg-dark rounded-pill" '+
                                    //   "onclick='claimvoucher("+vouchers.id+","+'"'+vouchers.kode_voucher+'"'+","+vouchers.pointneed+")'>Detail
                                    '</span>'+
                                      '</li>'
                            });
                stringmerchant +=   '<div class="accordion-item">'+
                                    '<div class="accordion-header" id="headingThree">'+
                                    '<button class="accordion-button d-block text-center rounded" style="font-size:12px; font-weight:600;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_'+merchant.id+'" aria-expanded="false" aria-controls="collapseThree">'+
                                    ''+ merchant.merchant_name.toUpperCase()+''+
                                        // merchant.merchant_name.toUpperCase() +
                                    '  <span class="badge text-bg-primary">'+merchant.vouchers.length+'</span></button>'+
                                    '</div>'+
                                    '<div id="collapseThree_'+merchant.id+'" class="accordion-collapse show collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">'+
                                    '  <div class="accordion-body px-0">'+
                                    ' <ol class="list-group">'+
                                    stringvouchers +
                                    ' </ol>'+
                                    '  </div>'+
                                    '</div>';
                }

                });


                document.getElementById('alllistvouchermember').innerHTML = stringmerchant;

                // $('#loading').collapse('s');
            },
            error: function(error) {
                console.log(error);
                //$('#loading').collapse('hide');
            }
        });
   }

   function usedvoucher(id,kode_voucher,pointneed)
   {
    alert(id +","+kode_voucher+","+pointneed);
   }



</script>
