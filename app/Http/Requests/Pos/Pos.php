<?php


namespace App\Http\Requests\Pos;
use App\Abstracts\Http\FormRequest;


class Pos extends FormRequest
{
    public function authorize()
    {
        return true;
    }

}