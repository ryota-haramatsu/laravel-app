<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

// CreateTaskを継承していることに注意
class EditTask extends CreateTask
{
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        // TaskのSTATUS配列のlabelをマップで取り出して変数に格納
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        // implode関数で”、”をつけて表示した文字列を格納
        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
