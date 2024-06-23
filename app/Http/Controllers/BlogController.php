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
    private $categories;

    public function __construct()
    {
        $this->categories = Category::orderBy('position', 'asc')->paginate(Settings::getValue("site_items_per_page"));
    }

    public function index()
    {
        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('categories');
        $categories = $this->categories;

        return view('pages/site/categories', compact('breadcrumbs', 'categories'));
    }

    public function show($id)
    {
        $category = new CategoryResource(Category::with('posts')->findOrFail($id)); 
        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(Settings::getValue("site_items_per_page"));

        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('category', $category->title);
        $categories = $this->categories;

        return view('pages/site/category', compact('breadcrumbs', 'categories', 'category', 'posts'));
    }

    public function showPost($id)
    {
        $post = Post::with('category')->orderBy('created_at', 'desc')->findOrFail($id);

        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('post', $post->category->title, $post->category->id);
        $categories = $this->categories;

        return view('pages/site/post', compact('breadcrumbs', 'categories', 'post'));
    }

    public function searchPhrase(Request $request)
    {
        $phrase = $request->search_phrase;
        $posts = Post::where('description', 'LIKE', "%".$phrase."%")
            ->orWhere('title', 'LIKE', "%".$phrase."%")
            ->paginate(Settings::getValue("site_items_per_page"));

        $breadcrumbs = Breadcrumbs::buildBreadcrumbs('search');
        $categories = $this->categories;

        return view('pages/site/posts', compact('breadcrumbs', 'categories', 'posts', 'phrase'));      
    }
}
