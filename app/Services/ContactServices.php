<?php

namespace App\Services;

use App\Interface\ContactInterface;
use App\Models\Contact;

class ContactServices implements ContactInterface
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        $contacts = $this->contact->paginate();
        return $contacts;
    }

    public function destroy($contact_id)
    {
        $this->contact->findOrFail($contact_id)->delete();
        return true;
    }

}
