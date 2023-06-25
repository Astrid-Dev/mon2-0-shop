<!-- JS here -->
@livewireScripts
<script src={{asset("assets/js/vendor/jquery.js")}}></script>
<script src={{asset("assets/js/vendor/waypoints.js")}}></script>
<script src={{asset("assets/js/bootstrap-bundle.js")}}></script>
<script src={{asset("assets/js/meanmenu.js")}}></script>
<script src={{asset("assets/js/swiper-bundle.js")}}></script>
<script src={{asset("assets/js/slick.js")}}></script>
<script src={{asset("assets/js/range-slider.js")}}></script>
<script src={{asset("assets/js/magnific-popup.js")}}></script>
<script src={{asset("assets/js/nice-select.js")}}></script>
<script src={{asset("assets/js/purecounter.js")}}></script>
<script src={{asset("assets/js/countdown.js")}}></script>
<script src={{asset("assets/js/wow.js")}}></script>
<script src={{asset("assets/js/isotope-pkgd.js")}}></script>
<script src={{asset("assets/js/imagesloaded-pkgd.js")}}></script>
<script src={{asset("assets/js/ajax-form.js")}}></script>
<script src={{asset("assets/js/main.js")}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOur": 5000
        }
    });
</script>

