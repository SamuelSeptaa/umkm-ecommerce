@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center"><strong>{{ $title }}</strong></strong>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="col-6">
                    <form action="{{ route('download-pajak-tahunan') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3 col-form-label" for="year-picker">Tahun</label>
                            <div class="col-9">
                                <input class="form-control  @error('tahun') is-invalid @enderror" id="year-picker"
                                    name="tahun" type="text" autocomplete="off" value="{{ old('tahun') }}">
                                @error('tahun')
                                    <div class="invalid-feedback" for="year-picker">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label" for="shop">Toko</label>
                            <div class="col-9">
                                <select class="form-select select2 @error('toko') is-invalid @enderror" id="toko"
                                    name="toko" aria-label="Pilih">
                                    <option selected="" disabled>Pilih Toko</option>
                                    @foreach ($shops as $s)
                                        <option {{ $s->id == old('toko') ? 'selected' : '' }} value="{{ $s->id }}">
                                            {{ $s->shop_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('toko')
                                    <div class="invalid-feedback" for="toko">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="float-right">
                                <button class="btn btn-outline-success">Download</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
