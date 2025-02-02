<x-app-layout layout="simple" :assets="$assets ?? []">
<span class="uisheet screen-darken"></span>
    <div class="header" style="background: url({{asset('images/dashboard/top-image.jpg')}}); background-size: cover; background-repeat: no-repeat; height: 100vh;position: relative;">
        <div class="main-img">
            <div class="container">
                {{-- <svg width="150" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="-0.423828" y="34.5762" width="50" height="7.14286" rx="3.57143" transform="rotate(-45 -0.423828 34.5762)" fill="white"/>
                    <rect x="14.7295" y="49.7266" width="50" height="7.14286" rx="3.57143" transform="rotate(-45 14.7295 49.7266)" fill="white"/>
                    <rect x="19.7432" y="29.4902" width="28.5714" height="7.14286" rx="3.57143" transform="rotate(45 19.7432 29.4902)" fill="white"/>
                    <rect x="19.7783" y="-0.779297" width="50" height="7.14286" rx="3.57143" transform="rotate(45 19.7783 -0.779297)" fill="white"/>
                </svg> --}}
                {{-- <div class="card">
                    <div class="card-body bg-transparent">

                        <h1 class="my-4">
                            <span class="text-white">{{env('APP_NAME')}} </span>
                        </h1>
                    </div>
                </div> --}}
                <div class="card" style="background-color:rgba(255,255,255,0.7);">
                    <div class="card-body" >
                        <img class="" src="{{asset('images/logo_sucofindo.png')}}" alt="" style="margin-bottom:3rem">
                        <h4 class="text-BLACK mb-5"><b>SUCOFINDO PRODUK EKSPORT KRATOM</b>.</h4>
                    </div>
                </div>
            </div>
            {{-- <div class="container">
                <div class="card">
                    assad
                </div>
            </div> --}}
        </div>
        <div class="container">
            <nav class="nav navbar navbar-expand-lg navbar-light top-1 rounded">
                <div class="container-fluid">
                    <a class="navbar-brand mx-2" href="#">
                        {{-- <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                        </svg> --}}
                        <img src="{{asset('images/logo_sucofindo.png')}}" alt="" style="width: 30px">
                        {{-- <h5 class="logo-title">{{env('APP_NAME')}}</h5> --}}
                        <h5 class="logo-title">SUCOFINDO</h5>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-2">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
                            <li class="nav-item mt-2">
                                <button type="button" class="btn btn-outline-info btn-icon" aria-current="page" id="regis_btn"  data-bs-toggle="modal" data-bs-target="#regisModal">Registration</button>
                            </li>
                            <li class="nav-item me-3">
                                {{-- <a class="nav-link" aria-current="page" href="https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/change-log.html" target="_blank"></a>
                                    https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/
                                --}}
                            </li>
                            <li class="nav-item">
                                <a href="{{route('web.login_page')}}" class="btn btn-outline-secondary" aria-current="page" target="_blank">
                                    <svg class="icon-32 me-1" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M7.29639 6.446C7.29639 3.995 9.35618 2 11.8878 2H16.9201C19.4456 2 21.5002 3.99 21.5002 6.436V17.552C21.5002 20.004 19.4414 22 16.9098 22H11.8775C9.35205 22 7.29639 20.009 7.29639 17.562V16.622V6.446Z" fill="currentColor"></path>
                                        <path d="M16.0374 11.4538L13.0695 8.54482C12.7627 8.24482 12.2691 8.24482 11.9634 8.54682C11.6587 8.84882 11.6597 9.33582 11.9654 9.63582L13.5905 11.2288H3.2821C2.85042 11.2288 2.5 11.5738 2.5 11.9998C2.5 12.4248 2.85042 12.7688 3.2821 12.7688H13.5905L11.9654 14.3628C11.6597 14.6628 11.6587 15.1498 11.9634 15.4518C12.1168 15.6028 12.3168 15.6788 12.518 15.6788C12.717 15.6788 12.9171 15.6028 13.0695 15.4538L16.0374 12.5448C16.1847 12.3998 16.268 12.2038 16.268 11.9998C16.268 11.7948 16.1847 11.5988 16.0374 11.4538Z" fill="currentColor"></path>
                                    </svg>
                                    Log-In
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</x-app-layout>

<div class="modal fade" id="regisModal" tabindex="-1" aria-labelledby="regisModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-soft-success">
                <h5 class="modal-title" id="regisModalLabel">Instruksi Registrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p class="text-black"> Untuk Mendapatkan Hak Akses atau Akun Login bisa dengan cara menghungi Kantor Cabang terdekat</p>
               <p class="text-black">(silahkan Hubungi Nomer Telphone atau Kontak pada bagian bawah Halaman ini)</p>
               <p class="text-black"> Serta dengan melampirkan :</p>
               <ul>
                <li class="text-black">KTP</li>
                <li class="text-black">ET</li>
                <li class="text-black">NPWP</li>
                <li class="text-black">NIB</li>
               </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $('#regis_btn').click(function(){
            console.log('a');
        })
    });
</script>
