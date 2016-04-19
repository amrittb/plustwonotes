<?php namespace App\Http\Requests;

class UpdateUserRequest extends Request {

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
		$rules = [
			'first_name' => 'required|min:3,max:20',
			'last_name' => 'required|min:3,max:20',
		];

		if($this->request->get('password') != null) {
			$rules['password'] = 'min:6|confirmed';
		}

		return $rules;
	}

}
