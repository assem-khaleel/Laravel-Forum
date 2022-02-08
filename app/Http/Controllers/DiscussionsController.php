<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;
use Illuminate\Support\Facades\Route;
use LaravelForum\Reply;

class DiscussionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentRoute = Route::currentRouteName();

        return view('discussions.index', ['discussions' => Discussion::filterByChannels()->paginate(3), 'currentRoute' => $currentRoute]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->Description,
            'channel_id' => $request->channel,
        ]);

        session()->flash('success', 'Create Discussion Successfully');
        return redirect()->route('discussion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {

        $currentRoute = Route::currentRouteName();

        return view('discussions.show', [
            'discussion' => $discussion,
            'currentRoute' => $currentRoute
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply(Discussion $discussion, Reply $reply)
    {

        $discussion->markAsBestReply($reply);

        session()->flash('success', 'Marked as Best Reply');

        return redirect()->back();
    }
}