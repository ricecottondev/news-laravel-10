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
                <a class="navbar-brand me-0" href="{{ url('Home') }}">
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
                         
                        
                              
                            </div>
                            <button class="carousel-control-prev" data-bs-target="#carousel-detail-img" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" data-bs-target="#carousel-detail-img" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                         </div>  
                    </div> 


                    <div class="col-lg-12 mb-4 mt-1">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="card-header">
                                Uniquecode
                              </div>
                            
                            <div class="card-body align-items-center justify-content-center">
                                <div class="accordion accordion-flush"  id="accordionFlushExample">

                                   
                                        
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
    
                            <div class="card text-center my-auto" style="width: 100%; height: 100px;">
                                <div class="card-body align-items-center justify-content-center">
                                    <div class="text-center" style="font-size: 12px; font-weight: 600">
                                        Dapatkan hadiah langsung dengan submit kode unik!
                                    </div>
                                    <div class="text-center" style="font-size: 10px">
                                        Masukkan kode unik yang tertera pada kemasan dan menangkan hadiah langsung Pulsa,
                                        Logam Mulia hingga Iphone 14
                                    </div>
                                    {{-- <div class="text-center">
                                        Total Akumulasi Poin Anda
                                       </div> --}}
                                    {{-- <div class="text-center">
                                        <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                            0 POIN
                                        </h3>
                                       </div> --}}
    
                                </div>
                            </div>
    
    
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div id="reader"></div>
    
                            {{-- <div id="qr-reader-results"></div> --}}
                            <div id="reader-results"></div>
    
                            {{-- <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script> --}}
                            <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
                            {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
                            <script src="html5-qrcode-demo.js"></script>
                            
                        </div>

                        <div class="col-lg-12 mb-4">
                            
                            <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                                <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                    name="kodeunik1" id="kodeunik1" maxlength="4" style="font-size: 1rem!important;"> -
                                <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                    name="kodeunik2" id="kodeunik2" maxlength="4" style="font-size: 1rem!important;">
                                -
                                <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                    name="kodeunik3" id="kodeunik3" maxlength="4" style="font-size: 1rem!important;">
                                -
                                <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                    name="kodeunik4" id="kodeunik4" maxlength="4" style="font-size: 1rem!important;">
                            </div>
                        </div>
    
    
                        <div class="col-lg-12 mb-4 ">
                            <div class="card text-center my-auto" style="width: 100%;">
                                <button type="button" onclick="checkkode()" class="btn text-bg-dark">
                                    KIRIM
                                </button>
                                {{-- <a data-bs-toggle="modal" data-bs-target="#tes" class="nav-link">
                                <div class="card-body align-items-center d-flex justify-content-center">
                                    Submit Kode Unik s
                                </div>
                                </a> --}}
    
                            </div>
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

               
               
        </div>

    </main>

     <div id="modal-detail-news" class="modal fade show" tabindex="-1">
                    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable" style="$modal-fade-transform: scale(.8)">
                        <div class="modal-content">
                            <div class="modal-header border-0 pb-0 position-absolute top-0 start-0" style="z-index: 100;">
                                <div id="buttonclosemodal"><button class="btn-close text-bg-light" data-bs-dismiss="modal"></button></div>
                            </div>
                            <div class="modal-body p-0 m-3">
                                <div class="row">
                                    <div class="col-lg-12 mb-2 mt-5">
                                        <div class="card text-center my-auto" style="width: 100%;">
                                            <div class="card-body align-items-center justify-content-center">
                                                    <div class="text-center">
                                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                                        <div id="news-title"></div>
                                                    </h3>
                                                   </div>
                                                   
                                                   <div class="text-center" style="font-size: 10px">
                                                  <div id="news-shortdesc"></div>
                                                   </div>
                                                   <div class="text-center" style="font-size: 10px">
                                                   
                                                   </div>
                                                
                                                   <div class="text-left" style="font-size: 10px">
                                                    <br>
                                                  
                                                   </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-12 mb-4 mt-2">
                                        <h4> <div id="news-title"></div></h4>
                                        <div id="news-text"></div>
                
                                    </div>
                                    
                                  
                                </div>
                            </div>
                            <div class="modal-footer border-dark-subtle"></div>
                        </div>
                    </div>
                </div>

    <footer id="copyright">
        <div class="container" style="padding-bottom: 81px;">
            <hr>
            <p class="small text-center text-lg-end opacity-50">&copy; 2023 INDRACO. All rights reserved.</p>
        </div>
    </footer>
@endsection



{{-- <script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script> --}}

<script>
const baseapi = "{{ URL::to('/') }}";
function showdetailnews(title_news, text_news, shortdesc_news)
{
    console.log(text_news)
    document.getElementById("news-title").innerHTML = title_news;
    document.getElementById("news-shortdesc").innerHTML = shortdesc_news;
    document.getElementById("news-text").innerHTML = text_news;
    
    $('#modal-detail-news').modal('show');
}

 //function untuk claim uniquecode
 function checkkode()
   {
    $('#loading').collapse('show');
    var kodeunik1 = document.getElementById('kodeunik1').value;
    var kodeunik2 = document.getElementById('kodeunik2').value;
    var kodeunik3 = document.getElementById('kodeunik3').value;
    var kodeunik4 = document.getElementById('kodeunik4').value;

    var kode = kodeunik1+"-"+kodeunik2+"-"+kodeunik3+"-"+kodeunik4;
    
    var iduser = "{{ $iduser }}";
                
            console.log("tets");
            console.log(kode);

            $.ajax({
            type: 'post',
            url: baseapi +'/api/uniquecode',
            // headers: {
            //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {
                "kode" : kode,
                "iduser" : iduser,
            },
            success: function(data) {
                console.log(data);
                // GetMemberPoint()
                // GetLeader()
                $('#loading').collapse('hide');
                window.location.replace("home");
            },
            error: function(error) {
                console.log(error);
                $('#loading').collapse('hide');
            }
        });
   }

</script>



