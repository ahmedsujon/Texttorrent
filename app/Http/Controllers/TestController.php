<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        // Fetch all contacts from your database
        $data = DB::table('number_validations')->get();

        foreach ($data as $key => $value) {
            $value->items = DB::table('number_validation_items')->where('number_validation_id', $value->id)->get();
        }

        // Return the retrieved data as a JSON response
        return response()->json($data);
    }

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
