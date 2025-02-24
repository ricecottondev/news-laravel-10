@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Setting Web</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Setting Web</li>
                            </ul>
                        </div>

                    </div>
                </div>


                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body">

                                <form id="formupdateimage" method="post" enctype="multipart/form-data">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <img src="{{ url('images/' . 'logo-baru-dark.svg') }}" width="200"
                                                height="auto" alt="">
                                        </div>

                                        <div class="col">
                                            {{-- <input type="file" class="form-control" id="newimage" > --}}
                                            <input id="fileupload" class="form-control" type="file" name="fileupload" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="UpdateImageWeb()" style="min-width: 200px;"
                                                class="btn btn-secondary mb-3">Update Image Logo</button>
                                        </div>
                                    </div>
                                </form>

                                <form id="formupdateimagebanner1" method="post" enctype="multipart/form-data">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <img src="{{ url('files/info-images/banner-1.jpg') }}" width="200"
                                                height="auto" alt="">
                                        </div>

                                        <div class="col">
                                            {{-- <input type="file" class="form-control" id="newimage" > --}}
                                            <input id="fileuploadbanner1" class="form-control" type="file" name="fileuploadbanner1" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="UpdateImageBanner(1)" style="min-width: 200px;"
                                                class="btn btn-secondary mb-3">Update Image Banner 1</button>
                                        </div>
                                    </div>
                                </form>
                                <form id="formupdateimagebanner2" method="post" enctype="multipart/form-data">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <img src="{{ url('files/info-images/banner-2.jpg') }}" width="200"
                                                height="auto" alt="">
                                        </div>

                                        <div class="col">
                                            {{-- <input type="file" class="form-control" id="newimage" > --}}
                                            <input id="fileuploadbanner2" class="form-control" type="file" name="fileuploadbanner2" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="UpdateImageBanner(2)" style="min-width: 200px;"
                                                class="btn btn-secondary mb-3">Update Image Banner 2</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                    id="kt_modal_add_Onepoint_merchant_scroll" data-kt-scroll="true"
                                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_Onepoint_merchant_header"
                                    data-kt-scroll-wrappers="#kt_modal_add_Onepoint_merchant_scroll"
                                    data-kt-scroll-offset="300px">
                                </div> --}}


                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection

<script>
    const baseapi = "{{ URL::to('/') }}";
    async function UpdateImageWeb() {
        let formData = new FormData();
        formData.append("file", fileupload.files[0]);
        // formData.append("iduser", iduser);
        // formData.append("name", nameuser);
        await fetch(baseapi + "/api/updateimageweb", {
            method: "POST",
            body: formData,
        });
        alert("The New Logo has been uploaded successfully.");
        location.reload();
    }

    async function UpdateImageBanner(bannerid) {
        alert("banner nya "+bannerid)
        let formData = new FormData();
        if(bannerid===1)
        {
            formData.append("file", fileuploadbanner1.files[0]);
        }
        else
        if(bannerid===2)
        {
            formData.append("file", fileuploadbanner2.files[0]);
        }
        // formData.append("file", fileuploadbanner.files[0]);
        formData.append("bannerid", bannerid);
        await fetch(baseapi + "/api/updateimagebanner", {
            method: "POST",
            body: formData,
        });
        alert("The New Banner has been uploaded successfully.");
        location.reload();
    }
</script>
