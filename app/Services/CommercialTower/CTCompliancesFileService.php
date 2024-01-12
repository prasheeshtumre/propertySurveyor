<?php

namespace App\Services\CommercialTower;

use App\DTO\CommercialTower\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};
use App\Repositories\CommercialTower\ICTComplianceFilesRepository;

class CTCompliancesFileService
{
    private $ctCompliancesFileServiceRepository;

    public function __construct(ICTComplianceFilesRepository $ctCompliancesFileServiceRepository)
    {
        $this->ctCompliancesFileServiceRepository = $ctCompliancesFileServiceRepository;
    }

    public function ghmcApprovalFile(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO)
    {
        return $this->ctCompliancesFileServiceRepository->ghmcApprovalFile($ghmcApprovalFileRequestDTO);
    }

    public function commencementCertificateFile(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO)
    {
        return $this->ctCompliancesFileServiceRepository->commencementCertificateFile($commencementCertificateFileRequestDTO);
    }
    public function reraHmdaFormSubmit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO)
    {
        return $this->ctCompliancesFileServiceRepository->reraHmdaFormSubmit($reraHmdaFormRequestDTO);
    }
    public function legalDocumentFiles(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO)
    {
        return $this->ctCompliancesFileServiceRepository->legalDocumentFiles($legalDocumentFileRequestDTO);
    }
    public function deleteFile($id)
    {
        return $this->ctCompliancesFileServiceRepository->deleteFile($id);
    }
}
