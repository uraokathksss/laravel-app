@extends('layouts.body')

@section('content')


<div class="contact">
  <h1>お問い合わせフォーム</h1>
  <div class="step">
    <div class="step_bar complete">お問い合わせ内容の入力</div>
    <div class="step_bar current">入力内容の確認</div>
    <div class="step_bar">送信完了</div>
  </div>
  <form method="POST" action="{{ route('contact.send')}}">
    @csrf
    <h2>メールアドレスを確認してください</h2>
    <div class="form">
      <div class="form_input">
        メールアドレス
      </div>
      <div class="form_input with_border">
        <input type="hidden" name="email" value="{{$email}}">
        {{ $email }}
      </div>
    </div>
    <h2>お問い合わせ内容を確認してください</h2>
    <div class="form">
      <div class="form_title">
        お問い合わせ内容
      </div>
      <div class="form_input with_border">
        <input type="hidden" name="body" value="{{$body}}">
        {{$body}}
      </div>
    </div>
    <div class="submit">
      <input type=submit value="入力内容を送信する">
    </div>
    <img src="./../storage/app/{{ $image_path }}" alt="" width="40%">
    <input type="hidden" name="image_path" value="{{ $image_path }}">
    <input type="hidden" name="extension" value="{{ $extension }}">
  </form>
</div>
@endsection