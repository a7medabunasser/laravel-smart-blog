<?php

namespace App\Http\Controllers;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = PostStatus::tryFrom($request->status) ?? PostStatus::Published;

        $posts = Post::query()
            ->where('user_id', auth()->id())
            ->where('status', $status)
            ->latest()
            ->get();

        $status_options = array_map(function (PostStatus $status) {
            return [
                'name' => $status->getLabel(),
                'value' => $status->value,
                'color' => $status->getColor(),
                'count' => Post::query()->where('user_id', auth()->id())->where('status', $status->value)->count(),
            ];
        }, PostStatus::cases());

        return view('dashboard.posts.index', compact('posts', 'status', 'status_options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'post' => new Post,
            'status_options' => PostStatus::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, SyncPostTags $syncPostTags, FileUpload $fileUpload)
    {
        // $fileUpload = app(FileUpload::class);
        $clean = $request->validated();

        $data = array_merge($clean, [
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->post('title')),
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        DB::beginTransaction();
        try {
            $post = Post::create($data);
            $syncPostTags->handle($post, $clean['tags'] ?? []);
            DB::commit();

            return redirect()
                ->route('dashboard.posts.index')
                ->with('status', 'Post created successfully!');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()->withInput()->withErrors(['status' => 'Failed to create post : '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::findOrFail($id);

        return view('dashboard.posts.edit', [
            'post' => $post,
            'status_options' => PostStatus::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, SyncPostTags $syncPostTags, FileUpload $fileUpload, string $id)
    {
        $post = Post::findOrFail($id);

        $oldCoverImage = $post->cover_image;

        $clean = $request->validated();

        $data = $clean;

        if ($cover = $fileUpload->handle(key: 'cover', path: 'covers')) {
            $data['cover_image'] = $cover;
        }

        try {
            DB::transaction(function () use ($post, $data, $syncPostTags, $clean) {
                $post->update($data);

                $syncPostTags->handle($post, $clean['tags'] ?? []);
            });
        } catch (Throwable $e) {
            return back()->withInput()->withErrors(['status' => 'Failed to create post : '.$e->getMessage()]);

        }

        if ($oldCoverImage && $oldCoverImage !== $post->cover_image) {
            Storage::disk('public')->delete($oldCoverImage);
        }

        return redirect()->route('dashboard.posts.index', ['status' => $post->status->value])
            ->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Post::destroy($id);
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image); // Delete the cover image from storage
        }

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index')
            ->with('status', 'Post deleted successfully!');
    }
}
