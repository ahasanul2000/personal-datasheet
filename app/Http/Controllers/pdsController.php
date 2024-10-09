<?php

namespace App\Http\Controllers;

use App\Services\PdsServiceInterface;
use App\Http\Requests\PdsRequest;
use App\Models\Pds;
use Illuminate\Http\Request;

class PdsController extends Controller
{
    protected $pdsService;

    public function __construct(PdsServiceInterface $pdsService)
    {
        $this->pdsService = $pdsService;
    }

    public function pds()
    {
        $personalData = $this->pdsService->getAllPds();
        return view('pds.index', compact('personalData'));
    }

    public function creatPds()
    {
        return view('pds.create');
    }

    public function viewPdsData($id)
    {
        $personalData = $this->pdsService->getPdsById($id);
        return view('pds.view', compact('personalData'));
    }

    public function storePdsData(PdsRequest $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $fileName);
            }
            Pds::create(array_merge($request->validated(), ['image' => $fileName]));

            return redirect()->route('pds')->with('success', 'Personal Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function editPds($id)
    {
        $personalData = $this->pdsService->getPdsById($id);
        return view('pds.edit', compact('personalData'));
    }

    public function updatePds(PdsRequest $request)
    {
        try {
            $target = Pds::findOrFail($request->id);

            if ($request->hasFile('image')) {

                if ($target->image) {
                    $oldImagePath = public_path('images/' . $target->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $fileName);
                $target->image = $fileName;
            }

            $target->update($request->validated());

            return redirect()->route('pds')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deletePds($id)
    {
        $this->pdsService->deletePds($id);
        return redirect()->route('pds')->with('success', 'PDS deleted successfully');
    }

    public function softDeleted()
    {
        $pds = $this->pdsService->getSoftDeletedPds();
        return view('pds.softdelete', compact('pds'));
    }

    public function restore($id)
    {
        $this->pdsService->restorePds($id);
        return redirect()->route('softDeleted')->with('success', 'Record restored successfully');
    }

    public function forceDelete($id)
    {
        $this->pdsService->forceDeletePds($id);
        return redirect()->route('softDeleted')->with('success', 'Record permanently deleted');
    }
}
