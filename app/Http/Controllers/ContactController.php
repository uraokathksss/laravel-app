<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use App\Models\Contact;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact.index');
  }

  public function confirm(Request $request)
  {

    // バリデーションのメソッドを作る。
    $request->validate([
      'body' => 'required',
      'email' =>'required',
     // requiredは必須の意味。
    ]);
    $data = $request->only(['email','body','image']);
    $image = $request->file('image');
    if ($image) {
      // 拡張子の取得
      $extension = $image->getClientOriginalExtension();

      // 新しいファイル名を作る（ランダムな文字数とする）
      $new_name = uniqid() . "." . $extension;

      // 一時的にtmpフォルダに保存する
      $image_path = Storage::putFileAs(
          'public/tmp', $request->file('image'), $new_name
      );
      dump($image_path);
    }else {
      $new_name = 'noimage.jpg';
      $extension = '0';
      $image_path = 'noimage.jpg';
    }
    return view('contact.confirm',$data,compact('image_path','extension'));
  }

  public function send(Request $request)
  {
    $attributes = $request->only(['email','body','image']);
    $data = $request->only(['email']);
    Contact::create($attributes);
    return view('contact.thanks',$data,);


    DB::beginTransaction();
    $data = profile::create([  
          "name" => $request->name,  
        "extension" => $request->extension,  
    ]);
    DB::commit();

    // 新しいファイル名を作る
    // この場合、IDをファイル名にしている↓
    $new_name = $data->id . '.' . $request->extension;

    if($request->image_path == 'noimage.jpg'){
        // ノーイメージ画像をコピーして、ユーザー毎の画像を用意する場合はこのコード↓
        // Storage::copy($request->image_path, 'img/'.$new_name);

        // 後々、Webサイトの改装時にノーイメージ画像を変更したい場合があるので、
        // 各ユーザー毎にノーイメージ画像を量産すると地獄を見るのでおすすめできません
        // 今回の場合、DBの「拡張子」カラムに「0」が登録されるように作ったので、
        // 拡張子が0ならノーイメージ画像を表示判定ができる仕様にしてみました
    } else {
        // 一時保存のtmpから本番の格納場所imgへ移動
        Storage::move($request->image_path, 'img/'.$new_name);
    }

    return view('image_upload_complete');

    //  catch (\Exception $e) {
    //   DB::rollback();
    //   Log::error($e);
    //   print_r('エラーが発生しました。');
    //   exit;
    // }
  }

  protected $contact_repository;

  public function __construct(ContactRepository $contact_repository)
  {
    $this->contact_repository = $contact_repository;
  }

  public function list()
  {
  $contact_list = $this->contact_repository->getContactList();
  return view('contact.list',['contact_list'=>$contact_list]);
  }

  public function detail($id)
  {
    $contact=Contact::find($id);
    return view('contact.detail',['contact'=>$contact]);
  }

  public function delete($id)
  {
    $contact=Contact::find($id);
    $contact->delete();
    $contact_list = $this->contact_repository->getContactList();
    return redirect(route('contact.list',['contact_list'=>$contact_list]));
  }
}

