<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;

class AnnouncementController extends Controller
{

    public function index()
    {
        $announcements = Announcement::all();
        return view('user.announcements', compact('announcements'));
    }


    public function store(AnnouncementRequest $request)
    {
        $announcement = Announcement::create($request->validated());
        return $announcement;
    }


    public function destroy($id)
    {
        $announcement = Announcement::destroy($id);
        return $announcement;
    }
}
