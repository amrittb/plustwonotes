<?php namespace App\Http\Requests;

use App\Models\Category;

class SavePostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'post_title' => 'required|min:3|max:100',
			'post_body' => 'required',
			'category_id' => 'required|integer'
		];

		//	subject_id is only required and must have non zero value
		// 	when the category_id in the request does not match that of a blog
		if($this->request->getInt('category_id') != Category::BLOG){
			$rules['subject_id'] = 'required|integer|min:1';
		}

		return $rules;
	}

}