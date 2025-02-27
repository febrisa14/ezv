<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\VillaDetailPrice;
use App\Models\Location;
use App\Models\Review;
use App\Models\DetailReview;
use App\Models\Calendar;
use Illuminate\Support\Facades\DB;
use App\Models\VillaPhoto;
use App\Models\VillaVideo;
use App\Models\VillaStory;
use App\Models\VillaAmenities;
use App\Models\VillaBathroom;
use App\Models\VillaBedroom;
use App\Models\VillaKitchen;
use App\Models\VillaSafety;
use App\Models\VillaService;
use App\Models\VillaAvailability;

use App\Models\Amenities;
use App\Models\BathRoom;
use App\Models\BedRoom;
use App\Models\Kitchen;
use App\Models\Service;
use App\Models\Safety;

use App\Models\Restaurant;
use App\Models\RestaurantPhoto;
use App\Models\RestaurantVideo;
use App\Models\RestaurantDetailReview;
use App\Models\RestaurantMenu;
use App\Models\RestaurantStory;

use Carbon\Carbon;

use App\Models\Activity;
use App\Models\ActivityPhoto;
use App\Models\ActivityVideo;
use App\Models\ActivityDetailReview;
use App\Models\ActivityPrice;
use App\Models\ActivityStory;
use App\Models\VillaHasGuestSafety;
use App\Models\HostLanguage;
use App\Models\Hotel;
use App\Models\HouseRules;
use App\Models\PropertyTypeVilla;
use App\Services\FileCompressionService as FileCompression;
use App\Models\VillaAccessibilitiyFeaturesDetail;
use App\Models\VillaAccessibilityFeatures;
use App\Models\VillaView;
use File;
use Illuminate\Support\Facades\Validator;
use App\Services\DeviceCheckService;

class ViewController extends Controller
{
    //============================ LOCATIO ON INDEX ===========================
    public static function get_location()
    {
        // $location = Location::inRandomOrder()->limit(5)->get();
        $location = Location::inRandomOrder()->get();
        return $location;
    }

    public static function get_location_ajax(Request $request)
    {
        $location = Location::select('name')->where('name', 'like', '%' . $request->name . '%')->get();
        echo json_encode($location);
    }

    // =========================== HOMEPAGE ========================

    public function index()
    {
        $photo = VillaPhoto::select('villa_photo.*', 'villa.name as name_villa')
            ->join('villa', 'villa_photo.id_villa', '=', 'villa.id_villa', 'left')->limit(20)->get();
        return view('user.index', compact('photo'));
    }

