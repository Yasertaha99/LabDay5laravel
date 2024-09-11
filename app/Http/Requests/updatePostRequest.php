<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\validPostTitle;

class updatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->post()->can('update', $this->post());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["required", new validPostTitle()],
            "content" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048" // Image is optional (nullable)
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
            "title.required" => "A post must have a title.",
            "content.required" => "Content is required for the post.",
            "image.image" => "The file must be an image.",
            "image.mimes" => "The image must be a file of type: jpeg, png, jpg.",
            "image.max" => "The image size must not exceed 2MB.",
        ];
    }
}
