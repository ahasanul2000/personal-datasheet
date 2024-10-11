<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:pds,email,' . $this->id,
            'fullName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // Image validation rule
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'This email is already in use',
            'fullName.required' => 'Full Name is required',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be a valid number',
            'image.image' => 'Please upload a valid image file', // Custom error message for image validation
            'image.mimes' => 'Allowed image types are jpeg, png, jpg, gif, and svg',
            'image.max' => 'The image size must not exceed 2MB',
        ];
    }
}
