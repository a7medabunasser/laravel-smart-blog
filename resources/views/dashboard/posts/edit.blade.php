<x-layouts.main-layout title="Update Post">
    @include('dashboard.posts._form', [
        'post' => $post,
        'action' => route('dashboard.posts.update', $post->id),
        'method' => 'PUT',
        'type' => 'Update',
    ])
</x-layouts.main-layout>
