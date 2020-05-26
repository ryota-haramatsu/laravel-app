<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Task;
use Carbon\Carbon;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        // if (Auth::user()->id !== $folder->user_id){
        //     abort(403);
        // }
        $folders = Auth::user()->folders()->get();

        // $current_folder = Folder::find($folder);

        // if(is_null($current_folder)){
        //     abort(404);
        // }

        $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks
        ]);
    }

    /**
     *  タスク作成フォーム
     *  @param Folder $folder
     *  @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        // urlのidと一致するFolderのidをDBから取得
        // $current_folder = Folder::find($folder);


        $task = new Task;
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        
        // $current_folder->tasks()->save($task);
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            // 'id' => $current_folder->id,
            'id' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        // $task = Task::find($task_id);
        // $this->checkRelation($folder, $task);//folderとtaskのリレーションをチェック
        
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        // $task = Task::find($task_id);

        $this->checkRelation($folder, $task); //folderとtaskのリレーションをチェック

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
