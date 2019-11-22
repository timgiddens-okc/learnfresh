<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use App\CommentFile;
use App\User;
use App\Notifications\TopicPosted;
use App\Notifications\CommentPosted;
use Illuminate\Http\Request;

class ForumController extends Controller
{
		public function __construct()
		{
				$this->middleware('auth');
		}
	
		public function newPost()
		{
			return view("forum.new");
		}
		
		public function postNewPost(Request $request)
		{
			$this->validate($request, [
				"category" => "required",
				"subject" => "required|unique:topics,title",
				"text" => "required"
			]);
			
			$topic = new Topic();
    		
  		$topic->title = $request->input('subject');
  		$topic->slug = str_slug($request->input('subject'),'-');
  		$topic->user_id = \Auth::user()->id;
  		$topic->category = $request->input('category');
  		$topic->save();
  		
  		$comment = new Comment();
  		
  		$comment->comment = $request->input('text');
  		$comment->user_id = \Auth::user()->id;
  		$comment->topic_id = $topic->id;
  		$comment->save();
  		
  		if($request->file('files')){
			foreach($request->file('files') as $file){
			    $commentFile = new CommentFile();
			    
	    		$fileName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/forum-files/images/', $fileName);
				$uploadedFile = "/forum-files/images/" . $fileName;
				$commentFile->url = $uploadedFile;
				$commentFile->file_extension = $file->getClientOriginalExtension();
				$comment->addFile($commentFile);
				
				$commentFile->save();
		    }
	    }
  		
  		$topic->addComment($comment);
  		
  		$thisUser = null;
  		
  		switch($request->input('category')){
	  		case "media":
	  			$thisUser = User::where('email','nick@learnfresh.org')->first();
	  			break;
	  		case "program-support":
	  			$thisUser = User::where('email','calvin@learnfresh.org')->first();
	  			break;
	  		case "testing":
	  			$thisUser = User::where('email','calvin@learnfresh.org')->first();
	  			break;
	  		case "all-star-advice":
	  			$thisUser = User::where('email','calvin@learnfresh.org')->first();
	  			break;
	  		case "events":
	  			$thisUser = User::where('email','jeff@learnfresh.org')->first();
	  			break;
	  		case "classroom-creations":
	  			$thisUser = User::where('email','calvin@learnfresh.org')->first();
	  			break;
	  		case "other":
	  			$thisUser = User::where('email','colleen@learnfresh.org')->first();
	  			break;
  		}
  		
  		
  		$thisUser->notify(new TopicPosted($topic));
  		
  		\Session::flash('alert-success','Your topic has been posted!');
  		return redirect('/community/' . $topic->slug);
		}
		
		public function category($category)
		{
			$topics = Topic::where('category', $category)->orderBy('created_at','DESC')->paginate(7);
			$topics->load('comments');
			$category_title = ucwords(str_replace('-', ' ', $category));
  		
  		return view('forum.category', [
    		'topics' => $topics,
    		'category' => $category_title
  		]);
		}
	
    public function index()
    {
    		$topics = Topic::orderBy('created_at','DESC')->paginate(7);
    		
    		$topics->load('comments');
    		
    		return view('forum.index', [
	    		'topics' => $topics
    		]);
    }
    
    public function search(Request $request)
    {
	    $searchString = $request->input('query');
	    
	    $topics = Topic::whereHas('comments', function($query) use($searchString){
		    $query->where('comment', 'like', '%'.$searchString.'%');
	    })
	    ->with(['user' => function($query) use ($searchString){
	        $query->where('name', 'like', '%'.$searchString.'%');
	    }])->orWhere("title","like","%".$searchString."%")->orderBy('created_at','DESC')->paginate(7);
	        		
    		$topics->load('comments');
    		
    		return view('forum.search', [
	    		'topics' => $topics
    		]);
    }
    
