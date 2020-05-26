<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Task extends Model
{
     /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '未着手',  'color' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'color' => 'label-info' ],
        3 => [ 'label' => '完了', 'color' => ''],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];
        
        if(!isset(self::STATUS[$status])){
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 状態を表すHTMLクラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])){
            return '';
        }

        return self::STATUS[$status]['color'];
    }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        $status = $this->attributes['due_date'];

        return Carbon::createFromFormat('Y-m-d', $status)->format('Y/m/d');
    }

}
