<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\TemporaryFile;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('user.announcements', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $this->createOrUpdate($request, null);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('admin.edit-announcements', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, $id)
    {
        $this->createOrUpdate($request, $id);
        return redirect()->route('admin.announcements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::destroy($id);
        return redirect()->route('admin.announcements.index');
    }



    private function createOrUpdate(AnnouncementRequest $request, ?int $id)
    {
        $announcement_photo = $request->input('photo');
        DB::transaction(function () use ($request, $announcement_photo, $id) {
            $announcement = Announcement::find($id);
            if (!$announcement_photo && $announcement) {
                $announcement->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'date' => Carbon::parse($request->date)->format('Y-m-d H:i')
                ]);
            }
            $temporaryFile = TemporaryFile::where('folder', $announcement_photo)->first();
            if ($temporaryFile) {
                $storage_path = storage_path('app/public/images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
                if ($announcement) {
                    $announcement->update([
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => Carbon::parse($request->date)->format('Y-m-d H:i')
                    ]);
                    $announcement->media()->delete();
                    $announcement->addMedia($storage_path)
                        ->toMediaCollection('images');
                }
                if (!$id || !$announcement) {
                    $announcement = Announcement::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => Carbon::parse($request->date)->format('Y-m-d H:i')
                    ]);
                    $announcement->addMedia($storage_path)
                        ->toMediaCollection('images');
                }
                rmdir(storage_path('app/public/images/tmp/' . $temporaryFile->folder));
                $temporaryFile->delete();
            }
        });
    }
}
