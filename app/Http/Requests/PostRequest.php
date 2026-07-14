<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('posts', 'title')->ignore(auth()->id(), 'user_id'),
            ],

            'content' => ['required', 'string'],

            'cover' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:1024', // 1 MB
                // 'dimensions:min_width=600,min_height=400,max_width=2000,max_height=2000',
            ],

            'tags' => ['nullable', 'string'],

            'status' => ['required', Rule::enum(PostStatus::class)],
            // 'published_at' => ['nullable', 'date'],
            // 'meta' => ['nullable', 'array'],
            // 'meta.title' => ['nullable', 'string', 'max:255'],
            // 'meta.keywords' => ['nullable', 'string', 'max:255'],
            // 'meta.url' => ['nullable', 'url'],
            // 'meta.description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [];
        // return [
        //     'required' => ':attribute is required!',
        //     'title.min' => ':attribute :min is mandatory',
        // ];
    }

    #[Override]
    public function attributes(): array
    {
        return [
            'title' => 'Post title',
            'content' => 'Post content',
            'cover' => 'cover image',
        ];
    }
}
