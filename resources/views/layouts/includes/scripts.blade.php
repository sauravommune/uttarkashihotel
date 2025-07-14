<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var HOST_URL = "{{ url('/') }}";
    //todo: check this and remove if not rerquired

    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('/assets/global/plugins.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('/assets/js/prismjs.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('/assets/js/scripts.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/floating-whatsapp-master/floating-wpp.js') }}"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
@if(Auth::check())
<script src="{{ asset('/assets/js/session-timeout.js') }}"></script>
@endif
<!--end::Global Theme Bundle-->

<script>
    $(function () {
        $('#whatsappbutton').floatingWhatsApp({
            phone: '+918010009625',
            popupMessage: 'Hello, how can we help you?',
            message: "Hi..",
            showPopup: true,
            showOnIE: false,
            buttonImage: '<img src="{{ asset('/') }}assets/media/logos/whatsapp-512.webp " />',
            zIndex:9999,
            position:'right',
            size:'60px'
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function setMenuItemActive() {
        $('#kt_header_menu li').removeClass('menu-item-active');
        var currentUrl = window.location.pathname + window.location.hash;
        $('#kt_header_menu a[href="' + currentUrl + '"]').parents('li').addClass('menu-item-active');

        var subpaths = (window.location.pathname.substr(1) + window.location.hash).split('/');
        for(let key in subpaths) {
            if(!$("#kt_header_menu li").hasClass('menu-item-active')) {
                $('#kt_header_menu a[href="/' + subpaths[key] + '"]').parents('li').addClass('menu-item-active');
                $('#kt_header_menu a[href="' + subpaths[key] + '"]').parents('li').addClass('menu-item-active');
            }
        }
    }
    $(document).ready(setMenuItemActive);

    function handleError(x, status, error){
        $(document).find('.dataTables_processing').hide();
       
        switch(x.status){
            case 419:
               // location.reload();
            break;
            case 401:
               // location.reload();
            default:

        }
    }

    $(function () {
        $.ajaxSetup({
            error: function (x, status, error) {
                handleError(x, status, error);
            } 
                
        });
    });

    $('body').on('click','.headernotifiction', function(){
        $.ajax({
            type: "POST",
            url: '{{route("headernotifiction")}}',
            data: {},
            success: function (data) {  
                $('.pulse-ring').remove();
            }
           
        });
    }); 
    
    $('body').on('click','.headernotifictionClient', function(){
        $.ajax({
            type: "POST",
            url: '{{route("headernotifictionClient")}}',
            data: {},
            success: function (data) {  
                $('.pulse-ring').remove();
            }
           
        });
    });    

</script>

<!--begin::Page Scripts(used by this page)-->
@yield('page_scripts')
<!--end::Page Scripts-->
