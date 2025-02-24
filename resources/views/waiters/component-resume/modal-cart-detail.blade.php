<div id="modal-cart-detail-menu{{ $modalitem->id }}" class="modal fade" tabindex="-1">
   <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable" style="$modal-fade-transform: scale(.8)">
      <div class="modal-content">
         <div class="modal-header border-0 pb-0 position-absolute top-0 start-0" style="z-index: 100;">
            <button class="btn-close text-bg-light" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body p-0">

            <div id="carousel-detail-img" class="carousel slide">
               <div class="carousel-indicators">
                  <button data-bs-target="#carousel-detail-img" data-bs-slide-to="0" class="active"></button>
                  <button data-bs-target="#carousel-detail-img" data-bs-slide-to="1"></button>
                  <button data-bs-target="#carousel-detail-img" data-bs-slide-to="2"></button>
               </div>
               @php

               dump($modalitem);
               // $image=[];
               // if (isset($modalitem->fileimages)) {
               //    $imagetype = gettype(json_decode($modalitem->fileimages));
               //    $image = (json_decode($modalitem->fileimages));
               // }

            // echo "id ".$modalitem->id;
            // dump($modalitem)
               
               @endphp
               <div class="carousel-inner">
                  @if ($modalitem->attributes->images!="imagenotavailable.jpg") 
                 
                  {{-- @foreach ($image as $itemimage)  --}}
                  <div class="carousel-item active">
                     <img src="{{ url('files/product-images/')."/".$modalitem->attributes->images }}" class="d-block w-100" alt="">
                  </div>
                  {{-- @endforeach --}}
                  @else
                  <div class="carousel-item active">
                     <img src="{{ url('files/imagenotavailable.jpg')}}" class="d-block w-100" alt="">
                  </div>
                  @endif
                  {{-- <div class="carousel-item active">
                     <img src="{{ url('files/product-images/').$modalitem->fileimages }}" class="d-block w-100" alt="">
                  </div>
                  <div class="carousel-item">
                     <img src="../waiters-assets/img/produk/supresso-brew.png" class="d-block w-100" alt="">
                  </div>
                  <div class="carousel-item">
                     <img src="../waiters-assets/img/produk/supresso-brew.png" class="d-block w-100" alt="">
                  </div> --}}
               </div>
               <button class="carousel-control-prev" data-bs-target="#carousel-detail-img" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
               </button>
               <button class="carousel-control-next" data-bs-target="#carousel-detail-img" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
               </button>
            </div>

            <div class="container-fluid p-3 mb-4">
               <h6 class="text-capitalize small mb-1">
                  <span class="me-2">coffee</span> <span>manual brew</span>
               </h6>
               <h3 class="text-capitalize fw-semibold fs-4">
                  {{ $modalitem->attributes->brand }} - {{ $modalitem->name }} 
               </h3>
               <p class="small mb-4">
                  {{ $modalitem->attributes->description }}
               </p>
               <div class="overflow-x-auto w-100">
                  <nav id="menu-portion" class="text-nowrap text-capitalize">
                     {{-- @if (count($modalitem->variant))
                         @foreach ($modalitem->variant as $variant)
                         <a data-bs-toggle="modal" class="btn btn-outline-dark {{ $variant->id==$modalitem->id ? 'active' : '' }}" href="#modal-detail-menu{{ $variant->id }}">
                           <strong>{{ $variant->portion }}</strong> <br> Rp&nbsp;75.000,-
                        </a>
                      
                         @endforeach
                     @endif --}}
                     {{-- <a class="btn btn-outline-dark active" href="#">
                        <strong>solo</strong> <br> Rp&nbsp;75.000,-
                     </a>
                     <a class="btn btn-outline-dark" href="#">
                        <strong>doppio</strong> <br> Rp&nbsp;75.000,-
                     </a>
                     <a class="btn btn-outline-dark" href="#">
                        <strong>small</strong> <br> Rp&nbsp;75.000,-
                     </a>
                     <a class="btn btn-outline-dark" href="#">
                        <strong>medium</strong> <br> Rp&nbsp;75.000,-
                     </a>
                     <a class="btn btn-outline-dark" href="#">
                        <strong>large</strong> <br> Rp&nbsp;75.000,-
                     </a> --}}
                  </nav>
               </div>
            </div>

            @php
                     $array = $cartItems;
                     $iditemswithoutmenu = str_replace('menu-', '', $modalitem->id);
                     $index = 0;
                     $aditionalchoosen = [];
                     //dump($iditems);
                     $iditems = str_replace('-', '_', $modalitem->id);
                     //dump($iditems);
                     $totaladditional = 0;
                     @endphp

          
            <div class="container-fluid px-3 py-4 bg-dark-subtle d-flex justify-content-between align-items-center">
               <strong>Choice</strong>
               <span>Choose up to 1</span>
            </div>

            <div class="container-fluid p-3">
               <ul id="mods" class="list-group list-group-flush text-capitalize">

                  @if (count($modalitem->optional))
                         @foreach ($modalitem->optional as $optional)
                          <!-- mods item -->
                           <li class="list-group-item px-0">
                              <div class="form-check">
                                 <input onclick="myFunction<?php echo $iditems ?>('{{ $iditems }}')" name="optionaloption{{ $modalitem->id }}[]" type="radio" class="form-check-input rounded-circle bg-dark border-dark" value='{"id":{{ $optional->id }}, "name":"{{ $optional->name }}", "price":{{ $optional->price }} }' id="mods{{ $optional->id }}" >
                                 <label for="mods1" class="form-check-label d-flex flex-nowrap justify-content-between">
                                    <div><span>{{ $optional->name }}</span></div>
                                  
                                 </label>
                              </div>
                           </li>
                         @endforeach
                     @endif
                  <!-- mods item -->
               </ul>
            </div>


            <div class="container-fluid px-3 py-4 bg-dark-subtle d-flex justify-content-between align-items-center">
               <strong>Spicy Level</strong>
               
            </div>

            <div class="container-fluid p-3">
               <ul id="mods" class="list-group list-group-flush text-capitalize">
                  <li class="list-group-item px-0">
                     <div class="form-check">
                        <input name="spicylevel" id="spicylevel" type="radio" active onchange="spicy{{ $modalitem->id }}({{ $modalitem->id }},false)" class="form-check-input rounded-circle bg-dark border-dark" value="0" >
                        <label for="mods1" class="form-check-label d-flex flex-nowrap justify-content-between">
                           <div><span>No Spicy</span></div>
                           <div class="d-none d-inline-flex flex-nowrap justify-content-between" style="width: 42%;">
                              <span>+&nbsp;Rp&nbsp;</span>
                              <span>1000;-</span>
                           </div>
                        </label>
                     </div>
                  </li>

                  <li class="list-group-item px-0">
                     <div class="form-check">
                        <input name="spicylevel" id="spicylevel" type="radio" onchange="spicy{{ $modalitem->id }}({{ $modalitem->id }},true)" class="form-check-input rounded-circle bg-dark border-dark" value="5000" >
                        <label for="mods1" class="form-check-label d-flex flex-nowrap justify-content-between">
                           <div><span>Spicy</span></div>
                           <div class="d-none d-inline-flex flex-nowrap justify-content-between" style="width: 42%;">
                              <span>+&nbsp;Rp&nbsp;</span>
                              <span>1000;-</span>
                           </div>
                        </label>
                     </div>
                  </li>
               </ul>
            </div>
            

            <div class="container-fluid px-3 py-4 bg-dark-subtle d-flex justify-content-between align-items-center">
               <strong>Additional</strong>
               <span>Choose up to 1</span>
            </div>

            <div class="container-fluid p-3">
               <ul id="mods" class="list-group list-group-flush text-capitalize">
                  @foreach ($array as $additional)
                  @php
                     if ((strpos($additional->id, "add") !== false)&&(strpos($additional->id, $iditemswithoutmenu) !== false)) {
                     $explode_code_additional =  (explode("|",$additional->id));
                     $code_additional = $explode_code_additional;
                     $get_id_additioinal =  (explode("-",$code_additional[0]));
                     $id_additional = $get_id_additioinal[1];
                
                     array_push($aditionalchoosen, $id_additional);
                     }
               
                  @endphp
                  {{-- @if ((strpos($additional->id, $iditems) !== false)&&(strpos($additional->id, "add") !== false))
                     @if ($index==0)
                     {{ strtolower($additional->name) }} (  {{ strtolower($additional->id) }}) 
                     @else
                     | {{ strtolower($additional->name) }} 
                     @endif
                  @endif --}}
                  @endforeach

             

                  @if (count($modalitem->additional))
                         @foreach ($modalitem->additional as $additional)
                           <li class="list-group-item px-0">
                              <div class="form-check">
                                 @php
                                    # filter berdasarkan id
                                    $additionanlId = $additional->id;
                                    $filteredArray = array_filter($aditionalchoosen, function($key) use ($additionanlId) {
                                       $isFound = $key == $additionanlId;
                                       return $isFound;
                                    });
                                    # jika ada maka true
                                    $isAvailable = count($filteredArray) > 0; 
                                    if ($isAvailable) {
                                       $totaladditional =  $totaladditional + $additional->price;
                                    }
                                   
                                 @endphp
                                 <input {{ $isAvailable ? "checked" : "" }} onclick="myFunction<?php echo $iditems ?>('{{ $iditems}}')" name="additionaloption{{ $modalitem->id }}[]" type="checkbox" class="form-check-input rounded-circle bg-dark border-dark" value='{"id":{{ $additional->id }}, "name":"{{ $additional->name }}", "price":{{ $additional->price }} }' id="mods{{ $additional->id }}" >
                                 <label for="mods1" class="form-check-label d-flex flex-nowrap justify-content-between">
                                    <div><span>{{ $additional->name }}</span></div>
                                    <div class="d-inline-flex flex-nowrap justify-content-between" style="width: 42%;">
                                       <span>+&nbsp;Rp&nbsp;</span>
                                       <span>{{ $additional->price }};-</span>
                                    </div>
                                 </label>
                              </div>
                           </li>
                         @endforeach
                     @endif

                  
               </ul>
            </div>

            <div class="container-fluid px-3 py-4 bg-dark-subtle d-flex justify-content-between align-items-center">
               <strong>Special Request</strong>
               <span></span>
            </div>

            <div class="container-fluid p-3">
               <textarea name="notestring{{ $iditems }}" onkeyup="setvaluenote{{$iditems}}({{$iditems}})"  id="notestring{{ $iditems }}" rows="2" placeholder="*Tap to enter special requirement" class="form-control p-0 rounded-0 border-top-0 border-end-0 border-start-0 bg-light"></textarea>
            </div>

         </div>
         {{-- <script>
           
         </script> --}}
         <div class="modal-footer border-dark-subtle">
            <div class="d-flex w-100 align-items-center justify-content-between">
               <h4 id="totallabel{{ $iditems }}" class="fw-semibold mb-0">Rp 
                  {{-- {{ ($modalitem->price * $modalitem->quantity) }} --}}
                  {{ ($modalitem->price * $modalitem->quantity) + ($totaladditional * $modalitem->quantity)}}
                  ,-</h4>
               <input id="inputtotal{{ $iditems }}" type="hidden" value="">
               <div class="input-group w-auto">
                  <button class="btn border-dark" onclick="itemminuscart{{ $iditems }}('{{ $iditems }}')">
                     <i class="bi bi-dash-lg"></i>
                  </button>
                  <input id="totalqty{{ $iditems }}" type="number" min="1" max="100" value="{{ $modalitem->quantity }}" class="form-control border-dark text-center fw-semibold bg-light px-0" style="width: 70px;">
                  <button class="btn border-dark" onclick="itempluscart{{ $iditems }}('{{ $iditems }}')">
                     <i class="bi bi-plus-lg"></i>
                  </button>
               </div>
            </div>
            <div class="w-100">
               <form action="{{ route('cart.update') }}" method="POST" enctype="multipart/form-data" class="d-md-flex w-100 gap-3">
                  @csrf
                  @php
                 

                  if($modalitem->attributes->images!="imagenotavailable.jpg")
                  {
                     $imageName = $modalitem->attributes->images;
                  }
                  else {
                     $imageName = "imagenotavailable.jpg";
                  }
                  // if (item.images.length > 0) {
                  //     imageName = item.images[0];
                  // }
                  //dump($modalitem)
                  @endphp
                  <input type="hidden" value="{{ $modalitem->id }}" name="id">
                  <input type="hidden" value="{{ $modalitem->name }}" name="name">
                  <input type="hidden" name="quant" value="1" id="qty-product{{ $iditems }}">
                  <input type="hidden" name="stock" value="1" id="stock-product">
                  <input type="hidden" name="stockweb" value="{{ $modalitem->id }}" id="stockweb">
                  <input type="hidden" value="{{ $modalitem->price }}" name="price">
                  <input type="hidden" value="{{ $imageName }}" name="images">
                  <input type="hidden" value="{{ $imageName }}" name="types">
                  <input type="hidden" value="{{ $modalitem->attributes->portion }}" name="portion">
                  <input type="hidden" value="{{ $modalitem->attributes->description }}" name="description">
                  <input type="hidden" value="" name="units">
                  <input type="hidden" value="{{ $modalitem->attributes->brand }}" name="brand">
                  <input type="hidden" value="{{ $modalitem->attributes->category }}" name="category">
                  <input type="hidden" value="{{ $modalitem->attributes->subcategory }}" name="subcategory">
                  <input type="hidden" value="{{ $modalitem->attributes->idcategory }}" name="id_category">
                  <input type="hidden" value="" id="additional{{ $iditems }}" name="additional">
                  <input type="hidden" value="" id="note{{ $modalitem->id }}" name="note">
                  <button class="btn btn-lg text-bg-dark w-100">Update Order!</button>
               </form>
               {{-- <button class="btn btn-lg text-bg-dark w-100" onclick="codeAddress({{$modalitem->id}})">Order Now!</button> --}}
            </div>
         </div>
      </div>
   </div>
