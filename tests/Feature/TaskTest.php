<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\Feature\Session;

class TaskTest extends TestCase
{
    // テストケースごとにDBをリフレッシュしてマイグレートを実行
    // use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();


        // $this->seed('FoldersTableSeeder');
        // $this->seed('TasksTableSeeder');
    }    

    /**
     * 期限日が日付でない時にバリエーションエラーを出すかどうか
     * @test
     */
    public function 期限日が日付でない時にバリエーションエラー()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, //不正なデータ
        ]);

        // アサーション 
        $response->assertSessionHasErrors([
            'due_date' => '期限日には日付を入力してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */
    public function 期限日が過去日付の場合はバリデーションエラー()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), //不正なデータ
        ]);
        
        // アサーション
        $response->assertSessionHasErrors([
            'due_date' => '期限日には今日以降の日付を入力してください。',
        ]);
    }

    /**
  * 状態が定義された値ではない場合はバリデーションエラー
  * @test
  */
    public function status_should_be_within_defined_numbers()
    {
    // $this->seed('TasksTableSeeder'); 

    $response = $this->post('/folders/1/tasks/1/edit', [
        'title' => 'Sample task',
        'due_date' => Carbon::today()->format('Y/m/d'),
        'status' => 999,
    ]);

    $response->assertSessionHasErrors([
        // 'status' => '状態には未着手、着手中、完了のいずれかを指定してください。',
        'status' => '状態には未着手、着手中、完了のいずれかを指定してください。'
    ]);
    }
    
}
