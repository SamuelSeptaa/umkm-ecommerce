<?php

namespace App\Http\Controllers;

use App\Models\category as ModelsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = "Daftar Kategori Produk";
        $this->data['script']       = "admin.script.category";
        return view('admin.category', $this->data);
    }

    public function add()
    {
        $this->data['title']        = "Tambah Kategori Produk";

        $forms = [
            array('category', 'text', 'Nama Kategori'),
            array('thumbnail', 'image', 'Gambar (Thumbnail) Kategori'),
        ];
        $this->data['forms']         = $forms;
        $this->data['action']       = route('store-category');
        $this->data['back']         = route('category-list');

        return view('layout.admin.add', $this->data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'      => ['required', 'unique:categories,category', 'max:20', 'min:5', 'regex:/^[a-zA-Z\s0-9]+$/'],
            'thumbnail'     => ['required', 'max:1024'],
        ]);

        $file       = $request->file('thumbnail');
        $filename   = createSlug($request->category);
        $ext        = $file->getClientOriginalExtension();
        $path       = Storage::disk('public')->putFileAs(
            'img/categories',
            $file,
            $filename . ".$ext"
        );

        ModelsCategory::create([
            'category'      => $request->category,
            'slug'          => createSlug($request->category),
            'thumbnail'     => $path
        ]);
        return redirect()->route('add-category')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $query          = ModelsCategory::query();
        return DataTables::eloquent($query)
            ->addColumn('action', function ($query) {
                return '
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <a href="' . route('detail-category', ['id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
            ';
            })
            ->editColumn('thumbnail', function ($query) {
                return '
                    <div class="table-image">
                        <img src="' . asset("storage/$query->thumbnail") . '" alt="' . $query->category . '">
                    </div>';
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['category'],
                    $request->search
                );
            })
            ->rawColumns(['action', 'thumbnail'])
            ->removeColumn(['id'])
            ->make();
    }

    public function detail($id)
    {
        $this->data['detail']       = ModelsCategory::findOrFail($id);
        $this->data['title']        =  "Detail " . $this->data['detail']->category;

        $this->data['forms']        = [
            array('category', 'text', 'Nama Kategori'),
            array('thumbnail', 'image', 'Gambar (Thumbnail) Kategori'),
        ];

        $this->data['action']       = route('update-category');
        $this->data['back']         = route('category-list');
        return view('layout.admin.detail', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'category'      => ['required', Rule::unique('blogs', 'title')->ignore($request->id), 'max:20', 'min:5', 'regex:/^[a-zA-Z\s0-9]+$/'],
            'thumbnail'     => ['nullable', 'max:1024'],
        ]);
        $category       = ModelsCategory::findOrFail($request->id);
        $file           = $request->file('thumbnail');
        if ($file) {
            if (Storage::disk('public')->exists($category->thumbnail))
                Storage::delete($category->thumbnail);

            $filename   = createSlug($request->category);
            $ext        = $file->getClientOriginalExtension();
            $path       = Storage::disk('public')->putFileAs(
                'img/categories',
                $file,
                $filename . ".$ext"
            );
        }

        ModelsCategory::where('id', $request->id)
            ->update([
                'category'      => $request->category,
                'slug'          => createSlug($request->category),
                'thumbnail'     => ($file) ? $path : $category->thumbnail
            ]);
        return redirect()->route('detail-category', ['id' => $request->id])->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
