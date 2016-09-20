<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [];

        $numFiles = count($this->input('files')) - 1;
        foreach(range(0, $numFiles) as $index) {
            $rules['files.' . $index] = 'mimes:jpeg,png,gif|image|max:'.Helper::getMaxUploadLimitInBytes() / 1024;
        }

        return $rules;
    }
}
