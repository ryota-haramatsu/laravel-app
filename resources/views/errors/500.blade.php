@extends('common.layout')
@section('title', '500 Error')
@section('content')
<div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div class="text-center">
          <p>申し訳ございません。Webサイトはこのページを表示できません。</p>
          <a href="{{ route('home') }}" class="btn">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
</div>
@endsection
@section('footer')
    @parent
@endsection

