<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\validPostTitle;
use App\Rules\MaxThreePosts;

class createPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->post()->can('update', $this->post());
    }


    public function rules(): array
    {
        return [
            "name" => "required|exists:users,id",
            "title" => ["required", new validPostTitle(), new MaxThreePosts()],
            "content" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "name.required" => "You must select a creator.",
            "name.exists" => "The selected creator does not exist.",
            "title.required" => "A post must have a title.",
            "content.required" => "Content is required for the post.",
            "image.required" => "An image is required to create a post.",
            "image.image" => "The file must be an image.",
            "image.mimes" => "The image must be a file of type: jpeg, png, jpg.",
            "image.max" => "The image size must not exceed 2MB.",
        ];
    }
}
