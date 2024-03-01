<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use App\Models\Contact;
use App\Image;

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
    $image->storeAs('public/', 'test.jpg');
    $image = Image::create([
      'image' => $image,
    ]);
    return view('contact.confirm',$data);
  }

  public function send(Request $request)
  {
    $attributes = $request->only(['email','body','image']);
    $data = $request->only(['email']);
    return view('contact.thanks',$data,);
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

