<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','twofactor']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $userTable = with(new User)->getTable();
        $data['users'] = User::where($userTable.'.id','!=',$id)
                            ->leftJoin(with(new UserInterest)->getTable().' as interest',function ($join) use ($userTable,$id) {
                                $join->on($userTable.'.id','=','interest.submitted_for_id')
                                    ->where('interest.submitted_by_id',$id);
                                })
                            ->select($userTable.'.*','interest.submitted_for_id','interest.is_interested')
                            ->where('interest.submitted_for_id',NULL)
                            ->get();
        
        return view('home',$data);
    }

    public function submitInterest ($id,$value)
    {
        $interest  = UserInterest::firstOrNew([
                                    'submitted_by_id'=> Auth::id(),
                                    'submitted_for_id'=>$id
                                ]);

        $interest->is_interested = $value==1?$value:0;
        $interest->save();
        if ($interest->is_interested == 1) {
            $interested = UserInterest::where('submitted_by_id',$id)
                                        ->where('submitted_for_id',Auth::id())
                                        ->where('is_interested', 1)
                                        ->first();
            if ($interested) {
                return back()->with([
                    'message' => 'Matched!!',
                    'alertType' => 'success',
                    'matched' => 1,
                ]);
            }
        }

        return back()->with([
            'message' => 'Interest submitted!!',
            'alertType' => 'success',
        ]);
        
    }



    public function nearestFriends (Request $request)
    {
        if ($request->hasAny('lat') && $request->hasAny('long') && $request->lat != "" && $request->long != "") {
            $lat = $request->lat;
            $long = $request->long;
        } else {
            $lat = Auth::user()->latitude;
            $long = Auth::user()->longitude;
        }
        if ($request->hasAny('distance') && $request->distance > 0) {
            $minDistance = (float)$request->distance;
        } else {
            $minDistance =5;
        }
        if ($request->hasAny('gender') && $request->gender != "") {
            $gender = strtolower($request->gender);
        } else {
            $gender = null;
        }


        $data['minDistance'] = $minDistance;
        $data['lat'] = $lat;
        $data['long'] = $long;
        $data['gender'] = $gender;

        $data['users'] = $this->getNearesFriendsByLocation($lat,$long,$minDistance,Auth::id(),$gender);
        $data['request'] = $request->all();
        return view('nearest-friends',$data);

    }


    public function map (User $user)
    {
        $data['user'] = $user;
        return view('map',$data);
    }

    public function getNearesFriendsByLocation ($lat,$long,$minDistance=5,$userIDExcept=null,$gender=null)
    {
        
        return User::select('*')
                    ->when($userIDExcept, function($query, $userIDExcept){
                        return $query->where('id','!=',$userIDExcept);
                    })
                    ->when($gender,function ($query,$gender) {
                        return $query->where('gender',$gender);
                    })
                    ->addSelect(DB::raw("ST_Distance(
                        POINT('$long', '$lat'), POINT(longitude, latitude)
                    ) as distance"))
                    ->having('distance','<=',$minDistance)
                    ->orderBy('distance')
                    ->get();
        
    }


}
