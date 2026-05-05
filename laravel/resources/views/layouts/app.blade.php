<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Web Desa Digital</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/fontawesome-free/css/all.min.css") }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/jqvmap/jqvmap.min.css") }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset("adminlte/dist/css/adminlte.min.css") }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/daterangepicker/daterangepicker.css") }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset("adminlte/plugins/summernote/summernote-bs4.css") }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        {{-- Font for tinymce --}}
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');
        </style>

        <!-- Core JS files -->
        <script src="{{ url("limitless/global_assets/js/main/jquery.min.js") }}"></script>
        <script src="{{ url("limitless/global_assets/js/plugins/loaders/blockui.min.js") }}"></script>
        {{-- <script src="{{ url("limitless/global_assets/js/plugins/ui/ripple.min.js") }}"></script> --}}
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{ url("limitless/global_assets/js/plugins/forms/selects/select2.min.js") }}"></script>
        @yield("script_before_app")

        {{-- <script src="{{ url("limitless/assets/js/app.js") }}"></script> --}}
        @yield("head_theme_script")
        <!-- /theme JS files -->

        {{-- Editor --}}
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script> --}}

        <link rel="stylesheet" href="{{ url("trumbowyg/dist/ui/trumbowyg.min.css") }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/trumbowyg.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/plugins/table/trumbowyg.table.min.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/jquery-resizable-columns@0.2.3/jquery.resizableColumns.min.js"></script>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/jquery-resizable-columns@0.2.3/jquery.resizableColumns.css">
        <link rel="stylesheet" href="{{ url("trumbowyg/dist/plugins/table/ui/sass/trumbowyg.table.scss") }}">
        <script src="{{ url("trumbowyg/dist/plugins/table/trumbowyg.table.js") }}"></script>

        {{-- Sweat Allert --}}
        <script src="{{ "https://cdn.jsdelivr.net/npm/sweetalert2@11" }}"></script>
        <script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>

        <style>
            .cursor-pointer {
                cursor: pointer !important;
            }

            .valign-middle {
                vertical-align: middle;
            }

            .text-center {
                text-align: center;
            }

            ,
            .trumbowyg-editor {
                font-family: "Times New Roman", Times, serif !important;
            }

            .uppercase {
                text-transform: uppercase;
            }

            .padding-0-important {
                padding: 0 !important;
            }
        </style>

        <style>
            .trumbowyg-editor table {
                display: table !important;
                table-layout: auto;
                width: 100%;
                border-collapse: collapse;
            }

            .trumbowyg-editor table td,
            .trumbowyg-editor table th {
                border: 1px solid #ccc;
                padding: 8px;
                resize: horizontal;
                overflow: auto;
            }

            table th.blocked,
            table td.blocked {
                display: none !important;
                /* Hide the column */
                pointer-events: none !important;
                /* Prevent interaction */
                background-color: #f0f0f0 !important;
                /* Optional: visually block the column */
            }

            .a4-size {
                width: 794px;
                height: 1123px;
            }

            .legal-size {
                width: 850px;
                height: 1400px;
            }

            .trumbowyg-box,
            .trumbowyg-editor {
                height: 100%;
                box-sizing: border-box;
            }

            .editor-wrapper {
                margin: 20px auto;
                padding: 0;
                background: #f8f8f8;
                /* text-align: lef; */
            }

            .paper-size {
                margin: auto;
                height: auto;
                width: 100%;
                background: white;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }

            /* Jarak tab (4 spasi) */
            .mce-content-body {
                tab-size: 4;
                -moz-tab-size: 4;
                -o-tab-size: 4;
                white-space: pre-wrap;
                /* Pertahankan spasi */
            }
        </style>
        <script src="https://cdn.tiny.cloud/1/lay6ickwk8ow14zhlwnva7j60vzbeubnrysij6x10v6hver5/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>

    </head>

    <body class="hold-transition sidebar-mini layout-fixed" style="height: auto;">
        <div class="wrapper">
            <div id="app">
                <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route("login") }}">{{ __("Login") }}</a>
                            </li>
                            @if (Route::has("register"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("register") }}">{{ __("Register") }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Messages Dropdown Menu -->
                            <div class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    {{ Auth::user()->name }} <i class="fas fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route("useredit", Auth::user()->id) }}">Edit
                                        Profile</a>
                                    <a class="dropdown-item" href="{{ route("logout") }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __("Logout") }}
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </ul>
                </nav>

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Brand Logo -->
                    <a href="#" class="brand-link text-center">
                        <img src="{{ asset("img/kab-logo.png") }}" alt="img"
                            class="brand-image img-circle elevation-3"
                            style="opacity: .8; background: transparant !important">
                        <span class="brand-text font-weight-light">Administrasi Online</span>
                    </a>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">

                                @role("Staff Desa")
                                    <li class="nav-item">
                                        <a href="{{ route("templatesurat") }}"
                                            class="nav-link @if (Request::is("templatesurat/*") || Request::is("templatesurat")) active @endif">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Template Surat</p>
                                        </a>
                                    </li>
                                @endrole

                                @hasanyrole("User|Staff Desa")
                                    <li class="nav-item">
                                        <a href="{{ url("surat") }}"
                                            class="nav-link @if (Request::is("surat/*") || Request::is("surat")) active @endif">
                                            <i class="fas fa-envelope nav-icon"></i>
                                            <p>Surat</p>
                                        </a>
                                    </li>
                                @endhasanyrole

                                @role("Staff Desa")
                                    <li class="nav-item has-treeview @if (Request::is("news/*") ||
                                            Request::is("news") ||
                                            Request::is("aparatur/*") ||
                                            Request::is("aparatur") ||
                                            Request::is("villagedata/*") ||
                                            Request::is("villagedata") ||
                                            Request::is("stores")) menu-open @endif">
                                        <a href="#" class="nav-link @if (Request::is("news/*") ||
                                                Request::is("news") ||
                                                Request::is("aparatur/*") ||
                                                Request::is("aparatur") ||
                                                Request::is("villagedata/*") ||
                                                Request::is("villagedata") ||
                                                Request::is("stores")) active @endif">
                                            <i class="nav-icon fas fa-landmark"></i>
                                            <p>
                                                Profil Desa
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav-item nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route("news.index") }}"
                                                    class="nav-link @if (Request::is("news/*") || Request::is("news")) active @endif">
                                                    <i class="fas fa-newspaper nav-icon"></i>
                                                    <p>Berita</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route("aparatur.index") }}"
                                                    class="nav-link @if (Request::is("aparatur/*") || Request::is("aparatur")) active @endif">
                                                    <i class="fas fa-user-tie nav-icon"></i>
                                                    <p>Aparatur</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route("villagedata.index") }}"
                                                    class="nav-link @if (Request::is("villagedata/*") || Request::is("villagedata")) active @endif">
                                                    <i class="fas fa-database nav-icon"></i>
                                                    <p>Data Desa</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route("stores.index") }}"
                                                    class="nav-link @if (Request::is("stores/*") || Request::is("stores")) active @endif">
                                                    <i class="fas fa-store nav-icon"></i>
                                                    <p>Pasar Desa</p>
                                                </a>
                                            </li>
                                        </ul>

                                    </li>
                                    <li class="nav-item has-treeview @if (Request::is("user/*") || Request::is("user")) menu-open @endif">
                                        <a href="#"
                                            class="nav-link @if (Request::is("user/*") || Request::is("user")) active @endif">
                                            <i class="nav-icon fas fa-sliders-h"></i>
                                            <p>
                                                Settings
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav-item nav-treeview">
                                            <li class="nav-item ">
                                                <a href="{{ url("user") }}"
                                                    class="nav-link @if (Request::is("user/*") || Request::is("user")) active @endif">
                                                    <i class="fas fa-users-cog"></i>
                                                    <p>User</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endrole
                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="content-wrapper p-4">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                @yield("content")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- GANTI DI SINI -->
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="" id="modalImage" class="img-fluid" alt="Preview Gambar">
                    </div>
                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="ajax-loader"
            style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; text-align:center;">
            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2 text-dark">Memuat data...</p>
            </div>
        </div>
        <script>
            tinymce.init({
                selector: '#editor_tiny',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                // Aktifkan perilaku tab seperti Word
                tabfocus_elements: ':prev,:next',
                noneditable_noneditable_class: 'mceNonEditable',
                extended_valid_elements: 'span[class|contenteditable]',
                width: 800,
                height: 1120,
                content_style: `
                    body {
                    font-family: "Times New Roman", Times, serif !important;
                    font-size: 16px !important;
                    }
                `,
                // Optional: Force font-family dropdown to show Times New Roman first
                font_formats: 'Times New Roman=Times New Roman,Times,serif; Arial=Arial,Helvetica,sans-serif;',

                // Default font size in dropdown (optional)
                font_size_formats: '12px 14px 16px 18px',
                default_font: "Times New Roman", // Explicit default
                setup: function(editor) {
                    // Tangani tombol Tab
                    editor.on('keydown', function(e) {
                        if (e.keyCode === 9) { // 9 = kode tombol Tab
                            e.preventDefault();
                            editor.execCommand('mceInsertContent', false,
                                '&nbsp;&nbsp;&nbsp;&nbsp;'); // 4 spasi
                        }
                    });

                    editor.setContent(document.getElementById('editor_tiny').value);

                    // Sync content to hidden input on change
                    editor.on('change', function() {
                        document.getElementsByName('body_surat')[0].value = editor.getContent();
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('keyup', '.onlynumber', function() {
                    let text = $(this).val()
                    text = text.replace(/[^0-9]/, "");
                    $(this).val(text);
                });

                // $('#editor').trumbowyg({
                //     autogrow: true,
                //     tagsToRemove: ['p'],
                //     semantic: {
                //         'div': 'br',
                //         'p': 'br'
                //     }
                // });
                $(document).ajaxStart(function() {
                    $("#ajax-loader").fadeIn();
                });

                $(document).ajaxStop(function() {
                    $("#ajax-loader").fadeOut();
                });
                $(document).on('keyup', '.onlynumber', function() {
                    let text = $(this).val()
                    text = text.replace(/[^0-9]/, "");
                    $(this).val(text);
                });

                $('#letter_size').on('change', function() {
                    var selected = $(this).val();
                    var $editorContainer = $('#editorContainer');
                    console.log('masuk ganti', selected);

                    $editorContainer.removeClass('a4-size legal-size');

                    if (selected === 'a4') {
                        $editorContainer.addClass('a4-size');
                    } else if (selected === 'legal') {
                        $editorContainer.addClass('legal-size');
                    }
                });

                $(document).on('keydown', '.trumbowyg-editor', function(e) {
                    if (e.keyCode === 9) { // Tab key
                        e.preventDefault();
                        document.execCommand('insertHTML', false, '&nbsp;&nbsp;&nbsp;&nbsp;');
                    }
                });

            })
        </script>
        <script>
            function showImageModal(src) {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = src;
                const modal = new bootstrap.Modal(document.getElementById('imgModal'));
                modal.show();
            }

            function generateInputHtml(idEditor) {
                $(idEditor).trumbowyg({
                    btnsDef: {
                        removeColumnAndRowBorder: {
                            fn: function() {
                                const sel = window.getSelection();
                                if (sel.rangeCount > 0) {
                                    const range = sel.getRangeAt(0);
                                    let node = range.startContainer;

                                    // Traverse to the table
                                    while (node && node.nodeName !== 'TABLE') {
                                        node = node.parentNode;
                                    }

                                    if (node && node.nodeName === 'TABLE') {
                                        const $table = $(node);

                                        // Ask for column index (1-based) to remove border
                                        const columnIndex = parseInt(prompt(
                                            'Enter column index to remove border (1-based):')) - 1;
                                        // Ask for row index (1-based) to remove border
                                        const rowIndex = parseInt(prompt(
                                            'Enter row index to remove border (1-based):')) - 1;

                                        if (!isNaN(columnIndex) && columnIndex >= 0 && !isNaN(
                                                rowIndex) &&
                                            rowIndex >= 0) {
                                            const $ths = $table.find('th'); // Target the header cells
                                            const $rows = $table.find('tr'); // Target all rows

                                            if ($ths.length > 0) {
                                                // Remove the border for the selected column in each row
                                                $rows.each(function() {
                                                    const $td = $(this).find('td').eq(
                                                        columnIndex
                                                    ); // Get each cell in the column
                                                    if ($td.length > 0) {
                                                        $td.css('border',
                                                            'none'
                                                        ); // Remove the border for the column cell
                                                    }
                                                });

                                                // Remove the border for the selected row's td (and th if necessary)
                                                const $rowToRemoveBorder = $rows.eq(rowIndex);
                                                if ($rowToRemoveBorder.length > 0) {
                                                    $rowToRemoveBorder.find('td').each(function() {
                                                        $(this).css('border',
                                                            'none'
                                                        ); // Remove the border for each td in the row
                                                    });

                                                    // If the row is a header row (th), remove the border for the th as well
                                                    if (rowIndex ===
                                                        0
                                                    ) { // Assuming the first row contains th headers
                                                        $rowToRemoveBorder.find('th').each(function() {
                                                            $(this).css('border',
                                                                'none'); // Remove border for th
                                                        });
                                                    }
                                                }
                                            } else {
                                                alert('Invalid column or row index.');
                                            }
                                        } else {
                                            alert('Please enter valid column and row indices.');
                                        }
                                    }
                                }
                            },
                            title: 'Remove Border from Column and Row',
                            ico: 'columns'
                        }
                    },
                    autogrow: true,
                    btns: [
                        ['fontsize', 'fontfamily'], // Font size and family options
                        ['bold', 'italic', 'underline', 'strikethrough'],
                        ['link'],
                        ['insertImage'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['table', 'tableCellBackgroundColor', 'tableBorderColor'],
                        ['removeColumnAndRowBorder'], // Add custom button here
                        ['foreColor', 'backColor'],
                        ['alignLeft', 'alignCenter', 'alignRight'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['emoticons'],
                        ['fontAwesome'],
                    ],
                    plugins: {
                        fontsize: {
                            sizeList: ['8px', '10px', '12px', '14px', '16px', '18px', '20px', '24px',
                                '30px', '36px',
                                '48px'
                            ]
                        },
                        table: {
                            rows: 20,
                            columns: 20,
                            styler: "table table-bordered"
                        }
                    },
                    resetCss: false, // Disable Trumbowyg's reset CSS
                });
            }

            function checkForDuplicates() {
                const allInputs = document.querySelectorAll('.unique');
                const currentValue = this.value.trim(); // Get value and remove leading/trailing spaces

                if (!currentValue) return; // Skip empty input check

                let isDuplicate = false;
                allInputs.forEach(input => {
                    if (input !== this && input.value.trim() === currentValue) {
                        isDuplicate = true;
                    }
                });

                if (isDuplicate) {
                    alert('Duplicate value! Please enter a unique value.');
                    this.value = ''; // Clear the duplicate input
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const isActiveCheckbox = document.getElementById('is_active');
                const statusLabel = document.getElementById('statusLabel');

                // Periksa apakah elemen-elemen tersebut ada di halaman
                if (isActiveCheckbox && statusLabel) {
                    isActiveCheckbox.addEventListener('change', function() {
                        if (isActiveCheckbox.checked) {
                            statusLabel.textContent = 'Aktif';
                        } else {
                            statusLabel.textContent = 'Tidak Aktif';
                        }
                    });
                }


                document.querySelectorAll('table').forEach(table => {
                    if (table.classList.contains('show-table')) {
                        table.style.display = 'none';
                        table.classList.remove('show-table');
                    } else {
                        table.style.display = 'table';
                        table.classList.add('show-table');
                    }
                });



                document.addEventListener('input', function(e) {
                    if (e.target && e.target.classList.contains('uppercase')) {
                        e.target.value = e.target.value.toUpperCase();
                    }
                });

                document.addEventListener('blur', function(e) {
                    // Check if the blurred element has the class 'unique'
                    if (e.target && e.target.classList.contains('unique')) {
                        console.log('Input blurred');

                        const allInputs = document.querySelectorAll('.unique');
                        const currentValue = e.target.value.trim(); // Get the value of the blurred input

                        if (!currentValue) return; // Skip empty input check

                        let isDuplicate = false;

                        // Check for duplicates in all other inputs with the class 'unique'
                        allInputs.forEach(input => {
                            if (input !== e.target && input.value.trim() === currentValue) {
                                isDuplicate = true;
                            }
                        });

                        if (isDuplicate) {
                            alert('Isi Duplikat, tolong isi dengan sesuatu yang berbeda');
                            e.target.value = ''; // Clear the duplicate input
                        }
                    }
                }, true); // Use true to capture the event in the capture phase
                // Use true to capture the event in the capture phase

            });

            function showSuccess(msgText, redirectUrl = '') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: msgText,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    if (redirectUrl !== '') {
                        window.location.href = redirectUrl;
                    }
                });
            }


            function showError(msgText, redirectUrl = '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: msgText,
                    confirmButtonText: 'OK'
                }).then(() => {
                    if (redirectUrl !== '') {
                        window.location.href = redirectUrl;
                    }
                });
            }

            function showValidateionError(msgText, redirectUrl = '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi',
                    text: msgText,
                    confirmButtonText: 'OK'
                }).then(() => {
                    if (redirectUrl !== '') {
                        window.location.href = redirectUrl;
                    }
                });
            }
        </script>
        <!-- Plug in JS -->
        <!-- jQuery -->

        <!-- Bootstrap Bundle (includes Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        {{-- <script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url("adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
        <!-- ChartJS -->
        <script src="{{ url("adminlte/plugins/chart.js/Chart.min.js") }}"></script>
        <!-- Sparkline -->
        <script src="{{ url("adminlte/plugins/sparklines/sparkline.js") }}"></script>
        <!-- JQVMap -->
        <script src="{{ url("adminlte/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
        <script src="{{ url("adminlte/plugins/jqvmap/maps/jquery.vmap.world.js") }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ url("adminlte/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
        <!-- daterangepicker -->
        <!-- <script src="adminlte/plugins/moment/moment.min.js"></script> -->
        <script src="{{ url("adminlte/plugins/daterangepicker/daterangepicker.js") }}"></script>
        <!-- Summernote -->
        <script src="{{ url("adminlte/plugins/summernote/summernote-bs4.min.js") }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ url("adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ url("adminlte/dist/js/adminlte.js") }}"></script>
        <script src="{{ url("adminlte/dist/js/demo.js") }}"></script><!-- ./wrapper -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
        </script>
        <script src="{{ url("trumbowyg/dist/trumbowyg.min.js") }}"></script>

        <script src=" {{ url("trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.js") }}"></script>
        <script src=" {{ url("trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.js") }}"></script>
        <script src=" {{ url("trumbowyg/dist/plugins/colors/trumbowyg.colors.js") }}"></script>
        <script src=" {{ url("trumbowyg/dist/plugins/table/trumbowyg.table.js") }}"></script>

    </body>

</html>
