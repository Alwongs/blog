<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RootAdminMiddleware;

use App\Models\Event;
use App\Models\Setting;
use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use App\Models\Post;

use App\Helpers\EventHelper;
use App\Helpers\DateHelper;
use App\Helpers\Settings;
use App\Helpers\ImageHelper;
use App\Helpers\TextHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(RootAdminMiddleware::class)->only(['removeAlbumsAndPhotos', 'makeNewThumbnails']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messageCount = Message::count();
        $userCount = User::count();
        $albumCount = Category::count();
        $photoCount = Post::count();

        session([
            'messageCount' => $messageCount,
            'userCount'    => $userCount,
            'albumCount'    => $albumCount,
            'photoCount'    => $photoCount,
        ]);

        $events = Event::where('user_id', Auth::id())->get();
        list($overdue, $today, $tomorrow, $in_week) = EventHelper::chunckEventsToPeriods($events); 

        return view('dashboard', compact('events', 'overdue', 'today', 'tomorrow', 'in_week'));
    }

    public function postpone($id)
    {
        $event = Event::find($id);

        if ($event->type == 'M') {
            $new_timestamp = strtotime('+1 month', $event->timestamp);
        } 

        if ($event->type == 'A') {
            $new_timestamp = strtotime('+1 year', $event->timestamp);
        } 

        $event->timestamp = $new_timestamp;

        $event->update();   
        
        return redirect()->route('dashboard');
    }

    public function makeNewThumbnails()
    {
        // $resolution = [600, 400];
        // $photos = Photo::all();

        // foreach ($photos as $photo) {

        //     $albumTitle = TextHelper::transliterate($photo->album->title);

        //     $originalPath = 'photos/' . $albumTitle. '/originals/';

        //     if (!empty($photo->image) && File::exists(Storage::path($originalPath) . $photo->image)) {

        //         $imageFile = Image::make(Storage::path($originalPath) . $photo->image);
        //         $imageFile->fit($resolution[0], $resolution[1]);

        //         $thumbnailPath = 'photos/' . $albumTitle . '/previews_small/';

        //         ImageHelper::storeResized($imageFile, $thumbnailPath, $photo->image);
        //     } 
        // }

        // return redirect()->route('dashboard')->with('info', 'Success, thumbnails added!'); 

        return redirect()->route('dashboard')->with('status', 'method makeNewThumbnails is commented!'); 
    }

    public function removeCategoriesAndPosts()
    {

        DB::statement("SET foreign_key_checks=0");
        Category::truncate();
        Post::truncate();
        DB::statement("SET foreign_key_checks=1");

        if (File::exists(Storage::path('categories'))) {
            File::deleteDirectory(Storage::path('categories'));
        }

        if (File::exists(Storage::path('posts'))) {
            File::deleteDirectory(Storage::path('posts'));
        }

        return redirect()->route('settings.index')->with('info', 'Removed successfully!'); 

        // return redirect()->route('dashboard')->with('status', 'method removeAlbumsAndPhotos is commented!');         
    }

    public function removeEvents()
    {
        DB::statement("SET foreign_key_checks=0");
        Event::truncate();
        DB::statement("SET foreign_key_checks=1");

        return redirect()->route('settings.index')->with('info', 'Removed successfully!');
    }
}