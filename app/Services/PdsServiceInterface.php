<?php

namespace App\Services;

use Illuminate\Http\Request;

interface PdsServiceInterface
{
    public function getAllPds();
    public function getPdsById($id);
    public function createPds(Request $request);
    public function updatePds(Request $request, $id);
    public function deletePds($id);
    public function getSoftDeletedPds();
    public function restorePds($id);
    public function forceDeletePds($id);
}
