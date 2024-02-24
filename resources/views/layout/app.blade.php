@include('partials._header')

<style>
    .select2-selection__choice {
        font-size: 15px !important;
    }

    .userDatatable-header {
        text-align: center;
    }

    .tagify__tag>div {
		margin-top: -17%;
		height: 38px;
	}

	.tagify__tag>div>* {
		margin-top: 17% !important;
	}
    .tagify__input{
        margin-top: 0px !important;
    }
</style>
<style>
    th, td {
        text-align: center;
    }
    .select2-selection{
        border: 1px solid var(--border-light) !important;
    }
    .tagify {
        height: 33px;
    }

    .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single {
        height: 33px;
    }

    @if(app()->getLocale() == "ar")
            .select2-container--default .select2-selection--single .select2-selection__arrow {
        left: auto;
        right: 3%;
    }

    label {
        padding-bottom: 7px;
    }
    @endif
</style>
<body class="layout-light side-menu">
<div class="mobile-search">
    <form action="/" class="search-form">
        <img src="{{ asset('assets/img/svg/search.svg') }}" alt="{{ __('search') }}" class="svg">
        <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="{{ __('Search...') }}"
               aria-label="{{ __('Search') }}">
    </form>
</div>
<div class="mobile-author-actions"></div>
<header class="header-top">
    @include('partials._top_nav')
</header>
<main class="main-content">
    <div class="sidebar-wrapper">
        <aside class="sidebar sidebar-collapse" id="sidebar">
            @include('partials._menu')
        </aside>
    </div>
    <div class="contents">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css"
              rel="stylesheet"
              type="text/css">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>


        <script>
            @if($errors->any())
            $(document).ready(function () {
                Swal.fire({
                    type: 'error',
                    title: '{{__('Oops...')}}',
                    html: '{!! implode("<br>", $errors->all()) !!}'
                })
            });
            @endif
            @if(session('success'))
            $(document).ready(function () {
                Swal.fire({
                    type: 'success',
                    title: '{{session('success')}}',
                    showConfirmButton: false,
                    timer: 3000
                })
            });
            @endif

        </script>
        <script>
            $(document).ready(function () {
                // Select/Deselect all rows when the "select-all-checkbox" is clicked
                $("#select-all-checkbox").click(function () {
                    $(".row-checkbox").prop("checked", $(this).prop("checked"));
                });

                // Update the "select-all-checkbox" state based on row selections
                $(".row-checkbox").click(function () {
                    if ($(".row-checkbox:checked").length == $(".row-checkbox").length) {
                        $("#select-all-checkbox").prop("checked", true);
                    } else {
                        $("#select-all-checkbox").prop("checked", false);
                    }
                });
            });
        </script>
        @yield('content')

    </div>
    <footer class="footer-wrapper">
        @include('partials._footer')
    </footer>
</main>
<div id="overlayer">
		<span class="loader-overlay">
			<div class="dm-spin-dots spin-lg">
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
			</div>
		</span>
</div>
<div class="overlay-dark-sidebar"></div>
<div class="customizer-overlay"></div>
<div class="customizer-wrapper">
    @include('partials._customizer')

</div>

<script>
    var env = {
        iconLoaderUrl: "{{ asset('assets/js/json/icons.json') }}",
        googleMarkerUrl: "{{ asset('assets/img/markar-icon.png') }}",
        editorIconUrl: "{{ asset('assets/img/ui/icons.svg') }}",
        mapClockIcon: "{{ asset('assets/img/svg/clock-ticket1.sv') }}"
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>

<script src="{{ asset('assets/js/map.js') }}"></script>

<script src="{{ asset('assets/js/plugins.min.js') }}"></script>

<script>
    var $input = $("select")
    $input.select2()
    $("ul.select2-selection__rendered").sortable({
        containment: "parent"
    })
</script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
@vite('resources/js/app.js')
<script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace(".ckeditor")
</script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview
    )
    const elements = document.querySelectorAll("input[type=\"file\"].filepond")
    Array.from(elements).forEach(element => {
        const images = $(element).data('images');
        const filesObj = [];
        if (images && images.length) {
            images.forEach(image => {
                filesObj.push({
                    source: image,
                    options: {
                        // type: "local"
                    }
                });
            })
        }
        FilePond.create(element, {
            storeAsFile: true,
            acceptedFileTypes: ["image/*"],
            server: {
                load: async (source, load, error, progress, abort, headers) => {
                    let myRequest = new Request(source);
                    fetch(myRequest).then(function (response) {
                        response.blob().then(function (myBlob) {
                            load(myBlob);
                        });
                    })
                }
            },
            files: filesObj
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#show').click(function() {
                $('.menu').slideToggle("slide");
                $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
        });
    });
</script>


<script>


    (function () {

        var laravel = {
            initialize: function () {
                this.methodLinks = $('a[data-method]');
                this.token = $('a[data-token]');
                this.registerEvents();
            },

            registerEvents: function () {
                this.methodLinks.on('click', this.handleMethod);
            },

            handleMethod: function (e) {
                var link = $(this);
                var httpMethod = link.data('method').toUpperCase();
                var form;

                // If the data-method attribute is not PUT or DELETE,
                // then we don't know what to do. Just ignore.
                if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                    return;
                }

                // Allow user to optionally provide data-confirm="Are you sure?"
                if (link.data('confirm')) {
                    if (!laravel.verifyConfirm(link)) {
                        return false;
                    }
                }

                form = laravel.createForm(link);
                form.submit();

                e.preventDefault();
            },

            verifyConfirm: function (link) {
                return confirm(link.data('confirm'));
            },

            createForm: function (link) {
                var form =
                    $('<form>', {
                        'method': 'POST',
                        'action': link.attr('href')
                    });

                var token =
                    $('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': link.data('token')
                    });

                var hiddenInput =
                    $('<input>', {
                        'name': '_method',
                        'type': 'hidden',
                        'value': link.data('method')
                    });

                return form.append(token, hiddenInput)
                    .appendTo('body');
            }
        };

        laravel.initialize();

    })();
</script>

<script>

function setLayoutToStorage(layout) {
	localStorage.setItem('layout', layout);
	}
	function setThemeToStorage(theme) {
	localStorage.setItem('theme', theme);
	}
		if (typeof localStorage !== 'undefined') {
			const savedLayout = localStorage.getItem('layout');

			if (savedLayout) {
				const anchorTag = document.querySelector(`a[data-layout="${savedLayout}"]`);

				if (anchorTag) {
					anchorTag.click();
				}
			}
		}

		if (typeof localStorage !== 'undefined') {
			const savedLayout = localStorage.getItem('theme');

			if (savedLayout) {
				const anchorTag = document.querySelector(`a[data-layout="${savedLayout}"]`);

				if (anchorTag) {
					anchorTag.click();
				}
			}
		}
	</script>
@stack('scripts')

</body>

</html>
