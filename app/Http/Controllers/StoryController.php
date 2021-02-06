<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Story;
use App\Models\Tag;
use App\Http\Requests\Stories\CreateStoriesRequest;
class StoryController extends Controller
{
    public function __construct()
    {
      $this->middleware(['verifySectionsCount','auth','unblocked'])->only(['edit','create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storycreate')->with('sections', Section::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoriesRequest $request)
    {

      $image=$request->image;
      $image_new_name=time().$image->getClientOriginalName();
      $image->move('uploads/posts',$image_new_name);
        // create the story
        $stories = Story::create([
          'title' => $request->title,
          'image_cap' => $request->description,
          'story' => $request->content,
          'image' => 'uploads/posts/'.$image_new_name,
          'section_id' => $request->section,
          'user_id' => Auth::id()
        ]);

        if ($request->tags) {
          $stories->tags()->attach($request->tags);
        }

        // flash message
        session()->flash('success', 'Story created successfully.');
        // redirect user

        return redirect()->route('stories');
    }

    public function show($id)
    {
        $story = Story::where('id', $id)->first();


        return view('stories.show')
                        ->with('d', $story);
    }


  public function edit(Story $story)
    {
        if($story->user_id !== Auth::id() ){
          return view('warings.access');
        }

        else{
        return view('storycreate')->with('story', $story)->with('sections', Section::all())->with('tags', Tag::all());
        }
    }


 public function update(Request $request, $id)
    {
         $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'section' => 'required'
        ]);

        $story=Story::find($id);
        if($request->hasFile('image')){
          $image=$request->image;
          $image_new_name=time().$image->getClientOriginalName();
          $image->move('uploads/posts',$image_new_name);
          $story->image='uploads/posts/'.$image_new_name;
        }
        $story->title=$request->title;
        $story->story=$request->content;
        $story->section_id=$request->section;
        $story->image_cap=$request->description;

        $story->save();
        $story->tags()->sync($request->tags);
        session()->flash('success', 'Story updated successfully.');
        return redirect()->route('stories');
    }

    public function destroy(Story $story)
    {
        $story->delete();

        session()->flash('success', 'Story deleted successfully.');

       return redirect()->route('stories'); 
    }
}
