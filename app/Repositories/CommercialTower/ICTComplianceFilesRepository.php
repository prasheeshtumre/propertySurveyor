<?php

namespace App\Repositories\CommercialTower;

use App\DTO\CommercialTower\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};

interface ICTComplianceFilesRepository
{
    public function ghmcApprovalFile(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO);

    public function commencementCertificateFile(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO);

    public function reraHmdaFormSubmit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO);

    public function legalDocumentFiles(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO);

    public function deleteFile($id);
}