    public function edit($slug)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
	    return view("forum.topic.edit", [
		    'topic' => $topic
	    ]);
    }
    
    public function editComment($slug, Comment $comment)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
	    return view("forum.comment.edit", [
		    'comment' => $comment
	    ]);
    }
    
    public function updateComment($slug, Comment $comment, Request $request)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
	    $comment->update($request->all());
	    \Session::flash('alert-success','The comment has been updated!');
	    return redirect('/community/' . $topic->slug);
    }
    
    public function deleteCommentFile(CommentFile $commentFile) {
	    $commentFile->delete();
	    \Session::flash('alert-success','The file has been deleted!');
	    return back();
    }
    
    public function deleteComment($slug, Comment $comment)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
	    foreach($comment->files as $file){
		    $file->delete();
	    }
	    
	    $comment->delete();
	    \Session::flash('alert-success','The comment has been deleted!');
	    return redirect("/community/" . $topic->slug);
    }
    
    public function delete($slug)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
	    $topic->delete();
	    
	    return redirect("/community");
    }
    
    public function update($slug, Request $request)
    {
	    $topic = Topic::where('slug', $slug)->first();
	    
			$topic->update($request->all());
			
			$topic->slug = str_slug($request->input('title'),'-');
			
			$topic->save();
			
			return redirect('/community/' . $topic->slug);
    }
    
    public function addTopic(Request $request)
    {
	    	$allUsers = User::all();
	    
    		$this->validate($request, [
	    		'title' => 'unique:topics|required'
    		]);
    		
    		$topic = new Topic();
    		
    		$topic->title = $request->input('title');
    		$topic->slug = str_slug($request->input('title'),'-');
    		$topic->user_id = \Auth::user()->id;
    		
    		$topic->save();
    		
				$admins = User::where(function ($query) {
					$query->where('id','=',2)->orWhere('id','=',5);
				})->get();
				
    		foreach($admins as $thisUser){
    			$thisUser->notify(new TopicPosted($topic));
    		}

    		\Session::flash('alert-success','The new topic has been posted!');
    		return back();
    }
    
    public function getTopic($slug)
    {
	    	$topic = Topic::where('slug', $slug)->first();
	    	
	    	if(!$topic){
		    	\Session::flash('alert-warning','The topic you requested has not been found.');
	    		return redirect("/community");
	    	} else {
		    	$topic->load('comments.files');
		    	$comments = Comment::where('topic_id','=',$topic->id)->orderBy('created_at','desc')->paginate(10);
		    	$comments->load('files');
		    
	    		return view('forum.show', [
		    		'topic' => $topic,
		    		'comments' => $comments
	    		]);
    		}
    }
    
    public function addComment(Request $request, $slug)
    {
	    		
	    		$this->validate($request, [
	    			'comment' => 'required'
				]);
    			$topic = Topic::where('slug', $slug)->first();
    			
    			$comments = $topic->comments;
    			
    			$comment = new Comment($request->all());
    			
    			$comment->user_id = \Auth::user()->id;
    			
    			$topic->addComment($comment);
    			
    			$notifiedUsers = array();
    			
    			$notifiedUsers[] = $topic->user->id;
    			
    			$topic->user->notify(new CommentPosted($comment));
    			
    			if($request->file('files')){
	    			foreach($request->file('files') as $file){
					    $commentFile = new CommentFile();
					    
			    		$fileName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
							$file->move(base_path() . '/public/forum-files/images/', $fileName);
							$uploadedFile = "/forum-files/images/" . $fileName;
							$commentFile->url = $uploadedFile;
							$commentFile->file_extension = $file->getClientOriginalExtension();
							$comment->addFile($commentFile);
							
							$commentFile->save();
				    }
			    }
    			
    			foreach($comments as $thisComment){
	    			$thisUser = $thisComment->user;
	    			if(!in_array($thisUser->id, $notifiedUsers)){
		    			$thisUser->notify(new CommentPosted($comment));
		    			$notifiedUsers[] = $thisUser->id;
	    			}	    			
    			}
    			
    			\Session::flash('alert-success','Your comment has been updated!');
    			return back();
    }
}