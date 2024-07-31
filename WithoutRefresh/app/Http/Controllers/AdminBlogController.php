<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('add-blog');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:png,jpg|max:1024',
            'content' => 'required'
        ]);

        $imagename = "Blogs_upload_" . time() . "." . $request->image->extension();
        $folderPath = 'uploads/blog-images';
        $imagePath = $folderPath . '/' . $imagename;
        $request->image->move(public_path($folderPath), $imagename);
        // dd($imagePath);

        $data = BlogModel::create([
            'title' => $request->title,
            'image' => $imagePath,
            'content' => $request->content
        ]);
        if ($data) {
            return back()->with('success', 'Upload Successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogModel $blogModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogModel $blogModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogModel $blogModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogModel $blogModel)
    {
        //
    }
}
