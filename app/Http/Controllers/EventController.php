<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
   public function index(Request $request){
       $events = new Event();

    //    $from = $request->from;
    //    $to = $request->to;

       return response()->json([
           "data" => $events->get()
            //    where("start_date", "<", $to)->
            //    where("end_date", ">=", $from)->

       ]);
   }

   public function store(Request $request){

    $event = new Event();

    $event->text = strip_tags($request->text);
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;
    $event->rec_type = $request->rec_type;
    $event->event_length = $request->event_length;
    $event->event_pid = $request->event_pid;
    $event->save();

    return response()->json([
        "action"=> "inserted",
        "tid" => $event->id
    ]);
}

public function show($id, Request $request){
    $event = Event::findOrFail($id);

    return response()->json([$event]);
}

public function update($id, Request $request){
    $event = Event::find($id);

    $event->text = strip_tags($request->text);
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;
    $event->rec_type = $request->rec_type;
    $event->event_length = $request->event_length;
    $event->event_pid = $request->event_pid;
    $event->save();

    return response()->json([
        "action"=> "updated"
    ]);
}

   public function destroy($id){
       $event = Event::find($id);
       $event->delete();

       return response()->json([
           "action"=> "deleted"
       ]);
   }
}
