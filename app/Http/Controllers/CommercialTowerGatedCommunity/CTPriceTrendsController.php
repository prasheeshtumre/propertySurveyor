<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{PriceTrend, Property, Tower, TowerLog};
use App\Rules\UniqueCombination;
use Illuminate\Validation\Rule;
use Validator;

class CTPriceTrendsController extends Controller
{
    public function index(Request $request)
    {
        $price_trends = PriceTrend::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $towers = Tower::where('property_id', $request->property_id)
            ->whereIn('tower_status', [1, 2, 4])
            ->get();

        $property = Property::find($request->property_id);

        if ($request->ajax() && isset($request->page)) {
            return view('admin.pages.property.commercial_tower_gated_community.price_trends.price_trends_paginate', get_defined_vars());
        }
        return view('admin.pages.property.commercial_tower_gated_community.price_trends.index', get_defined_vars());
    }

    public function store(Request $request)
    {
        // return $request->all();
        if (isset($request->tower)) {
            $rules = [
                // 'tower' => 'required_if:price_trends_type,2',
                'tower' => ['required_if:price_trends_type,2', new UniqueCombination('price_trends', ['project_status', 'tower_status', 'tower_id', 'date', 'price', 'property_id'], [$request->pt_project_status, $request->pt_tower_status, $request->tower, $request->date, $request->price, $request->property_id])],
                'date' => 'required',
                'price' => 'required|numeric',
                'status_of_project' => 'required',
            ];
        } else {
            $rules = [
                // 'tower' => 'required_if:price_trends_type,2',
                'tower' => 'required_if:price_trends_type,2',
                'date' => 'required',
                'status_of_project' => 'required',
                'price' => ['required', 'numeric', new UniqueCombination('price_trends', ['project_status', 'date', 'price', 'property_id'], [$request->pt_project_status, $request->date, $request->price, $request->property_id])],
            ];
        }

        // $rules = [
        //     'tower' => 'required_if:price_trends_type,2',
        //     'date' => 'required',
        //     'price' => 'required|numeric',
        // ];
        $messages = [
            'tower.required_if' => 'This Feild is required.',
            'date.required' => 'This Feild is required.',
            'price.required' => 'This Feild is required.',
            'status_of_project.required' => 'This Feild is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $price_trend = new PriceTrend();
        $price_trend->property_id = $request->property_id;
        $price_trend->date = $request->date;
        $price_trend->project_status = $request->pt_project_status;
        $price_trend->tower_status = $request->pt_tower_status;
        $price_trend->tower_id = $request->tower;
        $price_trend->price = $request->price;
        $price_trend->save();

        if (!isset($request->tower)) {
            $property = Property::find($request->property_id);
            $property->price = $request->price;
            $property->save();
        }

        if ($price_trend) {
            return response()->json(['status' => true, 'message' => 'Price Trends Added Successfully.'], 200);
        }
        if ($price_trend) {
            return response()->json(['status' => false], 409);
        }
    }

    public function update(Request $request)
    {
        // return $request->all();
        // return $request->all();
        $id = $request->ptid;

        if (isset($request->tower)) {
            $rules = [
                'tower' => [
                    'required_if:price_trends_type,2',
                    Rule::unique('price_trends')
                        ->ignore($id)
                        ->where(function ($query) use ($request) {
                            return $query
                                ->where('project_status', $request->pt_project_status)
                                ->where('tower_status', $request->pt_tower_status)
                                ->where('tower_id', $request->tower)
                                ->where('date', $request->date)
                                ->where('price', $request->price)
                                ->where('property_id', $request->property_id);
                        }),
                ],
                'date' => 'required',
                'price' => 'required|numeric',
                // 'status_of_project' => 'required',
            ];
        } else {
            $rules = [
                'tower' => 'required_if:price_trends_type,2',
                'date' => 'required',
                // 'status_of_project' => 'required',
                'price' => [
                    'required',
                    'numeric',
                    Rule::unique('price_trends')
                        ->ignore($id)
                        ->where(function ($query) use ($request) {
                            return $query
                                ->where('project_status', $request->pt_project_status)
                                ->where('date', $request->date)
                                ->where('price', $request->price)
                                ->where('property_id', $request->property_id);
                        }),
                ],
            ];
        }
        $messages = [
            'tower.required_if' => 'This Feild is required.',
            'date.required' => 'This Feild is required.',
            'price.required' => 'This Feild is required.',
            // 'status_of_project.required' => 'This Feild is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $price_trend = PriceTrend::find($request->ptid);
        $price_trend->property_id = $request->property_id;
        $price_trend->date = $request->date;
        $price_trend->project_status = $request->pt_project_status;
        $price_trend->tower_status = $request->pt_tower_status;
        $price_trend->tower_id = $request->tower;
        $price_trend->price = $request->price;
        $price_trend->save();

        if (!isset($request->tower)) {
            $property = Property::find($request->property_id);
            $property->price = $request->price;
            $property->save();
        }

        if ($price_trend) {
            return response()->json(['status' => true, 'message' => 'Price Trends Updated Successfully.'], 200);
        }
        if ($price_trend) {
            return response()->json(['status' => false], 409);
        }
    }
}
