<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\DTO\CommercialTower\Compliances\{CommencementCertificateFileRequestDTO, GHMCApprovalFileRequestDTO, LegalDocumentFileRequestDTO, ReraHmdaFormRequestDTO};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Compliances, CompliancesImages, Property};
use App\Services\CommercialTower\CTCompliancesFileService;
use File;
use Validator;
use Auth;

class CTCompliancesController extends Controller
{
    public $ctCompliancesFileService;
    public function __construct(CTCompliancesFileService $ctCompliancesFileService)
    {
        $this->ctCompliancesFileService = $ctCompliancesFileService;
    }
    public function compliances(Request $request)
    {
        // property_id
        $compliances = Compliances::where('property_id', $request->property_id)->first();
        $property = Property::where('id', $request->property_id)->first();
        $files = $file_name = $file_id = null;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($compliances->images)) {
            foreach ($compliances->images as $key => $image) {
                $files[$image->file_type][$key] = asset($image->file_path . $image->file_name);
                $file_name[$image->file_type][$key] = $image->file_name;
                $file_id[$image->file_type][$key] = $image->id;
            }
        }

        return view('admin.pages.property.commercial_tower_gated_community.compliances.index', get_defined_vars());
    }

    public function store_compliances(Request $request)
    {
        // dd($request->all());
        // Validate the form data

        $add_validation_rules = [
            'ghmc_radio' => 'required|in:1,0',
            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'comm_radio' => 'required|in:1,0',
            'commenc_file' => 'required_if:comm_radio,1',
            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            //'rear_number' => 'required',
            //'rear_file' => 'required',
            //'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
            //'hmda_number' => 'required',
            //'hmda_file' => 'required',
            //'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
            //'legal_files' => 'required',
            //'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
        ];
        $add_messages = [
            'ghmc_radio.required' => 'The GHMC Approval field is required.',
            'comm_radio.required' => 'The Commencement Certificate field is required.',
            'ghmc_approval_file.required_if' => 'The GHMC Approval Copy file is required.',
            'commenc_file.required_if' => 'The Commencement Certificate file field is required.',
            'ghmc_approval_file.*.mimes' => 'The GHMC Approval Copy must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            'commenc_file.*.mimes' => 'The Commencement Certificate must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            'rear_file.*.mimes' => 'The RERA Approval must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            'hmda_file.*.mimes' => 'The DTCP/HMDA Approval must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            'legal_files.*.mimes' => 'The legal Documents must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
        ];

        $occurance = Compliances::where('id', '!=', 0)
            ->where('property_id', $request->property_id)
            ->first();
        if ($occurance) {
            if ($request->ghmc_radio == 1) {
                $ghmc_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'ghmc')
                    ->count();
                $commec_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'commenc')
                    ->count();
                if ($request->comm_radio == 1) {
                    if ($ghmc_files == 0 && $commec_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'commenc_file' => 'required_if:comm_radio,1',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } elseif ($commec_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'commenc_file' => 'required_if:comm_radio,1',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } elseif ($ghmc_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } else {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    }
                } else {
                    if ($ghmc_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } else {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    }
                }
            } elseif ($request->comm_radio == 1) {
                $commec_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'commenc')
                    ->count();

                if ($commec_files == 0) {
                    $update_validation_rules = [
                        'ghmc_radio' => 'required|in:1,0',
                        'comm_radio' => 'required|in:1,0',
                        'commenc_file' => 'required_if:comm_radio,1',
                        'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    ];
                } else {
                    $update_validation_rules = [
                        'ghmc_radio' => 'required|in:1,0',
                        'comm_radio' => 'required|in:1,0',
                        'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    ];
                }
            } else {
                $update_validation_rules = [
                    'ghmc_radio' => 'required|in:1,0',
                    'comm_radio' => 'required|in:1,0',
                    'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                ];
            }
        }
        $compliance_id = $occurance ? $occurance->id : 0;

        if ($compliance_id == 0) {
            $validator = Validator::make($request->all(), $add_validation_rules, $add_messages);
        } else {
            $validator = Validator::make($request->all(), $update_validation_rules, $add_messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // exit();

        // Process and store the form data

        // dd($compliance_id);
        if ($compliance_id == 0) {
            $compliance = Compliances::create([
                'gis_id' => $request->input('gis_id'),
                'cat_id' => $request->input('cat_id'),
                'property_id' => $request->input('property_id'),
                'residential_type' => $request->input('residential_type'),
                'residential_sub_type' => $request->input('residential_sub_type'),
                'ghmc_radio' => $request->input('ghmc_radio'),
                'comm_certifi_radio' => $request->input('comm_radio'),
                'rear_number' => isset($request->rear_number) ? $request->rear_number : null,
                'hdma_number' => $request->input('hmda_number'),
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $compliance = Compliances::updateOrCreate(
                ['id' => $compliance_id],
                [
                    'gis_id' => $request->input('gis_id'),
                    'cat_id' => $request->input('cat_id'),
                    'property_id' => $request->input('property_id'),
                    'residential_type' => $request->input('residential_type'),
                    'residential_sub_type' => $request->input('residential_sub_type'),
                    'ghmc_radio' => $request->input('ghmc_radio'),
                    'comm_certifi_radio' => $request->input('comm_radio'),
                    'rear_number' => isset($request->rear_number) ? $request->rear_number : null,
                    'hdma_number' => $request->input('hmda_number'),
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        // Store GHMC approval files
        if ($request->hasFile('ghmc_approval_file')) {
            foreach ($request->file('ghmc_approval_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/ghmc/';
                // $image->move(public_path() .$path, $file_name);
                $image->move(public_path() . '/uploads/compliances/ghmc/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'ghmc';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        if (isset($request->ghmc_file_id)) {
            if ($request->ghmc_radio == 0) {
                foreach ($request->ghmc_file_id as $key => $id) {
                    // return public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]);
                    if (File::exists(public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]))) {
                        File::delete(public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]));
                        $delete = CompliancesImages::where('id', $id)->delete();
                    }
                }
            }
        }

        // Store Commencement Certificate files
        if ($request->hasFile('commenc_file')) {
            foreach ($request->file('commenc_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/commenc/';
                $image->move(public_path() . '/uploads/compliances/commenc/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'commenc';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        if (isset($request->commenc_file_id)) {
            if ($request->comm_radio == 0) {
                foreach ($request->commenc_file_id as $key => $id) {
                    if (File::exists(public_path('/uploads/compliances/commenc/' . $request->commenc_old_file[$key]))) {
                        File::delete(public_path('/uploads/compliances/commenc/' . $request->commenc_old_file[$key]));
                        $delete = CompliancesImages::where('id', $id)->delete();
                    }
                }
            }
        }

        // Store RERA Approval files
        if ($request->hasFile('rear_file')) {
            foreach ($request->file('rear_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/rear/';
                $image->move(public_path() . '/uploads/compliances/rear/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'rear';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        // Store DTCP/HMDA Approval files
        if ($request->hasFile('hmda_file')) {
            foreach ($request->file('hmda_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/hmda/';
                $image->move(public_path() . '/uploads/compliances/hmda/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'hmda';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        // Store Legal Document files
        if ($request->hasFile('legal_files')) {
            foreach ($request->file('legal_files') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/legal/';
                $image->move(public_path() . '/uploads/compliances/legal/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'legal';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        return response()->json(['message' => 'Compliance data saved successfully', 'comp_id' => $compliance->id], 200);
    }

    public function ghmc_approval_files(GHMCApprovalFileRequestDTO $ghmcApprovalFileRequestDTO)
    {
        try {
            $ghmcApprovalFile = $this->ctCompliancesFileService->ghmcApprovalFile($ghmcApprovalFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $ghmcApprovalFile['id'], 'remove_url' => route('commercial-tower.compliances.destroy', $ghmcApprovalFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function commencement_certificate_files(CommencementCertificateFileRequestDTO $commencementCertificateFileRequestDTO)
    {
        try {
            $commencementCertificateFile = $this->ctCompliancesFileService->commencementCertificateFile($commencementCertificateFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $commencementCertificateFile['id'], 'remove_url' => route('commercial-tower.compliances.destroy', $commencementCertificateFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function rera_hmda_form_submit(ReraHmdaFormRequestDTO $reraHmdaFormRequestDTO)
    {
        try {
            $reraHmdaFormSubmit = $this->ctCompliancesFileService->reraHmdaFormSubmit($reraHmdaFormRequestDTO);
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
            $legalDocumentFile = $this->ctCompliancesFileService->legalDocumentFiles($legalDocumentFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $legalDocumentFile['id'], 'remove_url' => route('commercial-tower.compliances.destroy', $legalDocumentFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $deleteFile = $this->ctCompliancesFileService->deleteFile($id);
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
