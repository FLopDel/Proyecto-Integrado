<?php

namespace App\Http\Requests;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Section;
use App\Models\Valoration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Validation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'title' => ['required', 'regex:/^[A-Za-z]+$/' , 'max:255'],
            'imagen' => ['required'],
            'date' => ['required'],
            'message' => ['required', 'max:255'],
            'price' => ['required', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'ingredients' => ['required', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'id_section' => ['required'],
            'phone' => ['required', 'regex:/^[0-9]{9}$/'],
            'people' => ['required'],
            'time' => ['required'],
            'subtitle' => ['required', 'regex:/^[A-Za-z]+$/', 'max:255'],
            'comments' => ['required', 'regex:/^[A-Za-z0-9]+$/', 'max:255'],

        ];
    }
}
