<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{$title ?? ''}} | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    <script src="{{ URL::asset('resources/js/app.js')}}"></script>
    @yield('css')

    @include('layouts.head-scripts')
    <style>
        .thead_design {
            background-color: #e1e1ee;
            border: 1px solid #000;
        }

        .design_title {
            font-size: 16px;
            background: -webkit-linear-gradient(rgb(81, 198, 228), #333);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    {{-- <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}
</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/libs/typeahead/typehead.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ URL::asset('assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/dataTables.buttons.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/vfs_fonts.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/buttons.html5.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/buttons.html5.js')}}"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.6.4/js/buttons.html5.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script> --}}

{{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script> --}}
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr, status) {
                removeErrorMessages();
            },
            beforeSubmit: function (formData, jqForm, options) {
                loadingButton(jqForm.find("button[type=submit]"), 'loading');
            }
        });
    });

        formBeforeSend = function (xhr, status, o) {
            removeErrorMessages();
        };

        formBeforeSubmit = function (formData, jqForm, options) {
            loadingButton(jqForm.find("button[type=submit]"), 'loading');
        };

        $(document).on("click", "button[type=submit]", function () {
            $(this).addClass('active');
        });

        loadingButton = function (button, loadingText) {
            button.data("original-content", button.html())
                .text(loadingText)
                .addClass("disabled")
                .attr('disabled', "disabled");

        };

        removeLoadingButton = function (button) {
            button.html(button.data("original-content"))
                .removeClass("disabled")
                .removeAttr("disabled")
                .removeAttr("rel");
        };



        formError = function (xhr, status, error, $form) {

            var obj = JSON.parse(xhr.responseText);

            swal("Errors!", obj.message, "error");

            removeLoadingButton($form.find("button[type=submit]"));

            $.each(obj.errors, function (key, error) {
                if (document.getElementById(key)) {
                    if ($form.find(":input[id=" + key + "]")) {
                        displayErrorMessage($form.find(":input[id=" + key + "]"), error[0]);
                    } else if ($form.find(":select[id=" + key + "]")) {
                        displayErrorMessage($form.find(":select[id=" + key + "]"), error[0]);
                    } else if ($form.find(":textarea[id=" + key + "]")) {
                        displayErrorMessage($form.find(":textarea[id=" + key + "]"), error[0]);
                    }
                } else {
                    if ($form.find(":input[name=" + key + "]")) {
                        displayErrorMessage($form.find(":input[name=" + key + "]"), error[0]);
                    } else if ($form.find(":select[name=" + key + "]")) {
                        displayErrorMessage($form.find(":select[name=" + key + "]"), error[0]);
                    } else if ($form.find(":textarea[name=" + key + "]")) {
                        displayErrorMessage($form.find(":textarea[name=" + key + "]"), error[
                        0]);
                    }
                }
            });
        };


        formSuccess = function (responseText, statusText, xhr, $form) {
            swal("Success!", responseText.message, "success");
            removeLoadingButton($form.find("button[type=submit]"));
        };


        removeErrorMessages = function () {
            $("form input").removeClass('form-control-danger').removeClass('form-control-success');
            $(".form-control-feedback").remove();
        };

        displayErrorMessage = function (element, message) {
            element.addClass('form-control-danger').removeClass('form-control-success');
            if (typeof message !== "undefined") {
                element.after(
                    $("<div class='form-control-feedback'>" + message + "</div>")
                );
            }
        };


    $(document).ready(function () {

        $('.modal.printable').on('shown.bs.modal', function () {
            $('.modal-dialog', this).addClass('focused');
            $('body').addClass('modalprinter');

        }).on('hidden.bs.modal', function () {
            $('.modal-dialog', this).removeClass('focused');
            $('body').removeClass('modalprinter');
        });

        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $('.currentDate').val(getDateFormat());
        $('.firstDate').val(getDateFormat(firstDay));
        $('.lastDate').val(getDateFormat(lastDay));
    });

    function getDateFormat(date = null) {
        if (date) {
            var now = new Date(date);
        } else {
            var now = new Date();
        }
        var month = (now.getMonth() + 1);
        var day = now.getDate();
        if (month < 10)
            month = "0" + month;
        if (day < 10)
            day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        return today;
    }
    var $input = $('input[name^="item_material_product_name"]');
        $input.typeahead({
            source: function (query, result) {
                delay(function () {
                    var purchaseType = $('#purchase_type').val();
                    if (!purchaseType) {
                        purchaseType = $('input[name^="item_material_product_name"]').data('type');
                    }
                    $.ajax({
                        url: "{{ route('product.product_search') }}",
                        method: "get",
                        dataType: "json",
                        data: {
                            code: query,
                            type: purchaseType
                        },
                        success: function (data) {
                            result($.map(data, function (item) {
                                return item;
                            }));
                        }
                    });
                }, 200);
            },
            autoSelect: true,
            hint: true,
            minLength: 2,
            cache: true,
            debug: false
        });

        $input.change(function (e) {
            var current = $input.typeahead("getActive");
            if (current) {
                $('input[name^="item_material_id"]').val(current.id);
                $('input[name^="item_material_code"]').val(current.code);
                $('input[name^="item_material_product_name"]').val(current.product_name);
                $('input[name^="item_material_unit"]').val('pcs');
                $('input[name^="item_material_unit_id"]').val(1);
                $('input[name^="item_material_pur_rate"]').val(current.purchase_price);
                $('input[name^="item_material_sale_rate"]').val(current.regular_price);
                $('input[name^="item_material_product_name"]').focus();
            }
            e.preventDefault();
        });

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();


    function IDGenerator(value = 10) {

        this.length = value;
        this.timestamp = +new Date;

        var _getRandomInt = function (min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        this.generate = function () {
            var ts = this.timestamp.toString();
            var parts = ts.split("").reverse();
            var id = "";

            for (var i = 0; i < this.length; ++i) {
                var index = _getRandomInt(0, parts.length - 1);
                id += parts[index];
            }

            return id;
        }
    }

</script>

    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
    @yield('script')
    @stack('script')
</body>

</html>
