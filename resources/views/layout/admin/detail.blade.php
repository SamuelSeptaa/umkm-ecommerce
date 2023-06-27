@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><strong>{{ $title }}</strong></div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ $action }}" id="form-manipulation" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="float-right d-flex">
                            <a href="{{ $back }}" class="btn btn-secondary mr-3">Kembali</a>
                            <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $detail->id }}">
                @foreach ($forms as $form)
                    @php
                        $rowname = $form[0];
                        $rowtype = $form[1];
                        $label = $form[2];
                    @endphp
                    @if ($rowtype == 'text')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control @error($rowname) is-invalid @enderror" id="{{ $rowname }}"
                                    name="{{ $rowname }}" value="{{ $detail->$rowname }}" type="text">
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif ($rowtype == 'number')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control only-number @error($rowname) is-invalid @enderror"
                                    id="{{ $rowname }}" name="{{ $rowname }}" value="{{ $detail->$rowname }}"
                                    type="text">
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    @elseif ($rowtype == 'password')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control @error($rowname) is-invalid @enderror" id="{{ $rowname }}"
                                    name="{{ $rowname }}" value="" type="password">
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    @elseif ($rowtype == 'select')
                        @php
                            $value = $form[3];
                        @endphp
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <select class="form-select select2 @error($rowname) is-invalid @enderror"
                                    id="{{ $rowname }}" name="{{ $rowname }}" aria-label="Pilih">
                                    <option selected="" disabled>Pilih</option>
                                    @foreach ($value as $v)
                                        <option {{ $v->id == $detail->$rowname ? 'selected' : '' }}
                                            value="{{ $v->id }}">
                                            {{ $v->text }}
                                        </option>
                                    @endforeach
                                </select>
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif ($rowtype == 'image')
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <div class="img-preview">
                                    <img src="{{ asset('storage/' . $detail->$rowname) }}" alt="">
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control image-input @error($rowname) is-invalid @enderror" type="file"
                                    id="{{ $rowname }}" name="{{ $rowname }}" accept="image/*"
                                    value="aaaaaaaaaaaaa">
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif ($rowtype == 'description')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control tinymce @error($rowname) is-invalid @enderror" id="{{ $rowname }}"
                                    name="{{ $rowname }}">{{ $detail->$rowname }}</textarea>
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endforeach
            </form>
        </div>
    </div>
@endsection
