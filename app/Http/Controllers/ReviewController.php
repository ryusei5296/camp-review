<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;

use App\Like;

use App\Comment;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }
    
    public function index()
    {
    	$reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
    	
    	return view('index',compact('reviews'));
    }
    
    
    
    public function show($id)
	{
	    $review = Review::where('id', $id)->where('status', 1)->first();
	
	    return view('show', compact('review'));
	}
    
    public function create()
    {
        return view('review');
    }
    
    public function store(Request $request)
    {
        $post = $request->all();
        
        $validatedData = $request->validate([
	        'title' => 'required|max:255',
	        'body' => 'required',
	        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);
        
        if($request->hasFile('image')){
        
	        $request->file('image')->store('/public/images');
	    	$data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body'], 'image' => $request->file('image')->hashName()];
		
        }else{
        	$data = ['user_id'=>\Auth::id(), 'title' => $post['title'], 'body' => $post['body']];
        }
        
		Review::insert($data);
		
		return redirect('/')->with('flash_message', '投稿が完了しました');

        
    }
    
    
    public function like($id)
    {
      Like::create([
        'review_id' => $id,
        'user_id' => \Auth::id(),
      ]);

      session()->flash('success', 'You Liked the Reply.');

      return redirect()->back();
    }
    
    public function unlike($id)
    {
      $like = Like::where('review_id', $id)->where('user_id', \Auth::id())->first();
      $like->delete();

      session()->flash('success', 'You Unliked the Reply.');

      return redirect()->back();
    }
    
    public function res($id)
    {
      $review = Review::where('id', $id)->where('status', 1)->first();
      $comments = Comment::where('review_id',$id)->orderBy('created_at')->paginate(8);
	
	    return view('res', compact('review'),compact('comments'));
    }
    
    
    public function res_store(Request $request,$id)
    {
      
        $post = $request->all();
        $data = ['review_id' => $id, 'description' => $post['description'], 'user_id'=>\Auth::id()];
        
        Comment::insert($data);

        return redirect('/res/'.$id);
    }
    
    public function edit($id){
      
      $data = Review::findOrFail($id);
      
 
      #viewに連想配列を渡す
      return view('edit',['message' => '編集フォーム','data' => $data]);
    
    }
    
    public function update(Request $request, $id){
      
      $post = Review::findOrFail($id);
        
      if($request->hasFile('image')){
        
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $request->image;
      
      }else{
      	$post->title = $request->title;
        $post->body = $request->body;
      }
      
      
        
		  $post->save();
      
      return redirect('/')->with('flash_message', '編集が完了しました');
    }
    
    public function delete($id){
      
      $post = Review::where('id', $id)->where('status', 1)->delete();
  
      return redirect('/');
      
    }
}
