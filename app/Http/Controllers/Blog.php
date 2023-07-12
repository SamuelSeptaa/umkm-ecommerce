<?php

namespace App\Http\Controllers;

use App\Models\blog as ModelsBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class Blog extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = "Daftar Blog";
        $this->data['script']       = "admin.script.blog";
        return view('admin.blog', $this->data);
    }

    public function add()
    {
        $this->data['title']        = "Tambah Blog";

        $this->data['forms']        = [
            array('image_url', 'image', 'Gambar Blog'),
            array('title', 'text', 'Judul Blog'),
            array('info', 'textarea', 'Informasi Singkat Blog'),
            array('description', 'description', 'Konten Blog'),
        ];

        $this->data['action']       = route('store-blog');
        $this->data['back']         = route('blogs');
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
            'image_url' => ['required', 'max:2048'],
            'title' => ['required', 'unique:blogs,title', 'max:255', 'min:10'],
            'info' => ['required', 'min:10', 'max:100'],
            'description' => ['required'],
        ]);

        $file       = $request->file('image_url');
        $filename   = createSlug($request->title);
        $ext        = $file->getClientOriginalExtension();
        $path       = Storage::disk('public')->putFileAs(
            'img/blog',
            $file,
            $filename . ".$ext"
        );

        ModelsBlog::create([
            'title'     => $request->title,
            'slug'      => createSlug($request->title),
            'image_url' => $path,
            'info'      => $request->info,
            'description'   => $request->description
        ]);

        return redirect()->route('add-blog')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $query      = ModelsBlog::query();
        return DataTables::of($query)
            ->editColumn('image_url', function ($query) {
                return '
                <div class="table-image">
                    <img src="' . asset("storage/$query->image_url") . '" alt="' . $query->slug . '">
                </div>
            ';
            })
            ->addColumn('action', function ($query) {
                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <a href="' . route('detail-blog', ['id' => $query->id]) . '" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button onclick="deleteBlog(' . $query->id . ')" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                </div>
                ';
            })
            ->filter(function ($query) use ($request) {
                $this->YajraColumnSearch(
                    $query,
                    ['title'],
                    $request->search
                );
            })
            ->rawColumns(['image_url', 'action'])
            ->removeColumn(['id'])
            ->toJson();
    }

    public function detail($id)
    {
        $blog                   = ModelsBlog::findOrFail($id);
        $this->data['title']    = "Detail $blog->title";
        $this->data['detail']     = $blog;
        $this->data['forms']    = [
            array('image_url', 'image', 'Gambar Blog'),
            array('title', 'text', 'Judul Blog'),
            array('info', 'textarea', 'Informasi Singkat Blog'),
            array('description', 'description', 'Konten Blog'),
        ];

        $this->data['action']   = route('update-blog');
        $this->data['back']     = route('blogs');

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
            'image_url' => ['nullable', 'max:2048'],
            'title'     => ['required', Rule::unique('blogs', 'title')->ignore($request->id), 'max:255', 'min:10'],
            'info'      => ['required', 'min:10', 'max:100'],
            'description' => ['required'],
        ]);

        $blog                   = ModelsBlog::findOrFail($request->id);
        $file                   = $request->file('image_url');
        if ($file) {
            if (Storage::disk('public')->exists($blog->image_url))
                Storage::disk('public')->delete($blog->image_url);

            $filename   = createSlug($request->title);
            $ext        = $file->getClientOriginalExtension();
            $path       = Storage::disk('public')->putFileAs(
                'img/blog',
                $file,
                $filename . ".$ext"
            );
        }

        ModelsBlog::where('id', $request->id)
            ->update([
                'title'     => $request->title,
                'slug'      => createSlug($request->title),
                'image_url' => ($file) ? $path : $blog->image_url,
                'info'      => $request->info,
                'description'   => $request->description
            ]);

        return redirect()->route('detail-blog', ['id' => $request->id])->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id             = $request->id;
        ModelsBlog::findOrFail($id);
        ModelsBlog::where('id', $id)->delete();
        return response()->json(
            [
                'status'       => 'Success',
                'message'       => "Berhasil Menghapus Blog"
            ]
        );
    }
}
