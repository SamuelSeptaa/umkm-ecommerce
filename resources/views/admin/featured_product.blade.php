@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><strong>{{ $title }}</strong></div>
        <div class="card-body">
            <div class="example">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mb-3">
                    <form action="{{ route('update-featured-product') }}" method="post" id="form-manipulation">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <label class="col-4 col-form-label" for="featured">Produk Teratas Pilihan</label>
                                <div class="col-8">
                                    <select class="form-select @error('featured') is-invalid @enderror" id="featured"
                                        name="featured[]" multiple="multiple" aria-label="Pilih">
                                        <option value="" disabled>Pilih</option>
                                        @foreach ($products as $p)
                                            <option value="{{ $p->id }}"
                                                {{ in_array($p->id, $ids_featured) ? 'selected' : '' }}>
                                                {{ $p->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('featured')
                                        <div class="invalid-feedback" for="featured">{{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel">
                        <table class="table table-striped" id="the-table" style="width:50%">
                            <thead>
                                <tr>
                                    <th>Gambar Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($featured_products as $f)
                                    <tr>
                                        <td>
                                            <div class="table-image">
                                                <img src="{{ asset('storage/' . $f->product->image_url) }}"
                                                    alt="{{ $f->product->product_name }}">
                                            </div>
                                        </td>
                                        <td>{{ $f->product->product_name }}</td>
                                        <td>{{ currencyIDR($f->product->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
