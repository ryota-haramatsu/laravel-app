@extends('common.layout')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
        <div class="panel-heading">フォルダを追加する</div>
        <div class="panel-body">
            <!-- Error validation -->
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                    <div>{{ $message }}</div>
                @endforeach
            </div>
            @endif
            <!-- Form -->
            <form action="{{ route('folders.create') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">フォルダ名</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
            </form>
        </div>
        </nav>
    </div>
</div>
@endsection
@section('footer')
    @parent
    

@endsection

