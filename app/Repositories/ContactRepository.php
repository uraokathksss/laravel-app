<?php

namespace App\Repositories;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
  public function getContactList()
  {
    $contact = Contact::all();
    return $contact;
  }
}