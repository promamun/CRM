<script src="{{asset('/frontend/')}}/assets/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap js-->
<script src="{{asset('/frontend/')}}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="{{asset('/frontend/')}}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="{{asset('/frontend/')}}/assets/js/scrollbar/simplebar.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="{{asset('/frontend/')}}/assets/js/config.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('/frontend/')}}/assets/js/sidebar-menu.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/chartist/chartist.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/knob/knob.min.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/knob/knob-chart.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/dashboard/default.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/notify/index.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/typeahead/handlebars.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/typeahead/typeahead.bundle.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/typeahead/typeahead.custom.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/typeahead-search/handlebars.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugins JS Ends-->
<script src="{{asset('/frontend/')}}/assets/js/select2/select2.full.min.js"></script>
<script src="{{asset('/frontend/')}}/assets/js/select2/select2-custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Theme js-->
<script src="{{asset('/frontend/')}}/assets/js/script.js"></script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
