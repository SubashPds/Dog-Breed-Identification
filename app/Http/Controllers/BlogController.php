<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {

        if ($request->search) {
            $posts = Post::where('is_approved', 1)
                ->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('body', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->paginate(4);
        } elseif ($request->category) {
            $posts = Category::where('name', $request->category)
                ->firstOrFail()
                ->posts()
                ->where('is_approved', 1)
                ->paginate(3)
                ->withQueryString();
        } else {
            $posts = Post::where('is_approved', 1)
                ->latest()
                ->paginate(4);
        }

        $categories = Category::all();

        return view('blogPosts.blog', compact('posts', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('blogPosts.create-blog-post', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->input('title');
        $category_id = $request->input('category_id');

        if (Post::latest()->first() !== null) {
            $postId = Post::latest()->first()->id + 1;
        } else {
            $postId = 1;
        }

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = Auth::user()->id;
        $body = $request->input('body');


        $imagePath = $request->file('image');
        $filename = date('YmdHi') . $imagePath->getClientOriginalName();
        $imagePath->move(public_path('postImage'), $filename);





        $post = new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->imagePath = 'postImage/' . $filename;

        $post->save();

        return redirect()->back()->with('status', 'Post Created Successfully');
    }

    public function edit(Post $post)
    {
        if (auth()->user()->id !== $post->user->id) {
            abort(403);
        }
        return view('blogPosts.edit-blog-post', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user->id) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);

        $title = $request->input('title');

        $postId = $post->id;
        $slug = Str::slug($title, '-') . '-' . $postId;
        $body = $request->input('body');

        $imagePath = $request->file('image');
        $filename = date('YmdHi') . $imagePath->getClientOriginalName();
        $imagePath->move(public_path('postImage'), $filename);

        $post->title = $title;
        $post->slug = $slug;
        $post->body = $body;
        $post->imagePath = 'postImage/' . $filename;

        $post->save();

        return redirect()->back()->with('status', 'Post Edited Successfully');
    }

    public function approve(Request $request, Post $post)
    {

        $post->is_approved = true;


        $post->save();

        return redirect()->back()->with('status', 'Post Edited Successfully');
    }
    public function block(Post $post)
    {

        $post->is_approved = false;


        $post->save();

        return redirect()->back()->with('status', 'Post Edited Successfully');
    }
    // public function show($slug){
    //     $post = Post::where('slug', $slug)->first();
    //     return view('blogPosts.single-blog-post', compact('post'));
    // }

    // Using Route model binding
    public function show(Post $post)
    {
        $category = $post->category;

        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->latest()->take(3)->get();
        return view('blogPosts.single-blog-post', compact('post', 'relatedPosts'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('status', 'Post Delete Successfully');
    }

    public function indexOwnBlog()
    {
        $users = User::where('is_admin','=',null)->get();
        $totalUsers=$users->count();
        // dd($users);
        $latestUsers = User::where('is_admin', '=', null)->orderBy('created_at', 'desc')->get()->take(5);
        $categories = Category::all();
        $user_id = auth()->user()->id;
        $allPost = Post::all();
        $total_posts = $allPost->count();
        $total_approved_posts = $allPost->where('is_approved', 1)->count();
        $total_pending_posts = $allPost->where('is_approved', 0)->count();
        $posts = Post::where('user_id', $user_id)->get();
        return view('dashboard', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'latestUsers' => $latestUsers,
            'posts' => $posts,
            'categories' => $categories,
            'total_posts' => $total_posts,
            'total_approved_posts' => $total_approved_posts,
            'total_pending_posts' => $total_pending_posts
        ]);
    }
    public function pendingBlog()
    {
        $posts = Post::where('is_approved', 0)->get();
        return view('pendingBlogs', compact('posts'));
    }
    public function totalBlogs()
    {
        $posts = Post::all();
        $total_posts = $posts->count();
        $total_approved_posts = $posts->where('is_approved', 1)->count();
        $total_pending_posts = $posts->where('is_approved', 0)->count();

        return view('dashboard', [
            'total_posts' => $total_posts,
            'total_approved_posts' => $total_approved_posts,
            'total_pending_posts' => $total_pending_posts
        ]);
    }
    public function users(){
        $users = User::where('is_admin','=',null)->get();
        return view('users',compact('users'));

    }
}
