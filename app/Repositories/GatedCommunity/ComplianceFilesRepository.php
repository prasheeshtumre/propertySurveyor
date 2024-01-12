<?php

namespace App\Repositories\GatedCommunity;

use App\DTO\GatedCommunity\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};
use App\Models\{Compliances, CompliancesImages};
use Exception;
use Illuminate\Support\Facades\Auth;

class ComplianceFilesRepository implements IComplianceFilesRepository
{
    public function ghmcApprovalFile(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO)
    {
        try {
            $compliance = $this->addCompliances($ghmcApprovalFileRequestDTO, $ghmc_radio = 1, $comm_radio = 0);
            $image = $ghmcApprovalFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/compliances/ghmc/';
            $image->move(public_path() . '/uploads/compliances/ghmc/', $file_name);
            $compliancesImages = new CompliancesImages();
            $compliancesImages->comp_id = $compliance->id;
            $compliancesImages->file_type = 'ghmc';
            $compliancesImages->file_path = $path;
            $compliancesImages->file_name = $file_name;
            $compliancesImages->created_at = date('Y-m-d H:i:s');
            $compliancesImages->created_by = Auth::user()->id;
            $compliancesImages->save();
            return $compliancesImages;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function commencementCertificateFile(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO)
    {
        try {
            $compliance = $this->addCompliances($commencementCertificateFileRequestDTO, $ghmc_radio = 0, $comm_radio = 1);
            $image = $commencementCertificateFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/compliances/commenc/';
            $image->move(public_path() . '/uploads/compliances/commenc/', $file_name);
            $compliancesImages = new CompliancesImages();
            $compliancesImages->comp_id = $compliance->id;
            $compliancesImages->file_type = 'commenc';
            $compliancesImages->file_path = $path;
            $compliancesImages->file_name = $file_name;
            $compliancesImages->created_at = date('Y-m-d H:i:s');
            $compliancesImages->created_by = Auth::user()->id;
            $compliancesImages->save();
            return $compliancesImages;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function legalDocumentFiles(LegalDocumentFileRequestDTO $legalDocumentFileRequestDTO)
    {
        try {
            $compliance = $this->addCompliances($legalDocumentFileRequestDTO, $ghmc_radio = 0, $comm_radio = 0);
            $image = $legalDocumentFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/compliances/legal/';
            $image->move(public_path() . '/uploads/compliances/legal/', $file_name);
            $compliancesImages = new CompliancesImages();
            $compliancesImages->comp_id = $compliance->id;
            $compliancesImages->file_type = 'legal';
            $compliancesImages->file_path = $path;
            $compliancesImages->file_name = $file_name;
            $compliancesImages->created_at = date('Y-m-d H:i:s');
            $compliancesImages->created_by = Auth::user()->id;
            $compliancesImages->save();
            return $compliancesImages;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function reraHmdaFormSubmit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO)
    {
        try {
            $compliance = $this->addCompliances($reraHmdaFormRequestDTO, $ghmc_radio = 0, $comm_radio = 0);
            $imageReraApprovalFile = $reraHmdaFormRequestDTO->rera_approval_copy;
            $hmdaImage = $reraHmdaFormRequestDTO->hmda_file;

            if ($imageReraApprovalFile) {
                $name = $imageReraApprovalFile->getClientOriginalName();
                $file_name = uniqid() . '.' . $imageReraApprovalFile->getClientOriginalExtension();
                $path = 'uploads/compliances/rear/';
                $imageReraApprovalFile->move(public_path() . '/uploads/compliances/rear/', $file_name);
                $compliancesImages = new CompliancesImages();
                $compliancesImages->comp_id = $compliance->id;
                $compliancesImages->file_type = 'rear';
                $compliancesImages->file_path = $path;
                $compliancesImages->file_name = $file_name;
                $compliancesImages->created_at = date('Y-m-d H:i:s');
                $compliancesImages->created_by = Auth::user()->id;
                $compliancesImages->save();
                // return $compliancesImages;
            }
            if ($hmdaImage) {
                $name = $hmdaImage->getClientOriginalName();
                $file_name = uniqid() . '.' . $hmdaImage->getClientOriginalExtension();
                $path = 'uploads/compliances/hmda/';
                $hmdaImage->move(public_path() . '/uploads/compliances/hmda/', $file_name);
                $compliancesHmdaImages = new CompliancesImages();
                $compliancesHmdaImages->comp_id = $compliance->id;
                $compliancesHmdaImages->file_type = 'hmda';
                $compliancesHmdaImages->file_path = $path;
                $compliancesHmdaImages->file_name = $file_name;
                $compliancesHmdaImages->created_at = date('Y-m-d H:i:s');
                $compliancesHmdaImages->created_by = Auth::user()->id;
                $compliancesHmdaImages->save();
                // return $compliancesHmdaImages;
            }
            return $compliance;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function addCompliances($inputRequestDTO, $ghmc_radio, $comm_radio)
    {
        $occurance = Compliances::where('id', '!=', 0)
            ->where('property_id', $inputRequestDTO->property_id)
            ->first();
        $compliance_id = $occurance ? $occurance->id : 0;
        if ($compliance_id == 0) {
            $compliance = Compliances::create([
                'gis_id' => $inputRequestDTO->gis_id,
                'cat_id' => $inputRequestDTO->cat_id,
                'property_id' => $inputRequestDTO->property_id,
                'residential_type' => $inputRequestDTO->residential_type,
                'residential_sub_type' => $inputRequestDTO->residential_sub_type,
                'ghmc_radio' => $ghmc_radio,
                'comm_certifi_radio' => $comm_radio,
                'rear_number' => isset($inputRequestDTO->rear_number) ? $inputRequestDTO->rear_number : null,
                'hdma_number' => isset($inputRequestDTO->hmda_number) ? $inputRequestDTO->hmda_number : null,
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $compliance = Compliances::updateOrCreate(
                ['id' => $compliance_id],
                [
                    'gis_id' => $inputRequestDTO->gis_id,
                    'cat_id' => $inputRequestDTO->cat_id,
                    'property_id' => $inputRequestDTO->property_id,
                    'residential_type' => $inputRequestDTO->residential_type,
                    'residential_sub_type' => $inputRequestDTO->residential_sub_type,
                    'ghmc_radio' => $occurance->ghmc_radio == 1 ? 1 : $ghmc_radio,
                    'comm_certifi_radio' => $occurance->comm_certifi_radio == 1 ? 1 : $comm_radio,
                    'rear_number' => isset($inputRequestDTO->rear_number) ? $inputRequestDTO->rear_number : null,
                    'hdma_number' => isset($inputRequestDTO->hmda_number) ? $inputRequestDTO->hmda_number : null,
                    'created_by' => Auth::user()->id,
                ],
            );
        }
        return $compliance;
    }

    public function deleteFile($id)
    {
        $property_img = CompliancesImages::find($id);
        if ($property_img) {
            $fileToDelete = public_path($property_img->file_path . $property_img->file_name);

            if (file_exists($fileToDelete)) {
                if (unlink($fileToDelete)) {
                    // echo 'File deleted successfully.';
                } else {
                    // echo 'Unable to delete the file.';
                }
            } else {
                // echo 'File not found.';
            }
            $delete = CompliancesImages::destroy($id);
            return $delete;
        }
    }
}
