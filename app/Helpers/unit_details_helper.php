<?php

use App\Models\{FloorUnitMap, Unit, UnitAmenityOptionValue, UnitPriceLog};

if (!function_exists('saveUnitPriceLog')) {
    function saveUnitPriceLog($property_id, $unit_id, $pricing_details_for, $price, $date, $sqft = 0, $area_type = 0, $sale_status = 0)
    {
        // 5 - price changed (sale, rent, rented, sold after changing price for second time)
        // 6 - re-listed for rent (changing from rented to rent )
        // 7 - re-listed for sale (changing from sold to sale )

        $old_log = UnitPriceLog::where('property_id', $property_id)
            ->where('unit_id', $unit_id)
            ->latest()
            ->first();
        if ($old_log) {
            // dd($old_log->pricing_details_for, $pricing_details_for);

            if ($old_log->price != $price) {
                // dd($old_log->pricing_details_for);
                if ($old_log->pricing_details_for == config('constants.FOR_SALE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_SALE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.SOLD') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 7;
                } elseif ($old_log->pricing_details_for == config('constants.SOLD') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 7;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_SALE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_SALE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_RENT') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_RENT') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                } elseif ($old_log->pricing_details_for == config('constants.RENTED') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 6;
                } elseif ($old_log->pricing_details_for == config('constants.RENTED') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 6;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_RENT') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 5;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_RENT') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                }
            } else {
                if ($old_log->pricing_details_for == config('constants.FOR_SALE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 1;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_SALE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.SOLD') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 7;
                } elseif ($old_log->pricing_details_for == config('constants.SOLD') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 7;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_SALE') && $pricing_details_for == config('constants.FOR_SALE')) {
                    $pricing_details_for = 7;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_SALE') && $pricing_details_for == config('constants.SOLD')) {
                    $pricing_details_for = 4;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_RENT') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 2;
                } elseif ($old_log->pricing_details_for == config('constants.FOR_RENT') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                } elseif ($old_log->pricing_details_for == config('constants.RENTED') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 6;
                } elseif ($old_log->pricing_details_for == config('constants.RENTED') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 6;
                } elseif ($old_log->pricing_details_for == config('constants.PRICE_CHANGE') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_RENT') && $pricing_details_for == config('constants.FOR_RENT')) {
                    $pricing_details_for = 6;
                } elseif ($old_log->pricing_details_for == config('constants.RELISTED_RENT') && $pricing_details_for == config('constants.RENTED')) {
                    $pricing_details_for = 3;
                }
            }
        }
        // dd($pricing_details_for);
        // dd($old_log->pricing_details_for, $pricing_details_for, $old_log->price,$price);

        if ($old_log) {
            if ($old_log->price != $price || $old_log->pricing_details_for != $pricing_details_for || $old_log->sale_status != $sale_status) {
                $savePriceLogs = UnitPriceLog::create([
                    'property_id' => $property_id,
                    'unit_id' => $unit_id,
                    'pricing_details_for' => $pricing_details_for,
                    'price' => $price,
                    'date' => $date,
                    'sqft' => $sqft,
                    'area_type' => isset($area_type) ? $area_type : 1,
                    'sale_status' => $sale_status,
                ]);
            }
        } else {
            $savePriceLogs = UnitPriceLog::create([
                'property_id' => $property_id,
                'unit_id' => $unit_id,
                'pricing_details_for' => $pricing_details_for,
                'price' => $price,
                'date' => $date,
                'sqft' => $sqft,
                'area_type' => isset($area_type) ? $area_type : 1,
                'sale_status' => $sale_status,
            ]);
        }
    }
}

if (!function_exists('updateSaleRent')) {
    function updateSaleRent($property_id, $unit_id, $pricing_details_for)
    {
        if ($pricing_details_for == config('constants.FOR_SALE')) {
            $update_sales = FloorUnitMap::where('property_id', $property_id)
                ->where('id', $unit_id)
                ->update([
                    'up_for_sale' => 1,
                    'up_for_rent' => 0,
                    'rented' => 0,
                    'sold' => 0,
                ]);
        }

        if ($pricing_details_for == config('constants.FOR_RENT')) {
            $update_rent = FloorUnitMap::where('property_id', $property_id)
                ->where('id', $unit_id)
                ->update([
                    'up_for_rent' => 1,
                    'up_for_sale' => 0,
                    'rented' => 0,
                    'sold' => 0,
                ]);
        }
        if ($pricing_details_for == config('constants.RENTED')) {
            $update_rent = FloorUnitMap::where('property_id', $property_id)
                ->where('id', $unit_id)
                ->update([
                    'up_for_rent' => 0,
                    'up_for_sale' => 0,
                    'rented' => 1,
                ]);
        }
        if ($pricing_details_for == config('constants.SOLD')) {
            $update_rent = FloorUnitMap::where('property_id', $property_id)
                ->where('id', $unit_id)
                ->update([
                    'up_for_rent' => 0,
                    'up_for_sale' => 0,
                    'sold' => 1,
                ]);
        }
    }
}

if (!function_exists('salePriceDetails')) {
    function salePriceDetails($request)
    {
        if ($request->has('price_details')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '22')
                ->delete();
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '17')
                ->delete();
            foreach ($request->price_details as $amenity) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '22';
                $amenityValue->amenity_option_id = $amenity;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '22')
                ->delete();
        }
    }
}

if (!function_exists('rentPriceDetails')) {
    function rentPriceDetails($request)
    {
        if ($request->has('facility')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '17')
                ->delete();
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '22')
                ->delete();
            foreach ($request->facility as $amenity) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->amenity_id = '17';
                $amenityValue->amenity_option_id = $amenity;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '17')
                ->delete();
        }
    }
}
