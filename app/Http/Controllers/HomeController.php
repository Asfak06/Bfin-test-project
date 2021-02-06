<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Story;
use App\Models\Tag;
use App\Models\Section;
use Auth;
class HomeController extends Controller
{
    public function index()
    {
      $story=Story::where('listed',1)->orderBy('created_at', 'desc')->paginate(3);
      return view('welcome')->with('stories', $story)->with('sections',Section::all())->with('tags',Tag::all());
    }


    public function section($id){
         $section = Section::where('id', $id)->first();
        return view('welcome')->with('stories', $section->stories()->where('listed',1)->orderBy('created_at', 'desc')->paginate(3))->with('sections',Section::all())->with('tags',Tag::all());
    }
   public function tag($id){
        $tag = Tag::where('id', $id)->first();
        return view('welcome')->with('stories', $tag->stories()->where('listed',1)->orderBy('created_at', 'desc')->paginate(3))->with('sections',Section::all())->with('tags',Tag::all());
    }

    public function restore(Story $story){
      $story->listed=1;
      $story->save();
      session()->flash('success', 'Story restored successfully.');
      return redirect()->route('stories');
    }

    public function unlist(Story $story){
      $story->listed=0;
      $story->save();
      session()->flash('success', 'Story restored successfully.');
      return redirect()->route('stories');  
    }
     public function unlisted(){
      $story=Story::where('listed',0)->orderBy('created_at', 'desc')->paginate(3);
      return view('welcome')->with('stories', $story)->with('sections',Section::all())->with('tags',Tag::all());
    }
    
     public function mystory(){
      $story=Story::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(3);
      return view('welcome')->with('stories', $story)->with('sections',Section::all())->with('tags',Tag::all());
    }

     public function search(Request $request){
      $story=Story::where('listed',1)
                    ->where(function($query) use ($request){
                       $query->where('title','LIKE', '%' . $request->content . '%')
                              ->orWhere('story','LIKE', '%' . $request->content . '%')
                              ->orWhere('image_cap','LIKE', '%' . $request->content . '%');
                     })->orderBy('created_at', 'desc')->paginate(3);

      return view('welcome')->with('stories', $story)->with('sections',Section::all())->with('tags',Tag::all());
    }
}
