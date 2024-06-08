<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RootAdminMiddleware;
use App\Helpers\ImagePostHelper;
use App\Helpers\TextHelper;
use App\Helpers\Settings;
use App\Models\Category;
use App\Models\Post;
use File;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(RootAdminMiddleware::class)->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('title', 'asc')->paginate(Settings::getValue("admin_items_per_page"));
        return view('pages/admin/posts/manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if (count($categories) == 0) {
            return redirect()->route('categories.create')->with('status', 'Create at least one category!'); 
        }

        return view('pages/admin/posts/update', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->validated()) {

            $post = $request->all();
            $category = Category::find($post['category_id']);

            if ($request->hasFile('image')) {

                $requestImage = $request->file('image');
                $newImageName = ImagePostHelper::buildImageName($post['title'], $requestImage->getClientOriginalExtension());
                ImagePostHelper::storeImage($requestImage, TextHelper::transliterate($category->title), $newImageName);                 

                $post['image'] = $newImageName;

            } else {
                return redirect()->back()->with('status', 'Select image!'); 
            }

            Post::create($post);
            
            return redirect()->route('posts.index')->with('info', 'Post has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('pages/admin/posts/update', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {

            $category = Category::find($post->category_id);
            $categoryDirName = TextHelper::transliterate($category->title);

            if($post->image) {
                ImagePostHelper::removeImagesFromStorage($categoryDirName, $post->image);
            }

            $requestImage = $request->file('image');
            $newImageName = ImagePostHelper::buildImageName($post->title, $requestImage->getClientOriginalExtension());
            ImagePostHelper::storeImage($requestImage, TextHelper::transliterate($category->title), $newImageName);  

            $post->image = $newImageName;
        }

        if (empty($post->image)) {
            return redirect()->back()->with('status', 'Select image!'); 
        }

        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->update();

        return redirect()->route('posts.edit', compact('post'))->with('info', 'Post has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) {
            ImagePostHelper::removeImagesFromStorage(TextHelper::transliterate($post->category->title), $post->image);
        }
        $post->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
