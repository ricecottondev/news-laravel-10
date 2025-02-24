<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Member Qr-Code</title>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            background: white;
            color: black;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        .main-header,
        .main-footer {
            height: 2vh;
            background: #fff;
            background-repeat: repeat;
            background-position: center;
            background-size: auto;
        }

        .img-ratio {
            background: #f1f2f2;
            position: relative;
        }

        .bg-gray {
            background-color: #eeeeee;
            background-image: url('{{ url('sdamember-template/img/svg/sda_icon.svg') }}');
            background-repeat: no-repeat;
            background-position: center;
        }

        hr {
            border: 1px solid #000;
            opacity: 1;
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 1rem;
        }

        .body-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu {
            text-align: center;
            row-gap: 8rem;
            display: flex;
            height: 100%;
            flex-direction: column;
            justify-content: space-evenly;
        }
    </style>
    <style>
        * {
            outline: solid 1px green;
            outline: solid 1px transparent;
        }
    </style>
</head>

<body>
    <div class="main-header">

    </div>
    <div class="container">
        <div class="main-body bg-gray px-4"
            style="text-align: center; display: flex; height: 100%; flex-direction: column; justify-content: space-evenly; border-radius:2em;">
            <hr>
            <div class="body-section header-logo">
                <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                    <label for="imageInput" style="cursor: pointer;">
                        <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                            <img class="rounded-circle" src="" alt="" id="userImage">
                        </div>
                    </label>
                    <input type="file" id="imageInput" style="display: none;" accept="image/*">
                </div>
            </div>
            <div class="body-section">
                <h2><b> {{ $user->name }} </b></h2>
                <p>ID : {{ $GetMember->uniquecode }} </p>
            </div>
            <div class="body-section"
                style="display: flex; flex-direction: column; align-items: center; row-gap: 1rem;">
                <div>
                </div>
                <div>
                    <div class="img-ratio" style="aspect-ratio: 1/1; width: 40vw; max-width: 240px;">
                        <img src="{{ url('qrcode/' . $GetMember->qrcode) }}" width="100%" height="100%">
                    </div>
                </div>
                <div>
                    <div class="" style="aspect-ratio: 5/1; width: 80VW; max-width: 420px;">
                        <img src="{{ url('barcode/' . $GetMember->barcode) }}" width="100%" height="100%">
                    </div>
                </div>
                <p>Pindai kode QR anda di kasir untuk mendapatkan poin member</p>
            </div>
            <hr>
        </div>
    </div>
    <div class="main-footer">

    </div>
    {{-- <div class="container">
        <div class="card my-4 border-0 bg-gray text-center">
            <div class="card-body">
                <hr>
                <div class="menu">
                    <div class="center">
                        <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                            <label for="imageInput" style="cursor: pointer;">
                                <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                                    <img class="rounded-circle" src="" alt="" id="userImage">
                                </div>
                            </label>
                            <input type="file" id="imageInput" style="display: none;" accept="image/*">
                        </div>
                    </div>

                    <div class="body-section">
                        <h2><b> alfin alfin </b></h2>
                        <p>ID 00000000000</p>
                    </div>
                    <div class="body-section">
                        <div class="img-ratio" style="aspect-ratio: 1/1;width: 50vw;max-width: 240px;">
                            <img src="{{ url('sdamember-template/img//jpg/qr.jpg') }}" width="100%"
                                height="100%">
                        </div>
                    </div>
                    <div class="body-section" >
                        <p style="width: 70%; text-align:center;">Pindai kode QR anda di kasir untuk
                            mendapatkan oin member</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
