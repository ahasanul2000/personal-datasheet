<?php

namespace App\Http\Controllers;

use App\Models\Pds;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class pdsController extends Controller
{


    public function pds()
    {
        $personalData = Pds::all();
        // dd($personalData);
        return view('pds.index', compact('personalData'));
    }
    public function creatPds()
    {
        return view('pds.create');
    }
    public function viewPdsData($id)
    {
        $personalData = Pds::where('id', $id)->first();

        // dd($Data);
        return view('pds.view', compact('personalData'));
    }
    public function storePdsData(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email|unique:pds,email',
                'fullName' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'age' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $messages = [
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'email.unique' => 'Email must be unique',
                'fullName.required' => 'Full Name is required',
                'phone.required' => 'Phone number is required',
                'address.required' => 'Address is required',
                'age.required' => 'Age is required',
                'age.integer' => 'Age must be an integer',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fileName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $fileName);
            }

            $target = new Pds;
            $target->email = $request->email;
            $target->fullName = $request->fullName;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->age = $request->age;
            $target->image = $fileName;
            $target->save();

            return redirect()->route('pds')->with('success', 'Personal Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editPds($id)
    {
        $personalData = Pds::find($id);

        return view('pds.edit', compact('personalData'));
    }


    public function updatePds(Request $request)
    {
        try {
            $target = Pds::find($request->id);

            if (!$target) {
                return redirect()->back()->with('error', 'Record not found.');
            }

            $rules = [
                'email' => 'required|email|unique:pds,email,' . $request->id,
                'fullName' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'age' => 'required|integer',
            ];

            $messages = [
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'email.unique' => 'Email must be unique',
                'fullName.required' => 'Full Name is required',
                'phone.required' => 'Phone number is required',
                'address.required' => 'Address is required',
                'age.required' => 'Age is required',
                'age.integer' => 'Age must be an integer',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $target->email = $request->email;
            $target->fullName = $request->fullName;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->age = $request->age;
            $target->save();

            return redirect()->route('pds')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            \Log::error($e);


            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deletePds($id)
    {
        try {
            $pds = Pds::find($id);
            // $imagePath = public_path('images/' . $pds->image);

            // if (file_exists($imagePath)) {
            //     unlink($imagePath);
            // }
            $pds->delete();

            return redirect()->route('pds')->with('success', 'Branch deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    // ///////////// softDelete


    // List all soft deleted PDS records
    public function softDeleted()
    {
        $pds = Pds::onlyTrashed()->get(); // Get only soft-deleted records
        return view('pds.softdelete', compact('pds'));
    }

    // Restore a soft-deleted PDS record
    public function restore($id)
    {
        $pds = Pds::withTrashed()->find($id);
        if ($pds) {
            $pds->restore();
            return redirect()->route('softDeleted')->with('success', 'Record restored successfully.');
        }
        return redirect()->route('softDeleted')->with('error', 'Record not found.');
    }

    // Permanently delete a soft-deleted PDS record
    public function forceDelete($id)
    {
        $pds = Pds::withTrashed()->find($id);
        if ($pds) {
            $imagePath = public_path('images/' . $pds->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $pds->forceDelete();
            return redirect()->route('softDeleted')->with('success', 'Record permanently deleted successfully.');
        }
        return redirect()->route('softDeleted')->with('error', 'Record not found.');
    }
}
