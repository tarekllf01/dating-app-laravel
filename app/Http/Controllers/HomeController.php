<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
            $minDistance = (int)$request->distance;
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

        $data['users'] = $this->getNearesFriendsByLocation($lat,$long,$this->kmToDistanceUnite($minDistance),Auth::id(),$gender);
        $data['request'] = $request->all();
        return view('nearest-friends',$data);

    }


    public function map (User $user)
    {
        $data['user'] = $user;
        return view('map',$data);
    }

    public function chat (User $user)
    {
        $data['user'] = $user;
        $selfId = Auth::id();
        $userId = $user->id;
        
        $data['chats'] = Message::select('*')
                        ->where(function($query) use ($userId,$selfId) {
                            $query->where('sender_id',$userId)
                                ->where('receiver_id',$selfId);
                        })
                        ->orWhere(function ($query) use ($userId,$selfId) {
                            $query->where('sender_id',$selfId)
                                ->where('receiver_id',$userId);
                        })
                        ->orderBy('created_at','asc')
                        ->get();
                       
        
                                    
        // dd($data);
        return view('chat',$data);
    }

    public function sendMessage (User $user, Request $request)
    {
        if ($request->hasAny('message') && $request->message != "") {
            $newMsg = new Message;
            $newMsg->sender_id = Auth::id();
            $newMsg->receiver_id = $user->id;
            $newMsg->message = $request->message;
            $newMsg->save();
        }
        return back();
    }

    public function getLatestMessage (User $user,$lastID)
    {
        $selfId = Auth::id();
        $userId = $user->id;
        $chats= Message::select('*')
                                ->where('sender_id',$user->id)
                                ->where('receiver_id',Auth::id())
                                ->where('id','>',$lastID)
                                ->orderBy('created_at','asc')
                                ->get();
        return $chats;
    }

    public function getNearesFriendsByLocation ($lat,$long,$minDistance=3.10686,$userIDExcept=null,$gender=null)
    {
        return User::select('*')
                    ->when($userIDExcept, function($query, $userIDExcept){
                        return $query->where('id','!=',$userIDExcept);
                    })
                    ->when($gender,function ($query,$gender) {
                        return $query->where('gender',$gender);
                    })
                    ->addSelect(DB::raw("ST_Distance(
                        POINT('$long', '$lat'), POINT(longitude, latitude)) as distance"))
                    ->having('distance','<=',$minDistance)
                    ->orderBy('distance')
                    ->get();

    }


    private function kmToDistanceUnite ($distanceInKM)
    {
        return round(($distanceInKM * 0.621371)/100,5);
    }
    private function distanceUniteToKM ($distanceInDistanceUnite)
    {
        return round(($distanceInDistanceUnite/0.621371)*100,2);
    }


}
