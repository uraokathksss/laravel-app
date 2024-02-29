@extends('layouts.body')

@section('content')

<div class="contact">
  <h1>お問い合わせフォーム</h1>
  <div class="step">
    <div class="step_bar complete">お問い合わせ内容の入力</div>
    <div class="step_bar complete">入力内容の確認</div>
    <div class="step_bar current">送信完了</div>
  </div>
  <h2>お問い合わせを受け付けました</h2>
  <p>
    受付が完了しました。<br>
    {{$email}}
  </p>
  <div class="link">
    <a href="{{route('contact.index')}}">TOPに戻る</a>
  </div>
  <div class="link">
    <img src="{{ asset($post->image)}}" width="100px">
  </div>
</div>
@endsection