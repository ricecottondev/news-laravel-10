<div id="modal-profile" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable" style="$modal-fade-transform: scale(.8)">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 position-absolute top-0 start-0" style="z-index: 100;">
                <div id="buttonclosemodal"><button class="btn-close text-bg-light" data-bs-dismiss="modal"></button></div>
            </div>
            <div class="modal-body p-0 m-3">
                <div class="row mt-5">
                    <div class="col-lg-12 mb-4">
                        <div class="symbol-label">
                            @if (!empty($user->image))
                                <img src="{{ url('images') }}/users/{{ $user->image }}" alt="user image"
                                    class="img-fluid" />
                            @else
                                <img src="{{ url('images') }}/imagenotavailable.jpg" alt="user image"
                                    class="img-fluid" />
                            @endif
                        </div>
                    </div>
                </div>

                <div class="accordion accordion-flush" id="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseInformasiPribadi" aria-expanded="false"
                                aria-controls="collapseInformasiPribadi">
                                Informasi Pribadi
                            </button>
                        </h2>
                        <div id="collapseInformasiPribadi" class="accordion-collapse collapse"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="text-center text-secondary">
                                    {{ Str::upper($nameuser) }}
                                </div>
                                <div class="text-center text-secondary" style="font-size:12px; font-weight:300;">
                                    Phone : {{ $phone }}
                                </div>
                                <div class="text-center text-secondary">

                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">{{ $email }}</h3>
                                </div>
                                <div class="text-center text-secondary" style="font-size: 10px">
                                    JoinDate : {{ $joindate }}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseUpdatePassword" aria-expanded="false"
                                aria-controls="collapseUpdatePassword">
                                Update Password
                            </button>
                        </h2>
                        <div id="collapseUpdatePassword" class="accordion-collapse collapse"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <form class="row">
                                    <div class="col">
                                        <input type="password" class="form-control" id="newpassword"
                                            placeholder="Password">
                                    </div>
                                    <div class="col">
                                        <button type="button" onclick="UpdatePasswordMember()" class="btn btn-secondary mb-3">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                     
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseUpdateImage" aria-expanded="false"
                                aria-controls="collapseUpdateImage">
                                Update Image
                            </button>
                        </h2>
                       

                        <div id="collapseUpdateImage" class="accordion-collapse collapse"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <form  id="formupdateimage" class="row" method="post" enctype="multipart/form-data">
                                    <div class="col">
                                        {{-- <input type="file" class="form-control" id="newimage" > --}}
                                        <input id="fileupload" class="form-control" type="file" name="fileupload" />
                                    </div>
                                    <div class="col">
                                        <button type="button" onclick="UpdateImageMember()" class="btn btn-secondary mb-3">Update Image</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>


            </div>

            <div class="modal-footer p-0 m-3">
               
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="menu-link d-block w-100">
                    @csrf
                    <button type="submit" class="btn btn-secondary d-block w-100 border" onclick="return confirm('Are you sure?');">LOGOUT</button>
                    
                </form>
            </div>
        </div>
        <div class="modal-footer border-dark-subtle"></div>
    </div>
</div>
</div>
