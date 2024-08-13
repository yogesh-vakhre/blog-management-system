<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Post::select('*');
        if ($request->ajax()) {

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $filePath ='';
        // Check if the file is valid
        if ($request->file('image')->isValid()) {
            // Store the file in the 'uploads' directory on the 'public' disk
            $filePath = $request->file('image')->store('uploads', 'public');
        }
        $post=Post::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'image'=> $filePath,
            'user_id'=> auth()->user()->id,
        ]);
        if (!empty($post)){
            // Return success response
            return redirect()->route('posts.index')->with('success', 'Post is created successfully');
        }else{
            // Return error response
            return redirect()->route('posts.index')->with('error', 'Post is not created successfully');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
       $filePath ='';
       $data = [
            'title'=> $request->title,
            'content'=> $request->content
       ];
        // Check if the file is valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Store the file in the 'uploads' directory on the 'public' disk
            $filePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $filePath;
        }else{
            $data['image'] = $post->image;
        }
        $post=Post::where('id',$post->id)->update($data);
        if (!empty($post)){
            // Return success response
            return redirect()->route('posts.index')->with('success', 'Post is updated successfully');
        }else{
            // Return error response
            return redirect()->route('posts.index')->with('error', 'Post is not updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $postData=$post::where('id',$post->id)->delete();
        if (!empty($postData)){
            // Return success response
            return redirect()->route('posts.index')->with('success', 'Post is soft deleted successfully');
        }else{
            // Return error response
            return redirect()->route('posts.index')->with('error', 'Post is not soft deleted successfully');
        }
    }
}
