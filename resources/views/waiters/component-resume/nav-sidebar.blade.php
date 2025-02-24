<div id="nav-sidebar" class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true">
   <div class="offcanvas-header pb-0">
      <h5 class="offcanvas-title fw-medium">Hello, Welcome</h5>
      <button class="btn-close ms-auto" data-bs-dismiss="offcanvas"></button>
   </div>
   <div class="offcanvas-body px-4">
      <div class="accordion accordion-flush" id="sidebar-menu">

         <div class="accordion-item">
            <h2 class="accordion-header">
               <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-menu">
                  menu
               </button>
            </h2>
            <div id="collapse-menu" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
               <div class="accordion-body pt-0 pe-0">

                  <!-- menu category -->
                  <div class="accordion accordion-flush" id="sidebar-menu-category">

                     <!-- menu category item -->
                     <div class="accordion-item">
                        <h3 class="accordion-header">
                           <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-menu-category">
                              menu category
                           </button>
                        </h3>
                        <div id="collapse-menu-category" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu-category">
                           <div class="accordion-body pt-0 pe-0">

                              <!-- menu subcategory -->
                              <div class="accordion accordion-flush" id="sidebar-menu-subcategory">

                                 <!-- menu subcategory item -->
                                 <div class="accordion-item">
                                    <h4 class="accordion-header">
                                       <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-menu-subcategory">
                                          menu subcategory
                                       </button>
                                    </h4>
                                    <div id="collapse-menu-subcategory" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu-subcategory">
                                       <div class="accordion-body pt-0 pe-0">
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                       </div>
                                    </div>
                                 </div>

                              </div>

                           </div>
                        </div>
                     </div>

                     <!-- menu category item -->
                     <div class="accordion-item">
                        <h3 class="accordion-header">
                           <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-menu-category2">
                              menu category
                           </button>
                        </h3>
                        <div id="collapse-menu-category2" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu-category">
                           <div class="accordion-body pt-0 pe-0">

                              <!-- menu subcategory -->
                              <div class="accordion accordion-flush" id="sidebar-menu-subcategory2">

                                 <!-- menu subcategory item -->
                                 <div class="accordion-item">
                                    <h4 class="accordion-header">
                                       <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-menu-subcategory2">
                                          menu subcategory
                                       </button>
                                    </h4>
                                    <div id="collapse-menu-subcategory2" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu-subcategory2">
                                       <div class="accordion-body pt-0 pe-0">
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                          <a class="btn w-100 text-start text-capitalize border-0" href="#">menu item</a>
                                       </div>
                                    </div>
                                 </div>

                              </div>

                           </div>
                        </div>
                     </div>

                  </div>

               </div>
            </div>
         </div>

         <div class="accordion-item">
            <h2 class="accordion-header">
               <button class="accordion-button text-capitalize collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-account">
                  my account
               </button>
            </h2>
            <div id="collapse-account" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
               <div class="accordion-body pt-0 pe-0">
                  <a class="btn w-100 text-start text-capitalize border-0" href="#">sign in</a>
                  <a class="btn w-100 text-start text-capitalize border-0" href="#">sign up</a>
                  <a class="btn w-100 text-start text-capitalize border-0" href="#">sign out</a>
                  <a class="btn w-100 text-start text-capitalize border-0" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   {{ __('Logout') }}
               </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="menu-link px-5">
                     @csrf
                 </form>
               </div>
            </div>
         </div>

      </div>
      <style>
      #sidebar-menu .accordion-button,
      #sidebar-menu .btn {
         padding: .75rem 0;
         color: #70421d!important;
         background-color: #cea787!important;
         border-color: rgba(112, 66, 29, .25)!important;
      }

      .accordion-button:not(.collapsed) {
         background-color: transparent!important;
         color: #323232;
         font-family: 'gotham medium';
         box-shadow: unset!important;
         color: #70421d!important;
         background-color: #cea787!important;
         border-color: rgba(112, 66, 29, .25)!important;
      }
      </style>
   </div>
</div>
