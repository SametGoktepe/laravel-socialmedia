<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Repost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function posts(Post $post, Request $request)
    {
        $posts = $post->with('user')
            ->paginate(10)
            ->appends($request
                ->query());
        return Controller::response(true, 'Posts', PostResource::collection($posts)->response()->getData(true), Response::HTTP_OK);
    }

    public function create(PostRequest $request, Post $post)
    {
        $posts = $post->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        return Controller::response(true, 'Post created', $posts, Response::HTTP_OK);
    }

    public function repost(Post $post, Repost $repost, $id)
    {
        $posts = $post->find($id);
        $repost->create([
            'user_id' => Auth::user()->id,
            'post_id' => $posts->id,
        ]);

        return Controller::response(true, 'Post reposted', null, Response::HTTP_OK);
    }
}
