<?php 

namespace App\Controllers;

use App\Thread;

use App\Database;

use App\Topic;

class ThreadsController extends Controller{

	public function index()
	{
		// if url has id then show thread posts, else threads list

		$id = get_int('id', false);

		if($id)
			return $this->posts($id);

		return $this->threads();
	
	}

	public function threads()
	{
		// list 20 threads per page

		// get sort type


		$query = Thread::where('parent_id', null)->with('user')->with('topic')->limit(20);

		$sort = get_string('sort', 'newest');

		$topic = get_int('topic', false);

		if($topic)
			$query->where('topic_id', $topic);

		Thread::setOrder($query, $sort);

		$threads = $query->get();

		$topics = Topic::all();

		return view('threads.index', compact('threads', 'sort', 'topics'));
	
	}

	public function posts($id)
	{
		// get main thread post with user information

		$post = Thread::with('user')->find($id);

		// get all thread replies with their user information

		$replies = Thread::with('user')->where('parent_id', $id)->get();

		// generate output

		return view('threads.posts', compact('post', 'replies'));
	
	}

	// create new thread

	public function add()
	{	
	
		return $this->form('add');
	
	}

	// edit post

	public function edit()
	{	

		return $this->form('edit');
	
	}

	public function form($type='add')
	{
	
		// user must be logged in
		if(!is_logged())
			forbidden();

		if($type=='edit'){

			$id = get_int('id', false);

			if(!$id) die('Invalid post');

			// get post details

			$post = Thread::find($id);

			if($post->user_id != user()->id){
				die('You are not authrized to edit this post');
			}

		}else{

			$post = null;

		}

		$topics = Topic::all();

		return view('threads.form', compact('post', 'topics', 'type'));

	
	}

	// create a new thread

	public function create()
	{

		$post = $this->store('create', '/thread/new');

		redirect('/threads?id=' . $post->id);
	}

	// save post

	public function save()
	{

		$post = $this->store('save', '/thread/edit?id=_id_');

		if($post->parent_id>0){
			redirect('/threads?id=' . $post->parent_id . '#reply' . $id);
		}

		redirect('/threads?id=' . $post->id);
	
	}

// reply to a thread

	public function reply()
	{

		$reply = $this->store('reply', '/threads?id=_id_#form-reply');

		(new Thread)->updateTotalReplies($reply->parent_id);

		redirect('/threads?id=' . $reply->parent_id . '#reply-id' . $reply->id);
	
	}

	// delete reply or thread

	public function remove()
	{
	
		// get post id from url

		$id = get_int('id', false);

		if(!$id) die('Invalid post id');

		// user must be logged in to perform this action

		if(!is_logged())
			die('You are not authorized to perform this action');

		// get post details

		$post = Thread::find($id);

		// check if user own this post

		if(!$post || $post->user_id != user()->id )
			die('You are not authorized to perform this action');

		// remove the post and all it's replies

		// if parent delete all it's replies first

		if(is_null($post->parent_id))
			Thread::where('parent_id', $id)->remove();

		// remove post

		Thread::where('id', $id)->remove();



		// if it was a reply update thread's replies count

		if($post->parent_id>0)
			(new Thread)->updateTotalReplies($post->parent_id);

		// if it was a thread return to thread list, else return to thread

		if($post->parent_id>0)
			return redirect('/threads?id=' . $post->parent_id);

		return redirect();
	
	}

	public function store($type='create', $redirect_url='/')
	{
	
		// user must be logged in

		if(!is_logged())
			forbidden();

		if($type=='save' || $type=='reply'){

			$id = post_int('id', false);

			if(!$id) die('Invalid post');

			$post = Thread::find($id);

		}

		$rules['body'] = 'text|min:2';

		if($title = post_string('title', false))
			$rules['title'] = 'text|min:2';

		if($id)
			$redirect_url = str_replace('_id_', $id, $redirect_url);

		$valid = $this->validate($rules, $redirect_url);

		if($title)
			$data['title'] = sanitize_string($_POST['title']);

		$data['body'] = sanitize_richtext($_POST['body']);

		$data['topic_id'] = post_int('topic_id', null);

		if($type=='save'){

			Thread::update($data, ['id' => $id]);

			return $post;

		}elseif($type=='reply'){

			$data['user_id'] = user()->id;

			$data['parent_id'] = $id;

			return Thread::create($data);


		}else{

			$data['user_id'] = user()->id;

			return Thread::create($data);
		}
	
	}

}