<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true if you want to allow all users to make this request
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:pds,email,' . $this->id, // Ensure that the email is unique, ignoring the current record
            'fullName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email must be unique',
            'fullName.required' => 'Full Name is required',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be an integer',
        ];
    }
}
