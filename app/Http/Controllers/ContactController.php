<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Interface\ContactInterface;
use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{

    private $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;

        $this->middleware('permission:contact us-read|contact-create|contact-update|contact us-delete', ['only' => ['index']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = Contact::filter()->paginate();
        return view('contacts.index', compact('results'));
    }

    public function destroy($contact_id)
    {
        $this->contact->destroy($contact_id);
        return back()->with('success',  __('Contact deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        DeleteRow::helperDeleteSelectedRows(Contact::class,$request->input('selectedRows'));
        return back()->with('success',  __('Contact deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('Name'),
            __('Email'),
            __('Phone'),
            __('Subject'),
            __('Message'),
            __('Created At')

        ];
        $data = Contact::select( 'name', 'email', 'phone', 'subject', 'message', 'created_at')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Contact.csv');
    }

}
