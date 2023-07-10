<div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i>
                Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.profileSecurity') }}"><i class="ti-xs ti ti-lock me-1"></i>
                Security</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages-account-settings-billing.html"><i
                    class="ti-xs ti ti-file-description me-1"></i> Billing & Plans</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages-account-settings-notifications.html"><i class="ti-xs ti ti-bell me-1"></i>
                Notifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages-account-settings-connections.html"><i class="ti-xs ti ti-link me-1"></i>
                Connections</a>
        </li>
    </ul>
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="<?= (!Auth::user()->images == null) ?  "placeholder.png" :  "https://ui-avatars.com/api/?name=".Auth::user()->name?>" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                    id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="name" wire:model="name" autofocus />
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input class="form-control" type="text" wire:model="last_name" id="last_name" />
                        @error('last_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" wire:model="email" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Organization</label>
                        <input type="text" class="form-control" placeholder="{{ auth()->user()->organization }}"
                            id="organization" wire:model="organization" />
                        @error('organization')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_number">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">ID (+62)</span>
                            <input type="text" id="phone_number" wire:model="phone_number" class="form-control" />
                        </div>
                        @error('phone_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" wire:model="address" />
                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" type="text" id="state" wire:model="state" />
                        @error('state')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" wire:model="zip_code"
                            maxlength="6" />
                        @error('zip_code')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="country">Country</label>
                        <select id="country" wire:model="country" class="select2 form-select">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="language" class="form-label">Language</label>
                        <select id="language" wire:model="language" class="select2 form-select">
                            <option value="">Select Language</option>
                            <option value="en">English</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="pt">Portuguese</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="timeZones" class="form-label">Timezone</label>
                        <select id="timeZones" wire:model="timezone"class="select2 form-select">
                            <option value="">Select Timezone</option>
                            <option value="-12">(GMT-12:00) International Date Line West</option>
                            <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                            <option value="-10">(GMT-10:00) Hawaii</option>
                            <option value="-9">(GMT-09:00) Alaska</option>
                            <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                            <option value="-7">(GMT-07:00) Arizona</option>
                            <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option value="-6">(GMT-06:00) Central America</option>
                            <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                            <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option value="-6">(GMT-06:00) Saskatchewan</option>
                            <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option value="-5">(GMT-05:00) Indiana (East)</option>
                            <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="currency" class="form-label">Currency</label>
                        <select id="currency" wire:model="currency" class="select2 form-select">
                            <option value="">Select Currency</option>
                            <option value="usd">USD</option>
                            <option value="euro">Euro</option>
                            <option value="pound">Pound</option>
                            <option value="bitcoin">Bitcoin</option>
                        </select>
                    </div>
                </div>

                @push('scripts')
                    <script>
                        $(document).ready(function() {
                            $('#currency').select2();
                            $('#currency').on('change', function(e) {
                                var data = $('#currency').select2("val");
                                @this.set('currency', data);
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#language').select2();
                            $('#language').on('change', function(e) {
                                var data = $('#language').select2("val");
                                @this.set('language', data);
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#timezone').select2();
                            $('#timezone').on('change', function(e) {
                                var data = $('#timezone').select2("val");
                                @this.set('timezone', data);
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#country').select2();
                            $('#country').on('change', function(e) {
                                var data = $('#country').select2("val");
                                @this.set('country', data);
                            });
                        });
                    </script>
                @endpush


                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="mt-2">
                    <button type="submit" wire:click.prevent="updateAccount()" class="btn btn-primary me-2">Save
                        changes</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                    </p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false" method="POST">
                <div class="mb-3 col-md-6">
                    <input class="form-control" type="password" name="deletepassword" id="deletepassword"
                        required />
                    <label class="form-check-label" for="deletepassword">I confirm my account
                        deactivation</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="accountActivation"
                        id="accountActivation" required/>
                    <label class="form-check-label" for="accountActivation">I confirm my account
                        deactivation</label>
                </div>
                <button type="submit" id="btn-add" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    //button create post event
    $('body').on('click', '#btn-create-post', function() {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let title = $('#title').val();
        let content = $('#content').val();
        let token = $("meta[name='csrf-token']").attr("content");

        //ajax
        $.ajax({

            url: `/posts`,
            type: "POST",
            cache: false,
            data: {
                "title": title,
                "content": content,
                "_token": token
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data post
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.title}</td>
                        <td>${response.data.content}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                //append to table
                $('#table-posts').prepend(post);

                //clear form
                $('#title').val('');
                $('#content').val('');

                //close modal
                $('#modal-create').modal('hide');


            },
            error: function(error) {

                if (error.responseJSON.title[0]) {

                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    //add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }

                if (error.responseJSON.content[0]) {

                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');

                    //add message to alert
                    $('#alert-content').html(error.responseJSON.content[0]);
                }

            }

        });

    });
</script> --}}
