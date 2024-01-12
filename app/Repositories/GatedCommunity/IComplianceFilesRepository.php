<?php

namespace App\Repositories\GatedCommunity;

use App\DTO\GatedCommunity\Compliances\CommencementCertificateFileRequestDTO;
use App\DTO\GatedCommunity\Compliances\GHMCApprovalFileRequestDTO;
use App\DTO\GatedCommunity\Compliances\LegalDocumentFileRequestDTO;
use App\DTO\GatedCommunity\Compliances\ReraHmdaFormRequestDTO;

interface IComplianceFilesRepository
{
    public function ghmcApprovalFile(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO);
    
    public function commencementCertificateFile(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO);

    public function reraHmdaFormSubmit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO);
    
    public function legalDocumentFiles(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO);

    public function deleteFile($id);

}