</div>

<script>
      var qty<?php echo $iditems ?> = {{ $modalitem->quantity }};
      var total<?php echo $iditems ?> = {{ $modalitem->price }};
      var spicy= false;
      var spicyprice = 5000;
      function itempluscart<?php echo $iditems ?>(id){
               qty{{ $iditems }} = qty{{ $iditems }} + 1;
               var total<?php echo $iditems ?> = {{ $modalitem->price }};
               if (spicy==true)
               {  
                  total{{ $iditems }} = (total{{ $iditems }} * qty{{ $iditems }}) + (spicyprice* qty{{ $iditems }});
               }
               else
               {  
                  total{{ $iditems }} = total{{ $iditems }} * qty{{ $iditems }};
               }
               
               var strvar<?php echo $iditems ?> = "additionaloption"+'<?php echo $modalitem->id ?>'+"[]";
               var checkedValue = null; 
               var inputElements = document.getElementsByName(strvar<?php echo $iditems ?>);
               var len = inputElements.length;

               //recalc choice start
               var chooseadd = [];
               for (var i=0; i<len; i++) {
                  let arrayval = JSON.parse(inputElements[i].value);
                  if (inputElements[i].checked) {
                     arrayval.qty = qty{{ $iditems }};
                     chooseadd.push(arrayval)
                     total{{ $iditems }} = total{{ $iditems }} + (arrayval.price * qty{{ $iditems }}) ;
                  }      
               }
               //recalc choice end
               document.getElementById("totallabel"+id).innerHTML = "Rp"+"."+total{{ $iditems }}+" ,-";
               document.getElementById("totalqty"+id).value = qty{{ $iditems }};
               document.getElementById("qty-product"+id).value = qty{{ $iditems }};
               document.getElementById("inputtotal"+id).value = total{{ $iditems }};
               document.getElementById("additional"+id).value = JSON.stringify(chooseadd);
            }

            function itemminuscart<?php echo $iditems ?>(id){
               if (qty{{ $iditems }} >=2) {
               qty{{ $iditems }} = qty{{ $iditems }} - 1;
               var total<?php echo $iditems ?> = {{ $modalitem->price }};
               if (spicy==true)
               {  
                  total{{ $iditems }} = (total{{ $iditems }} * qty{{ $iditems }}) + (spicyprice* qty{{ $iditems }});
               }
               else
               {  
                  total{{ $iditems }} = total{{ $iditems }} * qty{{ $iditems }};
               }
               
               var strvar<?php echo $iditems ?> = "additionaloption"+'<?php echo $modalitem->id ?>'+"[]";
               var checkedValue = null; 
               var inputElements = document.getElementsByName(strvar<?php echo $iditems ?>);
               var len = inputElements.length;

               //recalc choice start
               var chooseadd = [];
               for (var i=0; i<len; i++) {
                  let arrayval = JSON.parse(inputElements[i].value);
                  if (inputElements[i].checked) {
                     arrayval.qty = qty{{ $iditems }};
                     chooseadd.push(arrayval)
                     total{{ $iditems }} = total{{ $iditems }} + (arrayval.price * qty{{ $iditems }}) ;
                  }      
               }
               //recalc choice end
               document.getElementById("totallabel"+id).innerHTML = "Rp"+"."+total{{ $iditems }}+" ,-";
               document.getElementById("totalqty"+id).value = qty{{ $iditems }};
               document.getElementById("qty-product"+id).value = qty{{ $iditems }};
               document.getElementById("inputtotal"+id).value = total{{ $iditems }};
               document.getElementById("additional"+id).value = JSON.stringify(chooseadd);
            }
            }

            function setvaluenote<?php echo $iditems ?>(id)
            {
               console.log(document.getElementById("notestring"+id).value)
               document.getElementById("note"+id).value = document.getElementById("notestring"+id).value; 
            }

            function myFunction<?php echo $iditems ?>(id) 
            {
               console.log("additional edit");
               var total{{ $iditems }} = {{ $modalitem->price }};
               var strvar<?php echo $iditems ?> = "additionaloption"+'<?php echo $modalitem->id ?>'+"[]";
               var checkedValue = null; 
               var inputElements = document.getElementsByName(strvar<?php echo $iditems ?>);
               total{{ $iditems }} = total{{ $iditems }} * qty{{ $iditems }};
               var len = inputElements.length;
               var additionalstring = "";

               //recalc choice start
               var chooseadd = [];
               for (var i=0; i<len; i++) {
                  let arrayval = JSON.parse(inputElements[i].value);
                  if (inputElements[i].checked) {
                     arrayval.qty = qty{{ $iditems }};
                     chooseadd.push(arrayval)
                     total{{ $iditems }} = total{{ $iditems }} + (arrayval.price * qty{{ $iditems }});     
                  } 
               }
               //recalc choice end
               additionalstring = "{"+additionalstring+"}";
               document.getElementById("totallabel"+id).innerHTML = "Rp"+"."+total{{ $iditems }}+" ,-";
               document.getElementById("additional"+id).value = JSON.stringify(chooseadd);
            }
