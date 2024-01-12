<?php

namespace App\Services\GatedCommunity;

use App\DTO\GatedCommunity\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};
use App\Repositories\GatedCommunity\IComplianceFilesRepository;

class CompliancesFileService
{
    private $compliancesFileServiceRepository;

    public function __construct(IComplianceFilesRepository $compliancesFileServiceRepository)
    {
        $this->compliancesFileServiceRepository = $compliancesFileServiceRepository;
    }

    public function ghmcApprovalFile(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO)
    {
        return $this->compliancesFileServiceRepository->ghmcApprovalFile($ghmcApprovalFileRequestDTO);
    }

    public function commencementCertificateFile(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO)
    {
        return $this->compliancesFileServiceRepository->commencementCertificateFile($commencementCertificateFileRequestDTO);
    }
    public function reraHmdaFormSubmit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO)
    {
        return $this->compliancesFileServiceRepository->reraHmdaFormSubmit($reraHmdaFormRequestDTO);
    }
    public function legalDocumentFiles(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO)
    {
        return $this->compliancesFileServiceRepository->legalDocumentFiles($legalDocumentFileRequestDTO);
    }

    public function deleteFile($id)
    {
        return $this->compliancesFileServiceRepository->deleteFile($id);
    }
}
