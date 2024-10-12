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
        try {
            $personalData = $this->pdsService->getAllPds();
            return view('pds.index', compact('personalData'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error fetching personal data: ' . $e->getMessage());
        }
    }

    public function creatPds()
    {
        try {
            return view('pds.create');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error loading create page: ' . $e->getMessage());
        }
    }

    public function viewPdsData($id)
    {
        try {
            $personalData = $this->pdsService->getPdsById($id);
            return view('pds.view', compact('personalData'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error viewing personal data: ' . $e->getMessage());
        }
    }

    public function storePdsData(PdsRequest $request)
    {
        try {
            $this->pdsService->createPds($request);
            return redirect()->route('pds')->with('success', 'Personal Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function editPds($id)
    {
        try {
            $personalData = $this->pdsService->getPdsById($id);
            return view('pds.edit', compact('personalData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updatesPds(PdsRequest $request)
    {
        try {
            $target = $this->pdsService->getPdsById($request->id);

            if (!$target) {
                return redirect()->back()->with('error', 'PDS not found');
            }
            $this->pdsService->updatePds($request, $target->id);

            return redirect()->route('pds')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function deletePds($id)
    {
        try {
            $this->pdsService->deletePds($id);
            return redirect()->route('pds')->with('success', 'PDS deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function softDeleted()
    {
        try {
            $pds = $this->pdsService->getSoftDeletedPds();
            return view('pds.softdelete', compact('pds'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $this->pdsService->restorePds($id);
            return redirect()->route('softDeleted')->with('success', 'Record restored successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $this->pdsService->forceDeletePds($id);
            return redirect()->route('softDeleted')->with('success', 'Record permanently deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
