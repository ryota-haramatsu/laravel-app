<div class="panel panel-default">
  <div class="panel-heading">タスク</div>
  <div class="panel-body">
    <div class="text-right">
      {{ $to_tasks_create }}
    </div>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>タイトル</th>
      <th>状態</th>
      <th>期限</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
  </table>
</div>