<form action="{{ route('save_profile') }}" method="post" id="sign-form">
    @if (Session::has('failed'))
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        </div>
    </div>
    @endif
    @if (Session::has('success'))
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    @csrf
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control mb-0 @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ $profile->email }}" autocomplete="off">
            @error('email')
            <div class="invalid-feedback" for="email">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="name">Username</label>
            <input type="text" name="name" class="form-control mb-0 @error('name') is-invalid @enderror"
                placeholder="Username" value="{{ $profile->name }}" autocomplete="off">
            @error('name')
            <div class="invalid-feedback" for="name">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control mb-0 @error('nama') is-invalid @enderror"
                placeholder="Nama Lengkap" value="{{ $profile->member->name }}" autocomplete="off">
            @error('nama')
            <div class="invalid-feedback" for="nama">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="phone">Nomor Handphone</label>
            <input type="text" name="phone" class="form-control mb-0 @error('phone') is-invalid @enderror"
                placeholder="Nomor Handphone" value="{{ $profile->member->phone }}" autocomplete="off">
            @error('phone')
            <div class="invalid-feedback" for="phone">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="address">Alamat</label>
            <textarea class="form-control mb-0 @error('address') is-invalid @enderror" name="address" id="address"
                rows="3" placeholder="Alamat Lengkap">{{ $profile->member->address }}</textarea>
            @error('address')
            <div class="invalid-feedback" for="address">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            @error('latitude')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="hidden" name="latitude" id="latitude" value="{{ $profile->member->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $profile->member->longitude }}">
            <div class="map" id="map"></div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="password">Password Baru</label>
            <input type="password" name="password" class="form-control mb-0 @error('password') is-invalid @enderror"
                placeholder="Password Baru">
            @error('password')
            <div class="invalid-feedback" for="password">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="row justify-content-center">
        <div class="form-group  col-lg-10">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation"
                class="form-control mb-0 @error('password_confirmation') is-invalid @enderror"
                placeholder="Konfirmasi Password">
            @error('password_confirmation')
            <div class="invalid-feedback" for="password_confirmation">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="row justify-content-center">
        <button type="submit" class="site-btn">PERBARUI</button>
    </div>
    <div class="row mt-3 justify-content-center">
        <span><a href="{{ route('logout') }}">Logout</a></span>
    </div>
</form>