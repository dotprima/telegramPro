@extends('layouts.app')


@section('content')
    <br>



    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Tampilkan pesan berhasil -->
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <span class="alert-icon text-success me-2">
                    <i class="ti ti-check ti-xs"></i>
                </span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tampilkan pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="alert-icon text-danger me-2">
                    <i class="ti ti-ban ti-xs"></i>
                </span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Add language
            <!-- Button -->
            <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal"
                data-bs-target="#addNewAddress">Tambah Data</button>

        </h4>


        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Table Basic</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%" style="padding-left: 30px">#</th>
                            <th width="10%">Code</th>
                            <th width="20%">Name</th>
                            <th width="70%" class="text-end" style="padding-right: 30px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($languages as $language)
                            <tr>
                                <td width="5%" style="padding-left: 30px">{{ $i }}</td>
                                <td>{{ $language->code }}</td>
                                <td>{{ $language->name }}</td>
                                <td width="70%" class="text-end" style="padding-right: 50px">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#UpdateLanguage{{ $language->id }}"><i
                                                    class="ti ti-pencil me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="hapus({{ $language->id }})"><i class="ti ti-trash me-2"></i>
                                                Delete</a>

                                        </div>
                                    </div>
                                </td>
                                @php
                                    $i++;
                                @endphp
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

        <hr class="my-5">

        <!-- Add New Address Modal -->
        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="address-title mb-2">Add New Language</h3>
                        </div>
                        <form id="addNewAddressForm" method="post" class="row g-3" action="{{ route('languages.store') }}">
                            <!-- Form fields for adding a new language -->
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="languageCode">Code</label>
                                <input type="text" id="languageCode" name="code" class="form-control"
                                    placeholder="Code">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="languageName">Name</label>
                                <input type="text" id="languageName" name="name" class="form-control"
                                    placeholder="Name">
                            </div>

                            <!-- Submit and cancel buttons -->
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Address Modal -->

        @foreach ($languages as $language)
            <!-- Add New Address Modal -->
            <div class="modal fade" id="UpdateLanguage{{ $language->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="address-title mb-2">UpdateLanguage</h3>
                            </div>
                            <form method="POST" action="{{ route('languages.update', $language->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Form fields for adding a new language -->
                                @csrf
                                <div class="col-12">
                                    <label class="form-label" for="languageCode">Code</label>
                                    <input type="text" id="languageCode" name="code" class="form-control"
                                        placeholder="Code" value="{{ $language->code }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="languageName">Name</label>
                                    <input type="text" id="languageName" name="name"
                                        value="{{ $language->name }}" class="form-control" placeholder="Name" required>
                                </div>

                                <!-- Submit and cancel buttons -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Add New Address Modal -->
        @endforeach

    </div>
@endsection

@section('js')
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../../assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>
    <script src="../../assets/js/extended-ui-sweetalert2.js"></script>

    <script>
        // Tampilkan SweetAlert saat tombol hapus diklik
        function hapus(id) {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn btn-primary me-3",
                    cancelButton: "btn btn-label-secondary"
                },
                buttonsStyling: !1
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the jenjang
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/languages/' + id);
                    form.innerHTML = '@csrf @method('DELETE')';

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection

@section('css')
    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
@endsection
