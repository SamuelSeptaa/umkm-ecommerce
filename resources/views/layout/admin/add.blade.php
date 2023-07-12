@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <form action="{{ $action }}" id="form-manipulation" method="POST" enctype="multipart/form-data">
            <div class="card-header d-flex align-items-center"><strong>{{ $title }}</strong></strong>
                <a class="btn btn-sm btn-secondary ms-auto me-1" href="{{ $back }}"><i
                        class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
                <button type="submit" class="btn btn-sm btn-info me-1 d-print-none">
                    <i class="fa-solid fa-floppy-disk"></i> Save
                </button>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
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
                                    name="{{ $rowname }}" value="{{ old($rowname) }}" type="text">
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
                                    id="{{ $rowname }}" name="{{ $rowname }}" value="{{ old($rowname) }}"
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
                                        <option {{ $v->id == old($rowname) ? 'selected' : '' }}
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
                                <div class="img-preview"></div>
                            </div>
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control image-input @error($rowname) is-invalid @enderror" type="file"
                                    id="{{ $rowname }}" name="{{ $rowname }}" accept="image/*">
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
                                    name="{{ $rowname }}">{{ old($rowname) }}</textarea>
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif ($rowtype == 'daterange')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input class="form-control daterange @error($rowname) is-invalid @enderror"
                                    id="{{ $rowname }}" name="{{ $rowname }}" value="{{ old($rowname) }}"
                                    type="text" autocomplete="off">
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    @elseif ($rowtype == 'textarea')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="{{ $rowname }}">{{ $label }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error($rowname) is-invalid @enderror" id="{{ $rowname }}"
                                    name="{{ $rowname }}" rows="2" autocomplete="off">{{ old($rowname) }}</textarea>
                                @error($rowname)
                                    <div class="invalid-feedback" for="{{ $rowname }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </form>
    </div>
@endsection
