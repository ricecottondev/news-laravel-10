@extends('layouts.master')
@section('title')
    @lang('translation.Create')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/ui/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
@endsection

<style>
    .example-canvas {
        background-color: lightgray;
        border-radius: 5px;
        width: 200px;
        height: 120px;
        margin: 0px auto;
        padding: 10px;
    }

    .gray{
        background-color: gray;
    }

    .darkgray {
        background-color: darkgrey;
    }

    .example-title {
        height: 15px;
        width: 80px;
        border-radius: 5px;
        margin-top : 30px;
    }

    .example-below-title {
        height: 10px;
        width: 60px;
        border-radius: 5px;
        margin-top : 5px;
    }

    .example-below-desc {
        height: 7px;
        width: 75px;
        border-radius: 5px;
        margin-top : 5px;
    }

    .example-btn {
        background-color: orangered;
        height: 7px;
        width: 20px;
        border-radius: 5px;
        margin-top : 5px;
    }

    .example-custom {
        background-color: gray;
        height: 59px;
        width: 80px;
        border-radius: 5px;
        margin-top : 30px;
    }
</style>

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') Create @endslot
    @endcomponent

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div>
            <h2>Sliders</h2>
        </div>
        <div class="mb-3">
            <div class="float-end">
                <a class="btn btn-sm btn-outline-dark" href="{{ route('sliders.index') }}"><i class="bi bi-chevron-left"></i> Kembali</a>
            </div>
        </div>
        <br>
        <br>
        <div class="mb-3">
            <div class="float-end">
                <span>
                    <label for="">Normal</label>
                    <input class="radio form-check-input me-3" type="radio" name="radioNoLabel" id="radioNoLabel1" value="normal" aria-label="..." onclick="check()" checked>
                </span>
                <span>
                    <label for="">Custom</label>
                    <input class="radio form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2" value="custom" aria-label="..." onclick="check()">
                </span>
            </div>
        </div>
    </div>
</div>

<hr/>
<div class="mt-3">
    {{-- form --}}
    <form method="POST" action="{{ route('sliders.store') }}" id="form-add" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="title" id="title"/>
        <input type="hidden" name="custom_script" id="custom_script"/>
        <input type="hidden" name="url" id="url"/>
        <input type="hidden" name="below_title" id="below_title"/>
        <input type="hidden" name="desc" id="desc"/>
        <input type="hidden" name="active_date" id="active_date"/>
        <input type="hidden" name="type" id="type"/>
        <input type="hidden" name="text_color" id="text_color"/>
        <input type="hidden" name="json_text_form" id="json_text_form"/>
        <label for="" class="mt-3">Desktop Image</label>
        <input type="file" name="dekstop_image" id="" class="form-control"/>
        <label for="" class="mt-3">Mobile Image</label>
        <input type="file" name="mobile_image" id="" class="form-control"/>
    </form>
</div>
<hr/>
<div id="panel-normal">
    <div class="float-end mb-3">
        <span>
            <label for="">Text Dark</label>
            <input class="radio form-check-input me-3" type="radio" name="radioTextColor" id="radio-dark" value="dark" aria-label="..." onclick="checkTextColor(this.id)">
        </span>
        <span>
            <label for="">Text Light</label>
            <input class="radio form-check-input" type="radio" name="radioTextColor" id="radio-light" value="light" aria-label="..." onclick="checkTextColor(this.id)">
        </span>
    </div>
    <br>
    <br>
    <div class="mt-3">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="example-canvas">
                    <div class="example-title gray"></div>
                    <div class="example-below-title darkgray"></div>
                    <div class="example-below-desc darkgray"></div>
                    <div class="example-btn"></div>
                </div>
            </div>
            <div class="col-md-8">
                <label for="" class="mt-3">Title</label>
                <input type="text" class="form-control mb-2" name="" id="add-title" />
                <div>
                    <span>
                        <label for="">Text Bold</label>
                        <input class="radio form-check-input me-3 radio-text-form" type="radio" name="radio-text-title" id="radio-bold-title" value="bold" aria-label="...">
                    </span>
                    <span>
                        <label for="">Text Thin</label>
                        <input class="radio form-check-input radio-text-form" type="radio" name="radio-text-title" id="radio-thin-title" value="thin" aria-label="...">
                    </span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="example-canvas">
                    <div class="example-title darkgray"></div>
                    <div class="example-below-title gray"></div>
                    <div class="example-below-desc darkgray"></div>
                    <div class="example-btn"></div>
                </div>
            </div>
            <div class="col-md-8">
                <label for="" class="mt-3">Below Title</label>
                <input type="text" class="form-control mb-2" name="" id="add-below-title"/>
                <div>
                    <span>
                        <label for="">Text Bold</label>
                        <input class="radio form-check-input me-3 radio-text-form" type="radio" name="radio-text-belowtitle" id="radio-bold-belowtitle" value="bold" aria-label="...">
                    </span>
                    <span>
                        <label for="">Text Thin</label>
                        <input class="radio form-check-input radio-text-form" type="radio" name="radio-text-belowtitle" id="radio-thin-belowtitle" value="thin" aria-label="...">
                    </span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="example-canvas">
                    <div class="example-title darkgray"></div>
                    <div class="example-below-title darkgray"></div>
                    <div class="example-below-desc gray"></div>
                    <div class="example-btn"></div>
                </div>
            </div>
            <div class="col-md-8">
                <label for="" class="mt-3">Desc</label>
                <input type="text" class="form-control mb-2" name="" id="add-desc"/>
                <div>
                    <span>
                        <label for="">Text Bold</label>
                        <input class="radio form-check-input me-3 radio-text-form" type="radio" name="radio-text-desc" id="radio-bold-desc" value="bold" aria-label="...">
                    </span>
                    <span>
                        <label for="">Text Thin</label>
                        <input class="radio form-check-input radio-text-form" type="radio" name="radio-text-desc" id="radio-thin-desc" value="thin" aria-label="...">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <label for="" class="mt-3">Button Target Url</label>
    <input type="text" name="" class="form-control" id="add-target-url"/>
