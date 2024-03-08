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
    // requiredは必須の意味。
    $request->validate([
      'body' => 'required',
      'email' =>'required',
      'image' =>'nullable|image',
    ]);
    $data = $request->only(['email','body']);

    $image = $request->file('image');
    if ($image) {
      // 拡張子の取得
      $image_extension = $image->getClientOriginalExtension();

      // 新しいファイル名を作る（ランダムな文字数とする）
      $image_name = uniqid() . "." . $image_extension;

      $image_path = Storage::putFileAs('public', $request->file('image'), $image_name);

      $image_url = Storage::url($image_path);

      $data['image'] = $image_url;
    } else {
      $data['image'] = null;
    } 
    return view('contact.confirm', $data);
  }

  public function send(Request $request)
  {
    // データベースにデータを保存
    $data = $request->only(['email','body','image']);
    Contact::create([
      'email' => $data['email'],
      'body' => $data['body'],
      'image' => $data['image'],
    ]);

    return view('contact.thanks', $data);
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

