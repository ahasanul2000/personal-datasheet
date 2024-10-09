<?php

namespace App\Services;

use App\Models\Pds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PdsService implements PdsServiceInterface
{
    public function getAllPds()
    {
        return Pds::all();
    }

    public function getPdsById($id)
    {
        return Pds::find($id);
    }

    public function createPds(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $fileName);
        }

        return Pds::create([
            'email' => $request->email,
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age,
            'image' => $fileName,
        ]);
    }

    public function updatePds(Request $request, $id)
    {
        $pds = Pds::find($id);

        if (!$pds) {
            return null;
        }

        $pds->update([
            'email' => $request->email,
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age,
        ]);

        return $pds;
    }

    public function deletePds($id)
    {
        $pds = Pds::find($id);
        return $pds ? $pds->delete() : false;
    }

    public function getSoftDeletedPds()
    {
        return Pds::onlyTrashed()->get();
    }

    public function restorePds($id)
    {
        $pds = Pds::withTrashed()->find($id);
        return $pds ? $pds->restore() : false;
    }

    public function forceDeletePds($id)
    {
        $pds = Pds::withTrashed()->find($id);
        if ($pds) {
            $imagePath = public_path('images/' . $pds->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return $pds->forceDelete();
        }
        return false;
    }
}