</script>

<style>
#modal-detail-menu.fade .modal-dialog {
   transform: translate(0,50px);
}

#modal-detail-menu.show .modal-dialog {
   transform: none;
}
</style>


<script type="text/javascript">
// var qty<?php echo $modalitem->id ?> = 1; 
// var total = {{ $modalitem->price }};
// var spicy= false;
// var spicyprice = 5000;

         

// function itempluscart<?php echo $iditems ?>(id){
//       console.log("plus");
    

//    }

//    function itemminuscart<?php echo $iditems ?>(id){
//       console.log("minus");

      
//    }

   

   function spicy<?php echo $modalitem->id ?>(id, spicystatus){
           
      if (spicystatus==true) {
         spicy = true;
      }
      else
      {
         spicy = false;
      }

      var total{{ $modalitem->id }} = {{ $modalitem->price }}*1000;
      if (spicy==true)
      {  
         total{{ $modalitem->id }} = (total{{ $modalitem->id }} * qty{{ $modalitem->id }}) + (spicyprice* qty{{ $modalitem->id }});
      }
      else
      {  
         total{{ $modalitem->id }} = total{{ $modalitem->id }} * qty{{ $modalitem->id }};
      }


      var strvar<?php echo $modalitem->id ?> = "additionaloption"+'<?php echo $modalitem->id ?>'+"[]";
      var checkedValue = null; 
      var inputElements = document.getElementsByName(strvar<?php echo $modalitem->id ?>);
      var len = inputElements.length;

      //recalc choice start
      var chooseadd = [];
      for (var i=0; i<len; i++) {
         let arrayval = JSON.parse(inputElements[i].value);
         if (inputElements[i].checked) {
            arrayval.qty = qty{{ $modalitem->id }};
            chooseadd.push(arrayval)
            total{{ $modalitem->id }} = total{{ $modalitem->id }} + (arrayval.price * qty{{ $modalitem->id }}) ;
         }      
      }
      //recalc choice end

      document.getElementById("totallabel"+id).innerHTML = "Rp"+"."+total{{ $modalitem->id }}+" ,-";
      document.getElementById("totalqty"+id).value = qty{{ $modalitem->id }};
      document.getElementById("qty-product"+id).value = qty{{ $modalitem->id }};
      document.getElementById("inputtotal"+{{ $modalitem->id }}).value = total{{ $modalitem->id }};

      document.getElementById("additional"+id).value = JSON.stringify(chooseadd);

      
   }

  

   function recalc_choice()
   {
      var chooseadd = [];
      for (var i=0; i<len; i++) {
         let arrayval = JSON.parse(inputElements[i].value);
         console.log(arrayval);
         if (inputElements[i].checked) {
            arrayval.qty = qty{{ $modalitem->id }};
            chooseadd.push(arrayval)
            total{{ $modalitem->id }} = total{{ $modalitem->id }} + (arrayval.price * qty{{ $modalitem->id }});        
         } 
      }
      return chooseadd;
   }

   function codeAddress(id) 
   {
        console.log("test add to cart");
        let urlAction = "{{ route('cart.store') }}";
        let strFooter = '';
            strFooter +=
        '<form action="' + urlAction +
                '" method="POST" enctype="multipart/form-data" class="d-md-flex w-100 gap-3">' +
                '@csrf' +
                '<input type="hidden" value="' + item.id + '" name="id">' +
                '<input type="hidden" value="' + item.product_name + '" name="name">' +
                '<input type="hidden" name="quant[2]" value="1" id="qty-product">' +
                '<input type="hidden" name="stock" value="1" id="stock-product">' +
                '<input type="hidden" name="stockweb" value="' + item.stockweb + '" id="stockweb">' +
                '<input type="hidden" value="' + item.product_weight + '" name="gramature">' +
                '<input type="hidden" value="' + collectionName + '" name="collection">' +
                '<input type="hidden" value="' + item.disc_event + '" name="discount">' +
                '<input type="hidden" value="' + item.product_price + '" name="pricemaster">' +
                '<input type="hidden" value="' + product_price_after_disc + '" name="priceafterdiscount">' +
                '<input type="hidden" value="' + productPrice + '" name="price">';

            let imageName = "imagenotavailable.jpg";
            if (item.images.length > 0) {
                imageName = item.images[0];
            }

            strFooter += '<input type="hidden" value="' + imageName + '" name="images">';
            strFooter +=
                '<button name="addCartContinueShopping" data-bs-dismiss="modal" class="btn btn-light w-100 mb-2 mb-md-0"  onclick="$(\'#loading\').collapse(\'show\');">Continue Shopping</button>' +
                '<button name="addCartContinueCart" data-bs-dismiss="modal" class="btn btn-dark w-100 mb-2 mb-lg-0"  onclick="$(\'#loading\').collapse(\'show\');">Shopping Cart & Checkout</button>' +
                '</form>';

        qtyPopup = +document.getElementById("qtypopup").value;
        harga = +document.getElementById("Harga").innerHTML;
        document.getElementById("qtypopup").value = qtyPopup;
        calculated = qtyPopup * harga;
        document.getElementById("totalnya"+id).innerHTML = calculated.toFixed(2);
        document.getElementById("inputtotal"+id).value = calculated.toFixed(2);
    }

   </script>