<?php

namespace App\Http\Controllers\GatedCommunity;

use App\DTO\GatedCommunity\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};
use App\Http\Controllers\Controller;
use App\Services\GatedCommunity\CompliancesFileService;

class CompliancesController extends Controller
{
    public $compliancesFileService;
    public function __construct(CompliancesFileService $compliancesFileService)
    {
        $this->compliancesFileService = $compliancesFileService;
    }
    public function ghmc_approval_files(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO)
    {
        try {
            $ghmcApprovalFile = $this->compliancesFileService->ghmcApprovalFile($ghmcApprovalFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $ghmcApprovalFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/compliances/destroy/' . $ghmcApprovalFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function commencement_certificate_files(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO)
    {
        try {
            $commencementCertificateFile = $this->compliancesFileService->commencementCertificateFile($commencementCertificateFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $commencementCertificateFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/compliances/destroy/' . $commencementCertificateFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function rera_hmda_form_submit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO)
    {
        try {
            $reraHmdaFormSubmit = $this->compliancesFileService->reraHmdaFormSubmit($reraHmdaFormRequestDTO);
            return response()->json(['message' => 'Compliance data saved successfully', 'comp_id' => $reraHmdaFormSubmit->id], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function legal_document_files(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO)
    {
        try {
            $legalDocumentFile = $this->compliancesFileService->legalDocumentFiles($legalDocumentFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $legalDocumentFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/compliances/destroy/' . $legalDocumentFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $deleteFile = $this->compliancesFileService->deleteFile($id);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Compliances image Deleted Successfully',
                ],
                200,
            );
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }
}
