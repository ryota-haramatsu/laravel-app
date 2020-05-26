@extends('common.layout')
@section('title', 'Home')
@section('content')
<div class="row">
    <div class="col col-md-offset-3 col-md-6">
    <nav class="panel panel-default">
        <div class="panel-heading">
        まずはフォルダを作成しましょう
        </div>
        <div class="panel-body">
        <div class="text-center">
            <a href="{{ route('folders.create') }}" class="btn btn-primary">
            フォルダ作成ページへ
            </a>
        </div>
        </div>
    </nav>
    </div>
</div>
@endsection
@section('footer')
    @parent
    <!-- script -->
@endsection