</div>
<div id="panel-custom">
    <label for="" class="mt-3">Title</label>
    <input type="text" name="" class="form-control" id="add-custom-title"/>
    <br>
    <div class="example-canvas mt-3">
        <div class="example-custom"></div>
    </div>
    <label for="" class="mt-3">Custom Script</label>
    <textarea name="" cols="30" rows="15" class="form-control" id="add-custom-script"></textarea>
</div>

<label for="" class="mt-3">Active Date</label>
<input type="date" name="" class="form-control" id="add-active-date"/>

<div class="mt-3 mb-3" style="text-align: right;">
    <button class="btn btn-success" id="btn-save"><i class="bi bi-check-lg"></i> Save</button>
</div>

<script src="{{asset('ui/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{asset('assets/libs/codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('assets/libs/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('assets/libs/codemirror/addon/edit/matchbrackets.js')}}"></script>
<script src="{{asset('assets/libs/codemirror/addon/edit/search.js')}}"></script>
<script src="{{asset('assets/libs/codemirror/addon/edit/searchcursor.js')}}"></script>
<script>

    let textForm  = {title:"thin", below_title:"thin", desc:"thin"};
    let textColor = "light";
    let textArea  = document.getElementById("add-custom-script");
    let editor    = CodeMirror.fromTextArea(textArea, {
                        lineNumbers: true,
                        mode: "xml",
                        htmlMode:true,
                        matchBrackets: true,
                        theme:"dracula",
                    });    

    $(document).ready(function(){
        check();
        $("#radio-light").prop("checked", true);
        $("#radio-thin-title").prop("checked", true);
        $("#radio-thin-belowtitle").prop("checked", true);
        $("#radio-thin-desc").prop("checked", true);
    });

    function check() {
        const type = $(".radio:checked").val();
        if (type == "normal"){
            $("#panel-normal").show();
            $("#panel-custom").hide();
        } else {
            // custom
            $("#panel-normal").hide();
            $("#panel-custom").show();
        }
    };

    $("#btn-save").on('click', function(){
        const str = confirm('Apakah anda yakin akan menyimpan ?');
        if (str) {

            const type          = $(".radio:checked").val();
            const belowTitle    = $("#add-below-title").val();
            const desc          = $("#add-desc").val();
            const activeDate    = $("#add-active-date").val();
            const customScript  = $("textarea#add-custom-script").val();
            const targetUrl     = $("#add-target-url").val();

            let title = "";
            let isAllowSubmit = false;
            if (type == "normal"){
                title = $("#add-title").val();
                isAllowSubmit = activeDate != "" && targetUrl != "";
            } else {
                title = $("#add-custom-title").val();
                isAllowSubmit = activeDate != "" && title != "" && customScript != "";
            }
            
            if (!isAllowSubmit){
                alert("Pastikan Setiap Form Dilengkapi");
                return;
            }

            $("#title").val(title);
            $("#custom_script").val(customScript);
            $("#url").val(targetUrl);
            $("#below_title").val(belowTitle);
            $("#desc").val(desc);
            $("#active_date").val(activeDate);
            $("#type").val(type);
            $("#text_color").val(textColor);
            $("#json_text_form").val(getAllFormRadio());
            $("#form-add").submit();
        }
    });

    function checkTextColor(id){
        const selectedVal = $("#"+id).val();
        textColor = selectedVal;
    }

    function checkTextForm(id){
        const selectedVal = $("#"+id).val();
        console.log(getAllFormRadio());
    }

    function getAllFormRadio(){
        const allFormRadio = $(".radio-text-form");
        $.each(allFormRadio, function(i, item){
            if ($(item).is(":checked")){

                const arrId = item.id.split("-");
                switch(arrId[2]) {
                    case "title" : 
                        textForm.title = item.value;
                        break;
                    case "belowtitle" : 
                        textForm.below_title = item.value;
                        break;
                    case "desc" :
                        textForm.desc = item.value;
                        break;
                    default :
                        break;            
                }
            }
        });
        return JSON.stringify(textForm);
    }


</script>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
