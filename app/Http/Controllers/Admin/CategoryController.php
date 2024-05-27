<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Middleware\RootAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TextHelper;
use App\Helpers\Settings;
use App\Helpers\ImageCategoryHelper;
use App\Models\Category;
use File;
use Image;

class CategoryController extends Controller
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
        $categories = Category::orderBy('created_at', 'desc')->paginate(Settings::getValue("admin_items_per_page"));
        return view('pages/admin/categories/manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages/admin/categories/update');
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

            $category = $request->all();

            if ($request->hasFile('image')) {
                
                $requestImage = $request->file('image');
                $newImageName = TextHelper::buildAlbumImageName($category['title'], $requestImage->getClientOriginalExtension());
                ImageCategoryHelper::storeImage($requestImage, $category['title'], $newImageName);  

                $category['image'] = $newImageName;
            } else {
                return redirect()->back()->with('status', 'Select image!'); 
            }

            Category::create($category);
            
            return redirect()->route('categories.index')->with('info', 'Category has been added!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages/admin/categories/update', compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->hasFile('image')) {

            if($category->image) {
                ImageCategoryHelper::removeImagesFromStorage('', $category->image);
            }

            $requestImage = $request->file('image');
            $newImageName = TextHelper::buildAlbumImageName($category->title, $requestImage->getClientOriginalExtension());
            ImageCategoryHelper::storeImage($requestImage, $category->title, $newImageName); // возможно не нужен album->title

            $category->image = $newImageName;
        }

        if (empty($category->image)) {
            return redirect()->back()->with('status', 'Select image!'); 
        }

        $category->description = $request->description;
        $category->update();

        return redirect()->route('categories.edit', compact('category'))->with('info', 'Category has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->image) {
            ImageCategoryHelper::removeImagesFromStorage('', $category->image);
            File::deleteDirectory(Storage::path('posts/' . TextHelper::transliterate($category->title) . '/'));
        }

        $category->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }  
}
