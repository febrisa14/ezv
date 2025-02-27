<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use DataTables;

class HotelRoomBooking extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'id_hotel',
        'id_hotel_room', 'adult', 'child', 'id_extra_price', 'number_extra',
        'check_in', 'check_out', 'hotel_room_price', 'extra_price',
        'total_price', 'method', 'status'
    ];

    protected $table = 'hotel_room_booking';
    protected $primaryKey = 'id_booking';

    protected $dates = ['check_in','check_out'];

    public function scopeDatatablesUpcoming()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        {
            $data = self::with('hotel','hotel_room')
            //after tomorrow or upcoming
            ->where('hotel_room_booking.check_in','>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('hotel_room_booking.status',0)
            ->get();
        }
        elseif (Auth::user()->role_id == 3)
        {
            $data = self::with('hotel','hotel_room')
            ->where('hotel_room_booking.created_by', Auth::user()->id)
            ->where('hotel_room_booking.status',0)
            ->where('hotel_room_booking.check_in','>', Carbon::tomorrow()->format('Y-m-d'))
            ->get();
        }

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('total_price', function($data){
            $no = "";
            // $no .= "<center>";
            $no .= "IDR ". number_format($data->total_price, 2);
            // $no .= "</center";

            return $no;
        })
        ->addColumn('no_inv', function ($data) {
            $no = "";
            $no .= "<center>";
            $no .= $data->no_invoice;
            $no .= "</center";

            return $no;
        })
        ->addColumn('name_hotel', function ($data) {
            $no = "";
            $no .= "<center>";
            $no .= "<span>". $data->hotel_room->hotelType->name . " Room " . " - " . $data->hotel->name ."</span>";
            $no .= "</center";

            return $no;
        })
        ->addColumn('status', function ($data) {
            $co = "";
            $co .= "<center>";
            if ($data->status == 0)
                $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
            elseif ($data->status == 1) {
                $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
            }
            elseif ($data->status == 2) {
                $co .= "<span class='text-white badge' style='background: #F0A500; padding: 8px;'>Cancel</span>";
            }
            $co .= "</center";

            return $co;
        })
        ->addColumn('in_out', function ($data) {
            $co2 = "";
            $co2 .= "<center>";
            $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
            $co2 .= "</center";

            return $co2;
        })
        ->addColumn('aksi', function ($data) {
            $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                    <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                            <i class='fas fa-chevron-right dropdown-arrow'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                            <a class='dropdown-item py-3' href='#'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Canceled
                                </div>
                            </a>
                            <a class='dropdown-item py-3' href='#'>
                                <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                                <div>
                                    <div class='small text-gray-500'>Update Status</div>
                                    Completed
                                </div>
                            </a>
                        </div>
                    </li>";
                $aksi .= "</center>";
            return $aksi;
        })
        ->rawColumns(['aksi', 'no_inv', 'name_hotel', 'status', 'in_out'])->make(true);
    }

    public function scopeDatatablesAll()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $data = self::with('hotel','hotel_room')->get();
        } elseif (Auth::user()->role_id == 3) {
            $data = self::with('hotel','hotel_room')->where('hotel.created_by', Auth::user()->id)->get();
        }

        // dd($data);

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('total_price', function($data){
            $no = "";
            // $no .= "<center>";
            $no .= "IDR ". number_format($data->total_price, 2);
            // $no .= "</center";

            return $no;
        })
        ->addColumn('no_inv', function ($data) {
            $no = "";
            $no .= "<center>";
            $no .= $data->no_invoice;
            $no .= "</center";

            return $no;
        })
        ->addColumn('name_hotel', function ($data) {
            $no = "";
            $no .= "<center>";
            $no .= "<span>". $data->hotel_room->hotelType->name . " Room " . " - " . $data->hotel->name ."</span>";
            $no .= "</center";

            return $no;
        })
        ->addColumn('status', function ($data) {
            $co = "";
            $co .= "<center>";
            if ($data->status == 0)
                $co .= "<span class='text-white badge' style='background: #890F0D; padding: 8px;'>Not Complete</span>";
            elseif ($data->status == 1) {
                $co .= "<span class='text-white badge' style='background: #125B50; padding: 8px;'>Complete</span>";
            }
            elseif ($data->status == 2) {
                $co .= "<span class='text-white badge' style='background: #F0A500; padding: 8px;'>Cancel</span>";
            }
            $co .= "</center";

            return $co;
        })
        ->addColumn('in_out', function ($data) {
            $co2 = "";
            $co2 .= "<center>";
            $co2 .= Carbon::parse($data->check_in)->format('d F Y') . " - " . Carbon::parse($data->check_out)->format('d F Y');
            $co2 .= "</center";

            return $co2;
        })
        ->addColumn('aksi', function ($data) {
            if ($data->status == 1)
            {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                    <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                        <i class='fas fa-chevron-right dropdown-arrow'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                        <a class='dropdown-item py-3' href='' target='_blank'>
                            <div class='icon-stack bg-primary-soft text-primary mr-4'><i class='fa fa-times'></i></div>
                            <div>
                                <div class='small text-gray-500'>Cancel</div>
                                Cancel Booking
                            </div>
                        </a>
                    </div>
                </li>";
                $aksi .= "</center>";
            }
            if ($data->status == 0)
            {
                $aksi = "";
                $aksi .= "<center>";
                $aksi .= "
                <li class='nav-item dropdown no-caret mr-3 d-none d-md-inline'>
                    <a class='nav-link dropdown-toggle' id='navbarDropdownDocs' href='javascript:void(0);' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <div class='d-none d-md-inline font-weight-500'>Update Status</div>
                        <i class='fas fa-chevron-right dropdown-arrow'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up' aria-labelledby='navbarDropdownDocs'>
                        <a class='dropdown-item py-3' href='' target='_blank'>
                            <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='book'></i></div>
                            <div>
                                <div class='small text-gray-500'>View</div>
                                View data details
                            </div>
                        </a>
                        <a class='dropdown-item py-3' href=''>
                            <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                            <div>
                                <div class='small text-gray-500'>Delete</div>
                                Delete data
                            </div>
                        </a>
                        <a class='dropdown-item py-3' href=''>
                            <div class='icon-stack bg-primary-soft text-primary mr-4'><i data-feather='code'></i></div>
                            <div>
                                <div class='small text-gray-500'>Update Status</div>
                                Active
                            </div>
                        </a>
                    </div>
                </li>";
                $aksi .= "</center>";
            }
            return $aksi;
        })
        ->rawColumns(['aksi', 'no_inv', 'name_hotel', 'status', 'in_out'])->make(true);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }

    public function hotel_room()
    {
        return $this->belongsTo(HotelTypeDetail::class, 'id_hotel_room');
    }
}
