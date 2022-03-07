<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    
    // public function authorize()
    // {
    //     return false;
    // }

    public function getData(){
        return $this->input('Order');
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
