@extends('common.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
          <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
            フォルダを追加する
          </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" 
                 class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        @component('common.tasks')
          @slot('to_tasks_create')
            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
              タスクを追加する
            </a>
          @endslot
          @foreach($tasks as $task)
          <tr>
            <td>{{ $task->title }}</td>
            <td>
              <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
            </td>
            <td>{{ $task->formatted_due_date }}</td>
            <td>
              <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">編集</a>
            </td>
          </tr>
          @endforeach
        @endcomponent
      </div>
    </div>
@endsection
@section('footer')
    @parent
    <!-- script -->
@endsection

