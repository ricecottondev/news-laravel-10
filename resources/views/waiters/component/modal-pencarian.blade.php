<div id="modal-pencarian" class="modal fade" tabindex="-1">
   <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-md-down">
      <div class="modal-content">
         <div class="modal-header border-0 pb-0">
            <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
               <button class="btn px-2"><i class="bi bi-search"></i></button>
               <input id="inputsearch" type="search" onkeyup="search()" class="form-control border-0 px-0 bg-transparent" placeholder="Search Menu" style="font-size: 1rem!important;">
            </div>
            <button class="btn text-dark border-0 d-md-none" data-bs-dismiss="modal">Cancel</button>
         </div>
         <div class="modal-body">

            @php
               //dump($res_allproduct);
            @endphp

            <!-- preview search section -->
            <section class="mb-4">
               <h6 class="small"><strong>Searching Item</strong></h6>
               <div class="list-group text-capitalize">
                  
                  <div id="resultsearch">

                  </div>
                  
                   {{-- <a data-bs-toggle="modal" class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center active" href="#modal-detail-menu1">
                     <div>
                        <i class="bi bi-file-earmark me-2"></i>
                        <span>lampung</span>
                     </div>
                     <div class="btn-group" style="margin-right: -.5rem;">
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-arrow-return-left"></i>
                        </button>
                     </div>
                  </a> --}}
                  {{--<a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center" href="#">
                     <div>
                        <i class="bi bi-file-earmark me-2"></i>
                        <span>how it works</span>
                     </div>
                     <div class="btn-group" style="margin-right: -.5rem;">
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-arrow-return-left"></i>
                        </button>
                     </div>
                  </a> --}}
               </div>
            </section>

            <hr class="mb-4">

            <!-- section riwayat pencarian -->
            <section class="mb-4 d-none">
               <p class="text-center opacity-50">No recent searches</p>
               <h6 class="small"><strong>Recent searches</strong></h6>
               <div class="list-group text-capitalize">
                  <a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center active" href="#">
                     <div>
                        <i class="bi bi-clock-history me-2"></i>
                        <span>Recent Item</span>
                     </div>
                     <div class="btn-group" style="margin-right: -.5rem;">
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-star"></i>
                        </button>
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-x-lg"></i>
                        </button>
                     </div>
                  </a>
                  <a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center" href="#">
                     <div>
                        <i class="bi bi-clock-history me-2"></i>
                        <span>Recent Item</span>
                     </div>
                     <div class="btn-group" style="margin-right: -.5rem;">
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-star"></i>
                        </button>
                        <button class="btn px-2" style="color: inherit;">
                           <i class="bi bi-x-lg"></i>
                        </button>
                     </div>
                  </a>
               </div>
            </section>
         </div>
         <div class="modal-footer border-dark-subtle">
            <p class="text-end"><small><small>Search by</small> INDRACO</small></p>
         </div>
      </div>
   </div>
</div>



<script>
   var allproduct = @json($res_allproduct);
   console.log(allproduct);
  

   function search() {
   // const res = allproduct.filter(obj => Object.values(obj).some(val => val.includes('lampung')));
   // console.log(res);
   var stringresult = '';
   var inputs = document.getElementById('inputsearch').value;
   var resultsearch = searcharray(inputs, allproduct);

   resultsearch.forEach(element => {
      stringresult +='<a data-bs-toggle="modal" class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center" href="#" onclick="$(\'' + "#modal-detail-menu"+element.id + '\').modal(\'' + "show" + '\');$(\'' + "#modal-pencarian"+ '\').modal(\'' + "hide" + '\')">'+
      // '<button href="#" onclick="$(\'' + "#modal-detail-menu"+element.id + '\').modal(\'' + "show" + '\');$(\'' + "#modal-pencarian"+ '\').modal(\'' + "hide" + '\')">'+
      // 'asdasdas</button>'+
      "<div>"+
      "<i class='bi bi-file-earmark me-2'></i>"+
      "<span>"+element.name+"</span>"+
      "</div>"+
      "<div class='btn-group' style='margin-right: -.5rem;'>"+
      "<button class='btn px-2' style='color: inherit;'>"+
      "<i class='bi bi-arrow-return-left'></i>"+
      "</button>"+
      "</div>"+
      "</a>";
   });


      console.log(document.getElementById('inputsearch').value);
      document.getElementById('resultsearch').innerHTML = stringresult;
      // "<a data-bs-toggle='modal' class='list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center active' href='#modal-detail-menu1'>"+
      // "<div>"+
      // "<i class='bi bi-file-earmark me-2'></i>"+
      // "<span>lampung</span>"+
      // "</div>"+
      // "<div class='btn-group' style='margin-right: -.5rem;'>"+
      // "<button class='btn px-2' style='color: inherit;'>"+
      // "<i class='bi bi-arrow-return-left'></i>"+
      // "</button>"+
      // "</div>"+
      // "</a>";

   }

   function searcharray(nameKey, myArray){
      var ressearch = [];
    for (let i=0; i < myArray.length; i++) {
        if ((myArray[i].name.includes(nameKey))) {
         // if 
         //console.log((myArray[i].name.includes('caffe')) )
            //return myArray[i];
            ressearch.push(myArray[i]);

        }
    }
    return ressearch;
}
</script>
