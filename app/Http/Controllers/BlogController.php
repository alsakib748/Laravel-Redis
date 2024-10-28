<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{

    public function blogs(){

        $time_start = microtime(true);

        $cachedBlogs = Redis::get('blogs');

        $time_end = microtime(true);

        $execution_time = ($time_end - $time_start);

        if(isset($cachedBlogs)) {
            $blogs = json_decode($cachedBlogs);

            return view('blog',compact('blogs','execution_time'));
        }else{

            $time_start = microtime(true);

            $blogs = Blog::all();

            $time_end = microtime(true);

            $execution_time = ($time_end - $time_start);

            Redis::set('blogs',json_encode($blogs));

            return view('blog',compact('blogs','execution_time'));

        }

    }

    public function blogsEdit($id){

        $blog = Blog::findOrFail($id);

        return view('blog_edit',compact('blog'));
    }

    public function blogsUpdate(Request $request){

        $id = $request->id;

        $blog = Blog::findOrFail($id)->first();

        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->tags = $request->tags;
        $blog->save();

        $blogs = collect(json_decode(Redis::get('blogs')));
        $blog = $blogs->where('id',$id)->first();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->tags = $request->tags;
        $index = $blogs->search(value: $blog);
        $blogs[$index] = $blog;

        Redis::set('blogs',json_encode($blogs));

        return redirect()->route('blogs');

    }

    public function blogsDelete($id){

        Blog::findOrFail($id)->delete();

        $blogs = collect(json_decode(Redis::get('blogs')));
        $blog = $blogs->where('id',$id)->first();
        $index = $blogs->search($blog);
        $blogs->forget($index);

        Redis::set('blogs',json_encode($blogs));

        return redirect()->route('blogs');

    }

}