    // Map
    public function villa_map(Request $request)
    {
        if ($request->id) {
            $data = Villa::with([
                'photo', 'video', 'detailReview', 'propertyType', 'location'
            ])->where('id_villa', $request->id)->first();
            if (!$data) {
                return response()->json(
                    [
                        'message' => 'data not found'
                    ],
                    404
                );
            }
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'something was wrong'
            ], 500);
        }
    }


    //================================ VILLA DETAIL ================================

    public function villa($id)
    {
        // check if villa exist
        $villa = Villa::find($id)->increment('views');
        abort_if(!$villa, 404);

        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->with('guestSafety')->where('status', 1)->get();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Villa::find($id);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $villa = Villa::select('villa.*', 'location.name as location')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
            }
        }
        abort_if($villa->count() == 0, 404);

        VillaView::createViewLog($villa);

        $photo = VillaPhoto::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $video = VillaVideo::where('id_villa', $id)->orderBy('order', 'asc')->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $location = Location::get();
        $propertyType = PropertyTypeVilla::all();
        $amenities_m = Amenities::get();
        $bathroom_m = Bathroom::get();
        $bedroom_m = Bedroom::get();
        $kitchen_m = Kitchen::get();
        $safety_m = Safety::get();
        $service_m = Service::get();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', $id)->get();
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_villa', $id)->get();
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_villa', $id)->get();
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_villa', $id)->get();
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_villa', $id)->get();
        $service = VillaService::select('service.icon as icon', 'service.name as name')->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();

        // $photoTest = VillaPhoto::select(
        //     'id_photo as id_media',
        //     'name',
        //     'created_at',
        //     'updated_at',
        //     'created_by',
        //     'updated_by',
        // )->where('id_villa', $id)->get();
        // $videoTest = VillaVideo::select(
        //     'id_video as id_media',
        //     'name',
        //     'created_at',
        //     'updated_at',
        //     'created_by',
        //     'updated_by',
        // )->where('id_villa', $id)->get();
        // $arrayTest = collect();
        // $arrayTest = $arrayTest->merge($videoTest)->merge($photoTest);
        // dd($arrayTest->sortByDesc('id_media')->where('id_media', 116));

        $createdby = Villa::where('id_villa', $id)
            ->join('users', 'villa.created_by', '=', 'users.id')
            ->select('users.first_name')
            ->get();

        $villa_location = Location::join('villa', 'location.id_location', '=', 'villa.id_location')
            ->where('villa.id_villa', $id)
            ->select('location.id_location')
            ->get();

        // dd($villa_location[0]->id_location);

        // dd($villa_location[0]->id_location);
        $nearby_restaurant = Restaurant::where('id_location', $villa_location[0]->id_location)->where('status', '1')->get();
        $nearby_activities = Activity::where('id_location', $villa_location[0]->id_location)->where('status', '1')->get();

        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        // dd($latitude1_villa, $longitude1_villa);

        // ! Start Nearby Restaurant
        $get_lat_long_restaurant = Restaurant::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        // dd($point1);

        $kilometers = array();
        $i = 0;
        foreach ($get_lat_long_restaurant as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_location_restaurant = $item->id_location;
            $name_restaurant = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_location_restaurant;
            $kilometers[$i][] = $name_restaurant;
            $i++;
        }

        $unsorted_data = collect($kilometers);
        $sorted_data1 = $unsorted_data->sortBy('0');
        $last = $sorted_data1;
        // ! End Nearby Restaurant

        // ! Start Nearby Things To Do
        $get_lat_long_todo = Activity::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $kilometers2 = array();
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $id_location_todo = $item->id_location;
            $name_todo = $item->name;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
            $kilometers2[$j][] = $id_location_todo;
            $kilometers2[$j][] = $name_todo;
            $j++;
        }

        $unsorted_data2 = collect($kilometers2);
        $sorted_data2 = $unsorted_data2->sortBy('0');
        $last2 = $sorted_data2;
        // ! End Things To Do Nearby

        // ! Start Hotel Nearby
        $get_lat_long_hotel = Hotel::where('id_location', $villa_location[0]->id_location)
            ->where('status', '1')
            ->select('name', 'latitude', 'longitude', 'id_location')
            ->get();

        $kilometers3 = array();
        $k = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat5 = $point1['lat'];
            $lon5 = $point1['long'];
            $lat6 = $item->latitude;
            $lon6 = $item->longitude;
            $id_location_hotel = $item->id_location;
            $name_hotel = $item->name;
            $theta3 = $lon5 - $lon6;

            $miles3 = (sin(deg2rad($lat5)) * sin(deg2rad($lat6))) + (cos(deg2rad($lat5)) * cos(deg2rad($lat6)) * cos(deg2rad($theta3)));
            $miles3 = acos($miles3);
            $miles3 = rad2deg($miles3);
            $miles3 = $miles3 * 60 * 1.1515;
            $kilometers2[$k][] = number_format((float)$miles3 * 1.609344, 1, '.', '');
            $kilometers2[$k][] = $id_location_hotel;
            $kilometers2[$k][] = $name_hotel;
            $k++;
        }
        $unsorted_data3 = collect($kilometers3);
        $sorted_data3 = $unsorted_data3->sortBy('0');
        $last3 = $sorted_data3;
        // ! End Hotel Nearby

        $house_rules = HouseRules::where('id_villa', $id)->with('villa')->first();

        // ! Start Airport Nearby
        $villaPoint = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        $airportPoint = array('lat' => -8.7433916, 'long' => 115.1644194);

        $lat7 = $villaPoint['lat'];
        $lon7 = $villaPoint['long'];
        $lat8 = $airportPoint['lat'];
        $lon8 = $airportPoint['long'];
        $theta4 = $lon7 - $lon8;

        $miles4 = (sin(deg2rad($lat7)) * sin(deg2rad($lat8))) + (cos(deg2rad($lat7)) * cos(deg2rad($lat8)) * cos(deg2rad($theta4)));
        $miles4 = acos($miles4);
        $miles4 = rad2deg($miles4);
        $miles4 = $miles4 * 60 * 1.1515;
        $airportDistance = number_format((float)$miles4 * 1.609344, 1, '.', '');
        // ! End Airport Nearby

        if (DeviceCheckService::isMobile()) {
            return view('user.m-villa', compact('video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last', 'last2', 'propertyType', 'house_rules', 'airportDistance'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.villa', compact('video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last', 'last2', 'propertyType', 'house_rules', 'airportDistance'));
        }
        return view('user.villa', compact('video', 'detail', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'villa', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'last', 'last2', 'propertyType', 'house_rules', 'airportDistance'));
    }

    public function update_position_photo(Request $request)
    {
        abort_if(!auth()->check(), 401);
        $validator = Validator::make($request->all(), [
            'imageids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $imageids_arr = $request->imageids;

        $villa = Villa::find($request->id);
        abort_if(!$villa, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            abort(403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = VillaPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            return response()->json([
                'message' => 'data has been updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function update_position_video(Request $request)
    {
        abort_if(!auth()->check(), 401);
        $validator = Validator::make($request->all(), [
            'videoids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $videoids_arr = $request->videoids;

        $villa = Villa::find($request->id);
        abort_if(!$villa, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            abort(403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = VillaVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            return response()->json([
                'message' => 'data has been updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function fullcalendar($id)
    {
        // $event = VillaDetailPrice::get();
        $data = DB::table('villa_detail_price')
            ->select(
                'villa_detail_price.id_detail',
                'villa_detail_price.id_villa',
                'villa_detail_price.start',
                'villa_detail_price.end',
                'villa_detail_price.disc',
                'villa_detail_price.price as title',
                'villa.name as name',
                'villa.price as regular_price'
            )
            ->join('villa', 'villa_detail_price.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_detail_price.id_villa', '=', $id)
            ->get();

        // dd($data);

        $event = array([
            'id_detail' => 0,
            'id_villa' => 0,
            'start' => 0,
            'end' => 0,
            'disc' => 0,
            'title' => 0,
            'name' => 0,
            'regular_price' => 0
        ]);

        $i = 0;

        foreach ($data as $item) {
            $event[$i]['id_detail'] = $item->id_detail;
            $event[$i]['id_villa'] = $item->id_villa;
            $event[$i]['start'] = $item->start;
            $event[$i]['end'] = date('Y-m-d', strtotime($item->end . " +1 days"));
            $event[$i]['disc'] = $item->disc;
            $event[$i]['title'] = 'IDR ' . $item->title;
            $event[$i]['name'] = $item->name;
            $event[$i]['regular_price'] = $item->regular_price;
            $i++;
        }

        // dd($event);

        return response()->json($event, 200);
    }

    public function fullcalendarNotAvailable($id)
    {

        $event = VillaAvailability::select(
            'date',
            'text as title',
            'color',
        )
            ->where('id_villa', '=', $id)
            ->orderBy('date')
            ->get();

        $result = array(['start' => 0, 'end' => 0, 'title' => $event[0]->title, 'color' => $event[0]->color]);

        $i = 0;

        foreach ($event as $data) {
            $date = $data->date;

            if ($result[$i]['start'] == 0) {
                $result[$i]['start'] = $date;
            } else {
                if ($result[$i]['start'] < $date && $result[$i]['end'] == 0) {
                    $result[$i]['end'] = $date;
                }
                if ($result[$i]['end'] != 0 && $result[$i]['end'] < $date) {
                    $startTimeStamp = strtotime($result[$i]['end']);

                    $endTimeStamp = strtotime($date);

                    $timeDiff = abs($endTimeStamp - $startTimeStamp);

                    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

                    // and you might want to convert to integer
                    $numberDays = intval($numberDays);

                    if ($numberDays == 1) {
                        $result[$i]['end'] = date('Y-m-d', strtotime($date . " +1 days"));
                    } else {
                        $i++;
                        $result[$i]['start'] = $date;
                        $result[$i]['end'] = 0;
                        $result[$i]['title'] = $event[0]->title;
                        $result[$i]['color'] = $event[0]->color;
                    }
                }
                // if ($result[$i]['end'] != 0 && $result[$i]['end'] > $date) {
                //     $i++;
                //     $result[$i]['start'] = $date;
                //     $result[$i]['end'] = 0;
                //     $result[$i]['title'] = $event[0]->title;
                //     $result[$i]['color'] = $event[0]->color;
                // }
            }
        }

        // dd($result);

        return response()->json($result, 200);
    }

    public function villa_not_available(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        // $villavailability = VillaAvailability::where('id_villa', $request->id_villa)->get();

        // $dateDb = [];

        // foreach ($villavailability as $v)
        // {
        //     array_push($dateDb, $v->date);
        // }

        $date = [];

        for ($i = $request->start; $i <= $request->end; $i++) {
            array_push($date, $i);
        }
        // $result = !array_diff($date, $dateDb);

        foreach ($date as $key => $value) {
            $data[] = [
                'id_villa' => $request->id_villa,
                'date' => $value,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ];
        }

        // dd($data);

        $store = VillaAvailability::insert($data);

        if ($store) {
            $status = 200;
        }

        // try {
        //     $store = VillaAvailability::create([
        //         'id_villa' => $request->id_villa,
        //         'start_date' => $request->start,
        //         'end_date' => $request->end,
        //         'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //         'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //         'created_by' => Auth::user()->id,
        //         'updated_by' => Auth::user()->id,
        //     ]);

        //     if ($store) {
        //         $status = 200;
        //     }
        // } catch (\Illuminate\Database\QueryException $e) {
        //     $status = 500;
        // }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_price(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();
            // dd($request->commission);

            $find->update(array(
                'price' => $request->price,
                'commission' => $request->commission,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            // dd($find);

            if ($request->disc == '') {
                $disc = 0;
            } else {
                $disc = $request->disc;
            }

            $data = VillaDetailPrice::insertGetId(array(
                'id_villa' => $request->id_villa,
                'start' => $request->start,
                'end' => $request->end,
                'price' => $request->special_price,
                'disc' => $disc,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_bedroom(Request $request)
    {
        $this->authorize('listvilla_update');

        $validator = Validator::make($request->all(), [
            'adult' => ['required', 'integer'],
            'children' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'adult' => $request->adult,
                'children' => $request->children,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_guest(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'adult' => $request->adult,
                'children' => $request->children,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_location(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'id_location' => $request->id_location,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'description' => str_replace(array("\n", "\r"), ' ', $request->description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_image(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $villa = Villa::where('id_villa', $request->id_villa)->first('uid');
            // $folder = strtolower($villa->name);
            // $path = public_path() . '/foto/gallery/' . $folder;
            $folder = $villa->uid;
            $path = env("VILLA_FILE_PATH") . $folder;

            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($request->image->getClientOriginalExtension());
            // dd($ext);

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                $original_name = $request->image->getClientOriginalName();
                // dd($original_name);
                $find = villa::where('id_villa', $request->id_villa)->first();

                $name_file = time() . "_" . $original_name;

                // $request->image->move($path, $name_file);
                // if image size > 1 MB, quality 30%
                // if image size > 700 KB, quality 40%
                // else, quality 50%
                if ($request->image->getSize() > 1000000) {
                    FileCompression::compressImage($request->image->getPathName(), $path . "/" . $name_file, 30);
                } elseif ($request->image->getSize() > 700000) {
                    FileCompression::compressImage($request->image->getPathName(), $path . "/" . $name_file, 40);
                } else {
                    FileCompression::compressImage($request->image->getPathName(), $path . "/" . $name_file, 50);
                }

                $find->update(array(
                    'image' => $name_file,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }



            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_delete_image(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        abort_if(!$villa, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villa->image)) {
            File::delete($path . '/' . $villa->image);
        }

        $deletedVillaImage = $villa->update([
            'image' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deletedVillaImage) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfully',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function villa_update_name(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            if (Auth::user()->id == 1 || Auth::user()->id == 2) {
                $find->update(array(
                    'name' => $request->name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $find->update(array(
                    'name' => $request->name,
                    'original_name' => $request->name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_short_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = villa::where('id_villa', $request->id_villa)->first();

            $find->update(array(
                'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_amenities(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            //insert into database
            VillaAmenities::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->amenities)) {
                foreach ($request->amenities as $row) {
                    VillaAmenities::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_amenities' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            VillaBathroom::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->bathroom)) {
                foreach ($request->bathroom as $row) {
                    $data = VillaBathroom::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_bathroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
                // foreach ($request->bathroom as $row) {
                //     $find = VillaBathroom::where('id_villa', $request->id_villa)->where('id_bathroom', $row)->first();
                //     if ($find) {
                //         $find->update(array(
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     } else {
                //         $data = VillaBathroom::insert(array(
                //             'id_villa' => $request->id_villa,
                //             'id_bathroom' => $row,
                //             'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'created_by' => Auth::user()->id,
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     }
                // }
            }

            VillaBedroom::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->bedroom)) {
                foreach ($request->bedroom as $row) {
                    VillaBedroom::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_bedroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            VillaKitchen::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->kitchen)) {
                foreach ($request->kitchen as $row) {
                    VillaKitchen::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_kitchen' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            VillaSafety::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->safety)) {
                foreach ($request->safety as $row) {
                    VillaSafety::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_safety' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            VillaService::where('id_villa', $request->id_villa)->delete();
            if (!empty($request->service)) {
                foreach ($request->service as $row) {
                    VillaService::insert(array(
                        'id_villa' => $request->id_villa,
                        'id_service' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            $status = 200;
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_property_type(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_villa' => ['required', 'integer'],
            'id_property_type' => ['required', 'integer']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // villa
        $villa = Villa::find($request->id_villa);

        // check if restaurant does not exist, abort 404
        abort_if(!$villa, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villa->created_by) {
            abort(403);
        }

        // update
        $updatedVilla = $villa->update([
            'id_property_type' => $request->id_property_type,
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedVilla) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_update_photo(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $berkas = $request->file;
            if (empty($berkas)) {
                //
            } else {
                //cek the directori first
                $find = Villa::where('id_villa', $request->id_villa)->get();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = $find[0]->uid;
                $path = env("VILLA_FILE_PATH") . $folder;

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {

                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;
                    // isi dengan nama folder tempat kemana file diupload
                    // $berkas->move($path, $name_file);
                    // if file size > 1 MB, quality 30%
                    // if file size > 700 KB, quality 40%
                    // else, quality 50%
                    if ($request->file->getSize() > 1000000) {
                        FileCompression::compressImage($request->file->getPathName(), $path . "/" . $name_file, 30);
                    } elseif ($request->file->getSize() > 700000) {
                        FileCompression::compressImage($request->file->getPathName(), $path . "/" . $name_file, 40);
                    } else {
                        FileCompression::compressImage($request->file->getPathName(), $path . "/" . $name_file, 50);
                    }
                    //insert into database
                    $data = villaphoto::create([
                        'name' => $name_file,
                        'id_villa' => $request->id_villa,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
                } elseif ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;

                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    //insert into database
                    $data = villavideo::create([
                        'name' => $name_file,
                        'id_villa' => $request->id_villa,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_delete_photo_video(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_video || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaVideo = VillaVideo::find($request->id_video);
        abort_if(!$villa, 404);
        abort_if(!$villaVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaVideo->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villaVideo->name)) {
            File::delete($path . '/' . $villaVideo->name);
        }

        $deletedVillaVideo = $villaVideo->delete();
        // check if delete is success or not
        if ($deletedVillaVideo) {
            return response()->json([
                'message' => 'Delete Data Successfully',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function villa_delete_photo_photo(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_photo || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaPhoto = VillaPhoto::find($request->id_photo);
        abort_if(!$villa, 404);
        abort_if(!$villaPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $villaPhoto->name)) {
            File::delete($path . '/' . $villaPhoto->name);
        }

        $deletedVillaPhoto = $villaPhoto->delete();
        // check if delete is success or not
        if ($deletedVillaPhoto) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfully',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function villa_update_story(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $berkas = $request->file;
            if (empty($berkas)) {
                $status = 500;
            } else {
                $find = Villa::where('id_villa', $request->id_villa)->get();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = $find[0]->uid;
                $path = env("VILLA_FILE_PATH") . $folder;
                if (!File::isDirectory($path)) {

                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;
                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    $data = VillaStory::insert(array(
                        'title' => $request->title,
                        'name' => $name_file,
                        'id_villa' => $request->id_villa,
                        // 'thumbnail' => $find[0]->image,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function villa_delete_story(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_story || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $villa = Villa::find($request->id);
        $villaStory = VillaStory::find($request->id_story);
        abort_if(!$villa, 404);
        abort_if(!$villaStory, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $villaStory->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $villa->uid;
        $path = env("VILLA_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $villaStory->name)) {
            // File::delete($path . '/' . $villaStory->name);
        }

        $deletedVillaStory = $villaStory->delete();

        // check if delete is success or not
        if ($deletedVillaStory) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfully',
                'status' => 200,
            ], 200);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'message' => 'Failed Deleted Data',
                'status' => 500,
            ], 500);
        }
    }

    public function update_order($id)
    {
        if (isset($_GET["order"])) {
            $order  = explode(",", $_GET["order"]);
            for ($i = 0; $i < count($order); $i++) {
                $sql = "UPDATE reorder SET display_order='" . $i . "' WHERE id=" . $order[$i];
                mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
            }
        }
    }

    public function story($id)
    {
        // $data = VillaStory::where('id_story', $id)->get();
        $data = VillaStory::with('villa')->where('id_story', $id)->first();

        if ($data) {
            return response()->json([
                'id_story' => $data->id_story,
                'title' => $data->title,
                'name' => $data->name,
                'villa' => (object)[
                    'id_villa' => $data->villa->id_villa,
                    'uid' => $data->villa->uid
                ] ?? null,
                'thumbnail' => $data->thumbnail,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
                'created_by' => $data->created_by,
                'updated_by' => $data->updated_by
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function story_next($id, $id_villa)
    {
        $data = VillaStory::where('id_story', '<', $id)->where('id_villa', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = VillaStory::where('id_villa', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }

    public function video($id)
    {
        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $video = VillaVideo::where('id_villa', $id)->get();
        return view('user.video', compact('video', 'villa', 'amenities', 'ratting', 'stories'));
    }

    public function description($id)
    {
        $villa = Villa::select('villa.*', 'location.name as location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')->where('id_villa', $id)->get();
        $amenities = VillaAmenities::select('villa_amenities.id_villa', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('villa_amenities.id_villa', $id)->limit(5)->get();
        $ratting = DetailReview::where('id_villa', $id)->get();
        $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', $id)->get();
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->where('id_villa', $id)->get();
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->where('id_villa', $id)->get();
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->where('id_villa', $id)->get();
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->where('id_villa', $id)->get();
        $service = VillaService::select('service.icon as icon', 'service.name as name')->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();
        return view('user.description', compact('villa', 'villa_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'detail', 'amenities', 'ratting', 'stories'));
    }

    public function availabality(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = Calendar::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'summary', 'start', 'end', 'uid', 'id_villa']);

            return response()->json($data);
        }
        $villa = Villa::where('id_villa', $id)->get();
        return view('user.availabality', compact('villa'));
    }

    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Calendar::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Calendar::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Calendar::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

    public function confirm(Request $request)
    {
        // dd($request->all());
        $id = $request->id_villa;
        $villa = Villa::where('id_villa', $id)->get();

        //get number of night
        $startTimeStamp = strtotime($request->check_in);
        $endTimeStamp = strtotime($request->check_out);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        $night = intval($numberDays);

        //total
        $total = $night * $villa[0]->price;

        $data = $request;

        return view('user.confirm', compact('data', 'villa', 'night', 'total'));
    }

    public function request_update_status(Request $request)
    {
        $id = $request->id;
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        $find = Villa::where('id_villa', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('listvilla_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Villa::where('id_villa', $id)->first();

        $status = false;

        if ($find->status == 0) {
            $find->update(array(
                'status' =>  2, //request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 1) {
            $find->update(array(
                'status' =>  3, //request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }

    public function cancel_request_update_status(Request $request)
    {
        $id = $request->id;
        abort_if(!auth()->check(), 401);
        abort_if(!$id, 500);
        $find = Villa::where('id_villa', $id)->first();
        abort_if(!$find, 404);
        $this->authorize('listvilla_update');
        abort_if(auth()->user()->id != $find->created_by, 403);

        $find = Villa::where('id_villa', $id)->first();

        $status = false;

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  0, //cancel request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 3) {
            $find->update(array(
                'status' =>  1, //cancel request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }

    //======================= LIST VILLA ======================================
    public function villa_list()
    {
        $req = 0;
        $villa = Villa::with('location')->select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->where('villa.status', 1)
            ->inRandomOrder()->get();

        dd($villa);

        //return view('user.list_villa', compact('villa', 'req'));
        return view('user.m-list_villa', compact('villa', 'req'));
    }

    public function list(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->where('villa.status', 1)
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.status', 1)
                    ->inRandomOrder()->get();
            } else {
                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->where('villa.status', 1)
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();
        $host_language = HostLanguage::all();

        $accessibility_features = VillaAccessibilityFeatures::all();
        $accessibility_features_detail = VillaAccessibilitiyFeaturesDetail::all();

        $villaIds = $villa->modelKeys();
        // $villa = Villa::whereIn('id_villa', $villaIds)->paginate(20);
        $villa = Villa::whereIn('id_villa', $villaIds)->first();

        dd($villa);

        $i = 0;
        $j = 0;
        $near = array();
        foreach ($villa as $item) {
            $things_loc = Activity::where('id_location', $item->id_location)->select('name', 'latitude', 'longitude', 'id_location')->get();
            if (count($things_loc) == 0) {
                $things_loc = Activity::where('id_activity', 3)->select('name', 'latitude', 'longitude', 'id_location')->get();
            }

            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);

            foreach ($things_loc as $item2) {
                $lat1 = $point1['lat'];
                $lon1 = $point1['long'];
                $lat2 = $item2->latitude;
                $lon2 = $item2->longitude;
                $name = $item2->name;
                $theta = $lon1 - $lon2;

                $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $kilometers[$i][] = ($miles * 1.609344 / 40) * 60;
                $kilometers[$i][] = $name;

                if ($near == null) {
                    $near[0] = $kilometers[$i];
                } else {
                    if ($kilometers[$i][0] <= $near[0][0]) {
                        $near[0] = $kilometers[$i];
                    }
                }
                $i++;
            }

            $villa[$j]['time'] = $near[0][0];
            $villa[$j]['activity'] = $near[0][1];

            $j++;
            $near = [];
        }

        // return $villa;

        if (DeviceCheckService::isMobile()) {
            return view('user.m-list_villa', compact('villa', 'req', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.list_villa', compact('villa', 'req', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail'));
        }
        return view('user.list_villa', compact('villa', 'req', 'amenities', 'host_language', 'accessibility_features', 'accessibility_features_detail'));
    }

    public static  function gallery($id)
    {
        $gallery = VillaPhoto::select('villa_photo.name as photo')->where('id_villa', $id)->get();
        return $gallery;
    }

    public function villa_video($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price', 'location.name as location', 'villa.short_description as short', 'detail_review.count_person as count', 'villa.bedroom as bedroom', 'villa.bathroom as bathroom', 'villa.beds as beds', 'villa.id_villa as id_villas')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
        //     ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
        //     ->where('villa_video.id_villa', $id)->get();
        $data = Villa::with([
            'location',
            'video'
        ])->where('id_villa', $id)->first();
        $video = VillaVideo::where('id_villa', $id)->orderBy('order', 'desc')->first();
        if ($data && $video) {
            return response()->json([
                'id_villa' => $data->id_villa,
                'uid' => $data->uid,
                'name' => $data->name,
                'short_description' => $data->short_description,
                'bedroom' => $data->bedroom,
                'bathroom' => $data->bathroom,
                'price' => $data->price,
                'beds' => $data->beds,
                'video' => $video,
                'is_favorit' => $data->is_favorit,
                'location' => $data->location
            ]);
        }
        return response()->json([]);
        // echo json_encode($data);
    }

    public function restaurant_nearby_villa(Request $request)
    {
        $id = $request->id;
        $villa_location = Location::join('villa', 'location.id_location', '=', 'villa.id_location')
            ->where('villa.id_villa', $id)
            ->select('location.id_location')
            ->get();

        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        // * Get Latitude Longitude Restaurant
        $get_lat_long_restaurant = Restaurant::with([
            'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
        ])->where('status', '1')->get();

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');

        $kilometers = array();
        $i = 0;
        foreach ($get_lat_long_restaurant as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $restaurant_detail = $item;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;

            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $restaurant_detail
            ];
            $i++;
        }

        // filter data
        $filtered_data = array();
        foreach ($kilometers as $data) {
            // if ($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function activity_nearby_villa(Request $request)
    {
        $id = $request->id;
        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');

        // * Get Latitude Longitude To Do Things
        $get_lat_long_todo = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('status', '1')->get();

        $kilometers2 = array();
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $todo_detail = $item;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j] = (object)[
                'kilometer' => number_format((float)$miles2 * 1.609344, 1, '.', ''),
                'detail' => $todo_detail
            ];
            $j++;
        }

        // filter data
        $filtered_data = array();
        foreach ($kilometers2 as $data) {
            // if ($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function hotel_nearby_villa(Request $request)
    {
        $id = $request->id;
        // * Get latitude Longitude Villa
        $get_villa = Villa::where('id_villa', $id)->first();
        $latitude1_villa = $get_villa->latitude;
        $longitude1_villa = $get_villa->longitude;

        $get_lat_long_hotel = Hotel::where('status', '1')->get();
        // dd($get_lat_long_hotel);

        $point1 = array('lat' => $latitude1_villa, 'long' => $longitude1_villa, 'id_location');
        $kilometers3 = array();
        $k = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat5 = $point1['lat'];
            $lon5 = $point1['long'];
            $lat6 = $item->latitude;
            $lon6 = $item->longitude;
            $theta3 = $lon5 - $lon6;

            $miles3 = (sin(deg2rad($lat5)) * sin(deg2rad($lat6))) + (cos(deg2rad($lat5)) * cos(deg2rad($lat6)) * cos(deg2rad($theta3)));
            $miles3 = acos($miles3);
            $miles3 = rad2deg($miles3);
            $miles3 = $miles3 * 60 * 1.1515;
            $kilometers3[$k] = (object)[
                'kilometer' => number_format((float)$miles3 * 1.609344, 1, '.', ''),
                'detail' => $item
            ];
            $k++;
        }
        // filter data
        $filtered_data = array();
        foreach ($kilometers3 as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }
        // dd('hit');
        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function next($id)
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price', 'location.name as location', 'villa.short_description as short', 'detail_review.count_person as count', 'villa.bedroom as bedroom', 'villa.bathroom as bathroom', 'villa.beds as beds', 'villa.id_villa as id_villas')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->where('villa_video.id_villa', $id)->get();


        echo json_encode($data);
    }

    public function video_open($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->where('villa_video.id_video', $id)->get();

        $data = VillaVideo::with('villa')->where('id_video', $id)->first();

        if ($data) {
            return response()->json([
                'video' => $data->name,
                'villa' => (object)[
                    'name' => $data->villa->name,
                    'uid' => $data->villa->uid
                ] ?? null
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        echo json_encode($data);
    }


    public static  function amenities($id)
    {
        $amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->where('id_villa', $id)->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->get();

        return $amenities;
    }

    public static  function bathroom($id)
    {
        $bathroom = VillaBathroom::select('bathroom.icon as icon', 'bathroom.name as name')->where('id_villa', $id)->join('bathroom', 'villa_bathroom.id_bathroom', '=', 'bathroom.id_bathroom', 'left')->get();

        return $bathroom;
    }

    public static  function bedroom($id)
    {
        $bedroom = VillaBedroom::select('bedroom.icon as icon', 'bedroom.name as name')->where('id_villa', $id)->join('bedroom', 'villa_bedroom.id_bedroom', '=', 'bedroom.id_bed', 'left')->get();

        return $bedroom;
    }

    public static  function kitchen($id)
    {
        $kitchen = VillaKitchen::select('kitchen.icon as icon', 'kitchen.name as name')->where('id_villa', $id)->join('kitchen', 'villa_kitchen.id_kitchen', '=', 'kitchen.id_kitchen', 'left')->get();

        return $kitchen;
    }

    public static  function safety($id)
    {
        $safety = VillaSafety::select('safety.icon as icon', 'safety.name as name')->where('id_villa', $id)->join('safety', 'villa_safety.id_safety', '=', 'safety.id_safety', 'left')->get();

        return $safety;
    }

    public static  function service($id)
    {
        $service = VillaService::select('service.icon as icon', 'service.name as name')->where('id_villa', $id)->join('service', 'villa_service.id_service', '=', 'service.id_service', 'left')->get();

        return $service;
    }

    public function review($id)
    {
        $villa = Villa::where('id_villa', $id)->get();
        $review = Review::select('villa_review.*', 'users.name as name')
            ->join('users', 'villa_review.created_by', '=', 'users.id', 'left')
            ->where('id_villa', $id)->get();
        $detail = DetailReview::where('id_villa', $id)->get();
        return view('user.review', compact('villa', 'review', 'detail'));
    }


    //============================= RESTAURANT LIST =============================
    public function restaurant_list(Request $request)
    {

        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $restaurant = Restaurant::select('restaurant.*', DB::raw('(select name from restaurant_video where id_restaurant = restaurant.id_restaurant order by id_video asc limit 1) as video'), DB::raw('(select name from restaurant_photo where id_restaurant = restaurant.id_restaurant order by id_photo asc limit 1) as photo'), 'restaurant_detail_review.average as average', 'restaurant_detail_review.count_person as person')
                ->join('restaurant_detail_review', 'restaurant.id_restaurant', '=', 'restaurant_detail_review.id_restaurant', 'left')
                ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')
                ->inRandomOrder()->get();
        } else {
            $restaurant = Restaurant::select('restaurant.*', DB::raw('(select name from restaurant_video where id_restaurant = restaurant.id_restaurant order by id_video asc limit 1) as video'), DB::raw('(select name from restaurant_photo where id_restaurant = restaurant.id_restaurant order by id_photo asc limit 1) as photo'), 'restaurant_detail_review.average as average', 'restaurant_detail_review.count_person as person')
                ->join('restaurant_detail_review', 'restaurant.id_restaurant', '=', 'restaurant_detail_review.id_restaurant', 'left')
                ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')
                ->where('location.name', 'like', '%' . $request->location . '%')
                ->inRandomOrder()->get();
        }

        $amenities = Amenities::all();

        return view('user.list_restaurant', compact('req', 'restaurant', 'amenities'));
    }

    public static  function restaurant_gallery($id)
    {
        $gallery = RestaurantPhoto::select('restaurant_photo.name as photo')->where('id_restaurant', $id)->get();

        return $gallery;
    }

    public function restaurant_video($id)
    {
        $data = RestaurantVideo::select('restaurant_video.name as video', 'restaurant.name as name')
            ->join('restaurant', 'restaurant_video.id_restaurant', '=', 'restaurant.id_restaurant', 'left')
            ->where('restaurant_video.id_restaurant', $id)->get();

        echo json_encode($data);
    }

    public function restaurant_next()
    {
        $data = RestaurantVideo::select('restaurant_video.name as video', 'restaurant.name as name')
            ->join('restaurant', 'restaurant_video.id_restaurant', '=', 'restaurant.id_restaurant', 'left')
            ->inRandomOrder()->limit(1)->get();


        echo json_encode($data);
    }



    //================================ RESTAURANT DETAIL ================================

    public function restaurant($id)
    {
        // check if restaurant exist
        $restaurant = Restaurant::find($id);
        abort_if(!$restaurant, 404);

        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $photo = RestaurantPhoto::where('id_restaurant', $id)->get();
        // $amenities = restaurantAmenities::select('restaurant_amenities.id_restaurant', 'amenities.icon as icon', 'amenities.name as name')
        //         ->join('amenities', 'restaurant_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
        //         ->where('restaurant_amenities.id_restaurant', $id)->limit(5)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        $menu = RestaurantMenu::where('id_restaurant', $id)->get();
        return view('user.restaurant.restaurant', compact('restaurant', 'photo', 'ratting', 'stories', 'menu'));
    }

    public function det_restaurant_video($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $video = RestaurantVideo::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.video', compact('video', 'restaurant', 'ratting', 'stories'));
    }

    public function restaurant_description($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.description', compact('restaurant', 'detail', 'ratting', 'stories'));
    }

    public function restaurant_menu($id)
    {
        $restaurant = Restaurant::select('restaurant.*', 'location.name as location')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location', 'left')->where('id_restaurant', $id)->get();
        $ratting = RestaurantDetailReview::where('id_restaurant', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = RestaurantDetailReview::where('id_restaurant', $id)->get();
        $menu = RestaurantMenu::where('id_restaurant', $id)->get();
        $stories = RestaurantStory::where('id_restaurant', $id)->orderBy('created_at', 'desc')->get();
        return view('user.restaurant.menu', compact('restaurant', 'detail', 'ratting', 'menu', 'stories'));
    }

    public function restaurant_story($id)
    {
        $data = RestaurantStory::where('id_story', $id)->get();

        echo json_encode($data);
    }

    public function restaurant_story_next($id, $id_villa)
    {
        $data = RestaurantStory::where('id_story', '<', $id)->where('id_restaurant', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = RestaurantStory::where('id_restaurant', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }




    //============================= ACTIVITY LIST =============================
    public function activity_list(Request $request)
    {

        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $activity = Activity::select('activity.*', DB::raw('(select name from activity_video where id_activity = activity.id_activity order by id_video asc limit 1) as video'), DB::raw('(select name from activity_photo where id_activity = activity.id_activity order by id_photo asc limit 1) as photo'), 'activity_detail_review.average as average', 'activity_detail_review.count_person as person')
                ->join('activity_detail_review', 'activity.id_activity', '=', 'activity_detail_review.id_activity', 'left')
                ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')
                ->inRandomOrder()->get();
        } else {
            $activity = Activity::select('activity.*', DB::raw('(select name from activity_video where id_activity = activity.id_activity order by id_video asc limit 1) as video'), DB::raw('(select name from activity_photo where id_activity = activity.id_activity order by id_photo asc limit 1) as photo'), 'activity_detail_review.average as average', 'activity_detail_review.count_person as person')
                ->join('activity_detail_review', 'activity.id_activity', '=', 'activity_detail_review.id_activity', 'left')
                ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')
                ->where('location.name', 'like', '%' . $request->location . '%')
                ->inRandomOrder()->get();
        }

        $amenities = Amenities::all();

        //return view('user.list_activity', compact('req', 'activity', 'amenities'));
        return view('user.m-list_activity', compact('req', 'activity', 'amenities'));
    }

    public static  function activity_gallery($id)
    {
        $gallery = ActivityPhoto::select('activity_photo.name as photo')->where('id_activity', $id)->get();

        return $gallery;
    }

    public function activity_video($id)
    {
        $data = ActivityVideo::select('activity_video.name as video', 'activity.name as name')
            ->join('activity', 'activity_video.id_activity', '=', 'activity.id_activity', 'left')
            ->where('activity_video.id_activity', $id)->get();

        echo json_encode($data);
    }

    public function activity_next()
    {
        $data = ActivityVideo::select('activity_video.name as video', 'activity.name as name')
            ->join('activity', 'activity_video.id_activity', '=', 'activity.id_activity', 'left')
            ->inRandomOrder()->limit(1)->get();


        echo json_encode($data);
    }

    //================================ Activity DETAIL ================================

    public function activity($id)
    {
        // check if activity exist
        $activity = Activity::find($id);
        abort_if(!$activity, 404);

        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();

        $photo = ActivityPhoto::where('id_activity', $id)->get();
        // $amenities = activityAmenities::select('activity_amenities.id_activity', 'amenities.icon as icon', 'amenities.name as name')
        //         ->join('amenities', 'activity_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
        //         ->where('activity_amenities.id_activity', $id)->limit(5)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        $video = ActivityVideo::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();

        //return view('user.activity.activity', compact('activity', 'photo', 'video', 'ratting', 'stories'));
        return view('user.activity.m-activity', compact('activity', 'photo', 'video', 'ratting', 'stories'));
    }

    public function det_activity_video($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        $video = ActivityVideo::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.video', compact('video', 'activity', 'ratting', 'stories'));
    }

    public function activity_description($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = ActivityDetailReview::where('id_activity', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = ActivityDetailReview::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.description', compact('activity', 'detail', 'ratting', 'stories'));
    }

    public function activity_price($id)
    {
        $activity = Activity::select('activity.*', 'location.name as location')
            ->join('location', 'activity.id_location', '=', 'location.id_location', 'left')->where('id_activity', $id)->get();
        $ratting = activityDetailReview::where('id_activity', $id)->get();
        // $stories = VillaStory::where('id_villa', $id)->orderBy('created_at', 'desc')->get();
        $detail = ActivityDetailReview::where('id_activity', $id)->get();
        $menu = ActivityPrice::where('id_activity', $id)->get();
        $stories = ActivityStory::where('id_activity', $id)->orderBy('created_at', 'desc')->get();
        return view('user.activity.price', compact('activity', 'detail', 'ratting', 'menu', 'stories'));
    }

    public function activity_story($id)
    {
        $data = ActivityStory::where('id_story', $id)->get();

        echo json_encode($data);
    }

    public function activity_story_next($id, $id_villa)
    {
        $data = ActivityStory::where('id_story', '<', $id)->where('id_activity', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();

        if ($data->count() == 0) {
            $data = ActivityStory::where('id_activity', $id_villa)->orderBy('id_story', 'desc')->limit(1)->get();
        }

        echo json_encode($data);
    }



    //Deo Section
    public function list_video()
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.description as description')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')->get();

        return view('user.all_video', compact('data'));
    }

    public function villa_list_video($id)
    {
        $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.description as description')
            ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
            ->where('id_video', $id)->get();

        echo json_encode($data);
    }

    public function getVideoSuggestions(Request $request)
    {

        $id = $request->id;
        $keyword = $request->keyword;

        $suggestions = DB::table('villa')->select('villa.name as villa_name', 'villa.id_location', 'location.name as lokasi', 'villa_video.name as video_name', 'id_video', 'thumbnail')
            ->rightJoin('villa_video', 'villa_video.id_villa', '=', 'villa.id_villa')
            ->Join('location', 'location.id_location', '=', 'villa.id_location')
            ->where('villa.address', 'like', '%' . $keyword . '%')
            ->take(6)->get();

        $filtered = $suggestions->reject(function ($item) use ($id) {
            return $item->id_video == $id;
        });
        //dd($filtered);
        return $filtered;
    }
    public function get_table($id)
    {
        $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
            ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('villa_amenities', 'villa.id_villa', '=', 'villa_amenities.id_villa', 'left')
            ->where('id_amenities', $id)
            ->inRandomOrder()->get();

        return view('user.filter_villa', compact('villa'));
    }

    //Deo Section End

    public function villa_update_house_rules(Request $request)
    {
        // dd($request->all());
        // dd($request->id_villa);
        $checkID = HouseRules::where('id_villa', '=', $request->id_villa)->first();

        if ($checkID == null) {
            // ID villa doesn't exist
            $checkID = HouseRules::create(array(
                'id_villa' => $request->id_villa,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        } else {
            $checkID->update(array(
                'id_villa' => $request->id_villa,
                'children' => $request->children,
                'infants' => $request->infants,
                'pets' => $request->pets,
                'smoking' => $request->smoking,
                'events' => $request->events,
            ));
            return back();
        }
    }

    public function villa_update_guest_safety(Request $request)
    {
        $deleteID = VillaHasGuestSafety::where('id_villa', '=', $request->id_villa)->delete();

        if ($request->pool == 1) {
            // dd('oke');
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 1,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->lake == 2) {
            // dd('sip');
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 2,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->climb == 3) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 3,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->height == 4) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 4,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->animal == 5) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 5,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->camera == 6) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 6,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->monoxide == 7) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 7,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->alarm == 8) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 8,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->must == 9) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 9,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->potential == 10) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 10,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->come == 11) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 11,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->parking == 12) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 12,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->shared == 13) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 13,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->amenity == 14) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 14,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }
        if ($request->weapon == 15) {
            VillaHasGuestSafety::create(array(
                'id_villa' => $request->id_villa,
                'id_guest_safety' => 15,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return back();
    }
}
