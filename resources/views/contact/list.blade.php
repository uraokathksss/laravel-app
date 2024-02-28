<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ一覧</title>
    <style>
      .table {
        width: 100%;
        border: 1px solid gray;
      }
      th,td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2
      }
    </style>
  </head>

  <body>
    <h1>お問い合わせ一覧</h1>
    <table class="table">
      <tr>
        <th>メールアドレス</th>
        <th>お問い合わせ内容</th>
        <th>詳細ページ</th>
      </tr>
      @foreach ($contact_list as $contact)
      <tr>
        <td>{{$contact->email}}</td>
        <td>{{$contact->body}}</td>
        <td><a href="{{route('contact.detail',$contact->id)}}"><button>詳細</button></a></td>
      </tr>
      @endforeach
    </table>
  </body>
</html>