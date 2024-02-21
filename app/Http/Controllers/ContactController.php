<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\ContactRepository;
use App\Models\Contact;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact.index');
  }
  public function confirm(Request $request)
  // {
  //   // バリデーションのメソッドを作る。
  //   $request->validate([
      'body' => 'required',
      'email' =>'required',
  //     // 'email' => 'required|regex:/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)+$/',
  //     // requiredは必須の意味。
  //   ]);
  //   $data = $request->only(['email','body']);
  //   return view('contact.confirm',$data);
  // }

  public function send(Request $request)
  {
    $attributes = $request->only(['email','body']);
    Contact::create($attributes);
    $data = $request->only(['email']);
    return view('contact.thanks',$data);
  }
  // protected $contact_repository;
  // public function __construct(ContactRepository$contact_repository)
  // {
  //   $this->contact_repository = $contact_repository;
  // }
}
