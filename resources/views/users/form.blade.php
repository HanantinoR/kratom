<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
            $id = $id ?? null;
        ?>
        @if(isset($id))
        {!! Form::model($data, ['route' => ['users.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data']) !!}
        @else
        {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{$id !== null ? 'Update' : 'Add' }} User</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <div class="profile-img-edit position-relative">
                                <img src="{{ $profileImage ?? asset('images/avatars/01.png')}}" alt="User-Profile" class="profile-pic rounded avatar-100">
                                <div class="upload-icone bg-primary">
                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                    </svg>
                                    <input class="file-upload" type="file" accept="image/*" name="profile_image">
                                </div>
                                </div>
                                <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                    <span>allowed</span>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status:</label>
                                <div class="grid" style="--bs-gap: 1rem">
                                    <div class="form-check g-col-6">
                                        {{ Form::radio('status', 1 ,old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']); }}
                                        <label class="form-check-label" for="status-active">
                                            Aktif
                                        </label>
                                    </div>
                                    {{-- <div class="form-check g-col-6">
                                        {{ Form::radio('status', 'pending',old('status'), ['class' => 'form-check-input', 'id' => 'status-pending']); }}
                                        <label class="form-check-label" for="status-pending">
                                            Pending
                                        </label>
                                    </div>
                                    <div class="form-check g-col-6">
                                        {{ Form::radio('status', 'banned',old('status'), ['class' => 'form-check-input', 'id' => 'status-banned']); }}
                                        <label class="form-check-label" for="status-banned">
                                            Banned
                                        </label>
                                    </div> --}}
                                    <div class="form-check g-col-6">
                                        {{ Form::radio('status', 0 ,old('status'), ['class' => 'form-check-input', 'id' => 'status-inactive']); }}
                                        <label class="form-check-label" for="status-inactive">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($auth_user->user_type === 'admin')
                                @php
                                    $role = $roles;
                                @endphp
                            @else
                                @php
                                    $role = $roles->slice(1);
                                @endphp
                            @endif
                            {{-- {{dd($data->user_type)}} --}}
                            <div class="form-group">
                                <label class="form-label">Role: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('user_type', old('user_type'), ['class' => 'form-control', 'id' => 'instaurl', 'placeholder' => 'Instagram Url']) }} --}}
                                @if (isset($id))
                                    <select name="user_type" id="user_type" class="form-control select2">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $key => $value)
                                            <option value="{{$value->name}}" {{$data->user_type == $value->name ? 'selected' :''}}>
                                                {{$value->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="user_type" id="user_type" class="form-control select2">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $key => $value)
                                            <option value="{{$value->name}}" {{old('user_type') == $value->name ? 'selected' :''}}>
                                                {{$value->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Penandatangan: <span class="text-danger">*</span></label>
                                {{Form::select('user_sign', [1=>"Iya",2=>"No"] , old('user_sign') ? old('user_sign') : $data->user_sign ?? 'user', ['class' => 'form-control select2', 'placeholder' => 'Select'])}}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kantor Cabang: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('branch_office', old('branch_office'), ['class' => 'form-control', 'id' => 'instaurl', 'placeholder' => 'Instagram Url']) }} --}}
                                @if (isset($id))
                                    <select name="branch_office" class="form-control select2" id="branch_office" placeholder="Kantor Cabang" style="width: 100%;">
                                        <option value="">Pilih Kantor Cabang</option>
                                        @foreach($office_branch as $key => $office)
                                            <option value="{{ $office->id }}" {{ $data->branch_office == $office->id ? 'selected' : '' }}>
                                                {{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                <select name="branch_office" class="form-control select2" id="branch_office" placeholder="Kantor Cabang" style="width: 100%;">
                                    <option value="">Pilih Kantor Cabang</option>
                                    @foreach($office_branch as $key => $office)
                                        <option value="{{ $office->id }}" {{ old('branch_office') == $office->id ? 'selected' : '' }}>
                                            {{ $office->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">NPP:</label>
                                {{ Form::text('npp', old('npp'), ['class' => 'form-control', 'id' => 'npp', 'placeholder' => 'NPP']) }}
                            </div>
                            {{-- <div class="form-group">
                            <label class="form-label" for="furl">Facebook Url:</label>
                            {{ Form::text('userProfile[facebook_url]', old('userProfile[facebook_url]'), ['class' => 'form-control', 'id' => 'furl', 'placeholder' => 'Facebook Url']) }}
                            </div>
                            <div class="form-group">
                            <label class="form-label" for="turl">Twitter Url:</label>
                            {{ Form::text('userProfile[twitter_url]', old('userProfile[twitter_url]'), ['class' => 'form-control', 'id' => 'turl', 'placeholder' => 'Twitter Url']) }}
                            </div>
                            <div class="form-group">
                            <label class="form-label" for="instaurl">Instagram Url:</label>
                            {{ Form::text('userProfile[instagram_url]', old('userProfile[instagram_url]'), ['class' => 'form-control', 'id' => 'instaurl', 'placeholder' => 'Instagram Url']) }}
                            </div>
                            <div class="form-group mb-0">
                            <label class="form-label" for="lurl">Linkedin Url:</label>
                            {{ Form::text('userProfile[linkdin_url]', old('userProfile[linkdin_url]'), ['class' => 'form-control', 'id' => 'lurl', 'placeholder' => 'Linkedin Url']) }}
                            </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{$id !== null ? 'Update' : 'New' }} User Information</h4>
                        </div>
                        <div class="card-action">
                                <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fname">Nama Depan: <span class="text-danger">*</span></label>
                                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lname">Nama Belakang: <span class="text-danger">*</span></label>
                                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name' ,'required']) }}
                                </div>
                                {{-- <div class="form-group col-md-12">
                                    <label class="form-label" for="cname">Company Name: <span class="text-danger">*</span></label>
                                    {{ Form::text('userProfile[company_name]', old('userProfile[company_name]'), ['class' => 'form-control', 'required', 'placeholder' => 'Company Name']) }}
                                </div> --}}
                                {{-- {{ Form::select('company[name]', $data_company , old('company[name]') ? old('company[name]') : $data ?? 'user', ['class' => 'form-control company_id', 'placeholder' => 'Select Company Name']) }} --}}
                                @if (isset($id))
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                        <select name="company_id" class="form-control select2" id="company_id" placeholder="Select Company Name">
                                            <option value="">Select Company Name</option>
                                            @foreach($data_company as $key => $company)
                                                <option value="{{ $company->id }}" {{ $data->company_id === $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                        <select name="company_id" class="form-control select2" id="company_id" placeholder="Select Company Name">
                                            <option value="">Select Company Name</option>
                                            @foreach($data_company as $key => $company)
                                                <option value="{{ $company->id }}" {{ old('company_id') === $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                {{-- <div class="form-group col-sm-12">
                                    <label class="form-label" id="country">Country:</label>
                                    {{ Form::text('userProfile[country]', old('userProfile[country]'), ['class' => 'form-control', 'id' => 'country']) }}
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="mobno">Nomor Telephone:</label>
                                    {{ Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'id' => 'mobno', 'placeholder' => 'Mobile Number', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="altconno">Nomor Hp:</label>
                                    {{ Form::text('alt_phone_number', old('alt_phone_number'), ['class' => 'form-control', 'id' => 'altconno', 'placeholder' => 'Alternate Contact']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email: <span class="text-danger">*</span></label>
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter e-mail', 'required']) }}
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label class="form-label" for="pno">Pin Code:</label>
                                    {{ Form::number('userProfile[pin_code]', old('userProfile[pin_code]'), ['class' => 'form-control', 'id' => 'pin_code','step' => 'any']) }}
                                </div> --}}
                            </div>
                            <hr>
                            <h5 class="mb-3">Security</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="uname">User Name: <span class="text-danger">*</span></label>
                                    {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter Username']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pass">Password:</label>
                                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="rpass">Repeat Password:</label>
                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{$id !== null ? 'Save' : 'Tambah' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
