<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            height: 12vh;
            background: #f1f2f2;
            background-repeat: repeat;
            background-position: center;
            background-size: auto;
        }
        
        .img-ratio {
            background: #f1f2f2;
            position: relative;

        }
    </style>
    <style>
        * {
            outline: solid 1px green;
            outline: solid 1px transparent;
        }
        .download-button {
    position: fixed;
    bottom: 0;
    left: 53%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
}

.back-button {
    position: fixed;
    bottom: 0;
    left: 48%;
    transform: translateX(-50%);
    padding: 8px 20px;
    background-color: #15cd77;
    color: white;
    text-decoration: none;
    outline: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
}

    </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <div id="targetElement"  style="width: 100%; max-width: 600px; margin: 0 auto;">
    <div class="main-header"  style="background-image: url('{{ url('assets/images/motif.svg') }}');">
      
    </div>
    <div class="main-body" style="text-align: center; display: flex; height: 100%; flex-direction: column; justify-content: space-evenly;">
        <div class="body-section header-logo">
            <div style="display: flex; justify-content: center;">
                {{-- <div style="padding-right: 2.5rem; border-right: solid 1px black;"> --}}
                    <div class="" style="aspect-ratio: 1/1; width: 100px;" style="background-image: url('{{ url('assets/images/ikon-supresso.ico') }}');">
                        <img src="{{ url('assets/images/Simbol-SDA-Red.ico') }}" width="100%" height="100%" >
                    </div>
                {{-- </div> --}}
                {{-- <div style="padding-left: 2.5rem;">
                    <div class="img-ratio" style="aspect-ratio: 1/1; width: 100px;" style="background-image: url('{{ url('assets/images/ikon-pandan.ico') }}');">
                        <img src="{{ url('assets/images/ikon-pandan.ico') }}" width="100%" height="100%" >
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="body-section">
            <p style="opacity: .6;">Member Name</p>
            <h2><b>@if(!empty($user->name))
                {{$user->name}}
            @endif
             </b></h2>
        </div>
        <div class="body-section">
            <p style="opacity: .6;">Member Since</p>
            <p> {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</p>
        </div>
        <div class="body-section" style="display: flex; flex-direction: column; align-items: center; row-gap: 1rem;">
            <div>
                <p>ID : {{$GetMember->uniquecode}} </p>
            </div>
            <div>
                <div class="img-ratio" style="aspect-ratio: 1/1; width: 40vw; max-width: 240px;" >
                    <img src="{{ url('qrcode/' . $GetMember->qrcode) }}" width="100%" height="100%" >
                </div>
            </div>
            <div>
                <div class="" style="aspect-ratio: 5/1; width: 80VW; max-width: 420px;" >
                    <img src="{{ url('barcode/' . $GetMember->barcode) }}" width="100%" height="100%" >
                </div>
               
            </div>
        </div>
    </div>
    <div class="main-footer" style="background-image: url('{{ url('assets/images/sulur.svg') }}');">
      
    </div>
</div>

<a href="/add_member" class="back-button">Back</a>
<button onclick="htmlToImage() " class="download-button">Donwload</button>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        var invoiceNumber = '{{$GetMember->uniquecode}}';

        function htmlToImage() {
            var element = document.getElementById(
                'targetElement'); // Gantilah 'targetElement' dengan ID elemen HTML yang ingin Anda konversi
            html2canvas(element, {
                height: 1000,
                backgroundColor: 'white' // Atur latar belakang warna putih
            }).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');

                // Buat elemen tautan untuk mengunduh gambar
                var downloadLink = document.createElement('a');
                downloadLink.href = imgData;
                downloadLink.download = invoiceNumber + '.png'; // Nama file yang akan diunduh

                // Tambahkan elemen tautan ke dokumen dan klik otomatis
                document.body.appendChild(downloadLink);
                downloadLink.click();

                // Hapus elemen tautan setelah diunduh
                document.body.removeChild(downloadLink);
            });
        }

       
    </script>
</body>
</html>