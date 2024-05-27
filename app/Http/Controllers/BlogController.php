<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Post;
use App\Helpers\Breadcrumbs;
use App\Helpers\Settings;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(Settings::getValue("site_items_per_page"));
        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('categories');

        return view('pages/site/categories', compact('categories', 'breadcrumbs'));
    }

    public function show($id)
    {
        $category = new CategoryResource(Category::with('posts')->findOrFail($id)); 
        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(Settings::getValue("site_items_per_page"));
        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('category', $category->title);

        return view('pages/site/category', compact('category', 'posts', 'breadcrumbs'));
    }

    public function showPost($id)
    {
        $post = Post::with('category')->orderBy('created_at', 'desc')->findOrFail($id);
        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('post', $post->category->title, $post->category->id);

        return view('pages/site/post', compact('post', 'breadcrumbs'));
    }
}
