<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function allContacts()
    {
        // Fetch all contacts from your database
        $contacts = DB::table('contacts')->get();

        // Return the retrieved contacts as a JSON response
        return response()->json($contacts);
    }

    public function deleteContacts()
    {
        Contact::where('id', '>=', 20)->delete();

        // Fetch all contacts from your database
        $contacts = DB::table('contacts')->get();

        // Return the retrieved contacts as a JSON response
        return response()->json($contacts);
    }
}
