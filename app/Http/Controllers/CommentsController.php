<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Story;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\Comments\CreateCommentRequest;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request, Story $story)
    {
        auth()->user()->comments()->create([
          'content' => $request->content,
          'story_id' => $story->id
        ]);

        session()->flash('success', 'Comment added.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story, Comment $comment)
    {
        if($comment->user_id !== Auth::id() ){
          return view('warnings.access');
        }else{
          return view('comments.edit',['story'=>$story,'comment'=>$comment]);         
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Story $story, Comment $comment)
    {
        $this->validate(request(),[
            'content'=>'required'
        ]);

         $comment->update([
          'content' => request()->content
         ]);
        session()->flash('success', 'Comment updated.');  
        return redirect()->route('stories.show',['story'=>$comment->story->id]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story, Comment $comment)
    {
        $comment->delete();

        session()->flash('success', 'Comment deleted successfully.');

       return redirect()->back(); 
    }
}
