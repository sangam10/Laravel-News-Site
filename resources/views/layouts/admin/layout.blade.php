<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">

    {{-- sweetalertjs --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    @vite(['resources/vendor/bootstrap/css/bootstrap.min.css', 'resources/vendor/bootstrap-icons/bootstrap-icons.css', 'resources/vendor/boxicons/css/boxicons.min.css', 'resources/css/style.css'])

    {{-- custom css --}}
    @stack('styles')

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    @include('admin.components.header')

    @include('admin.components.sidebar')
    @yield('content')
    @include('admin.components.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Include library start -->
    @vite(['resources/vendor/bootstrap/js/bootstrap.bundle.min.js', 'resources/js/admin_main.js'])
    <!-- Include library end-->
    <script>
        $(document).ready(function() {
            @if (session()->has('success'))
                Swal.fire(
                    'Success',
                    "{{ session()->get('success') }}",
                    'success'
                )
            @endif
            @if (session()->has('error'))
                Swal.fire(
                    'Oops!!',
                    "{{ session()->get('error') }}",
                    'error'
                )
            @endif
            //quill
            var container = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['image'],
                ['video'],
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl',
                }], // text direction
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

                ['clean'] // remove formatting button
            ];
            var options = {
                theme: 'snow',
                bounds: '#quill_editor',
                modules: {
                    toolbar: {
                        container: container,
                        // handlers: {
                        //     image: imageHandler
                        // }
                    }
                },
            }
            var quill = new Quill('#quill_editor', options);

            $('#create_news, #edit_news').on('submit', function(event) {
                // event.preventDefault()
                $('#description').val($('#quill_editor > .ql-editor').html())
            })

            function imageHandler() {
                var range = this.quill.getSelection();
                var value = prompt('please copy paste the image url here.');
                if (value) {
                    this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
                }
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
