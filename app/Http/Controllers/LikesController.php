<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLikesRequest;
use App\Http\Requests\UpdateLikesRequest;
use App\Repositories\LikesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Likes;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class LikesController extends AppBaseController
{
    /** @var  LikesRepository */
    private $likesRepository;

    public function __construct(LikesRepository $likesRepo)
    {
        $this->likesRepository = $likesRepo;
    }

    /**
     * Display a listing of the Likes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $likes = $this->likesRepository->all();

        return view('likes.index')
            ->with('likes', $likes);
    }

    /**
     * Show the form for creating a new Likes.
     *
     * @return Response
     */
    public function create()
    {
        return view('likes.create');
    }

    /**
     * Store a newly created Likes in storage.
     *
     * @param CreateLikesRequest $request
     *
     * @return Response
     */
    public function store(CreateLikesRequest $request)
    {
        $input = $request->all();

        $likes = $this->likesRepository->create($input);

        Flash::success('Likes saved successfully.');

        return redirect(route('likes.index'));
    }

    /**
     * Display the specified Likes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $likes = $this->likesRepository->find($id);

        if (empty($likes)) {
            Flash::error('Likes not found');

            return redirect(route('likes.index'));
        }

        return view('likes.show')->with('likes', $likes);
    }

    /**
     * Show the form for editing the specified Likes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $likes = $this->likesRepository->find($id);

        if (empty($likes)) {
            Flash::error('Likes not found');

            return redirect(route('likes.index'));
        }

        return view('likes.edit')->with('likes', $likes);
    }

    /**
     * Update the specified Likes in storage.
     *
     * @param int $id
     * @param UpdateLikesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLikesRequest $request)
    {
        $likes = $this->likesRepository->find($id);

        if (empty($likes)) {
            Flash::error('Likes not found');

            return redirect(route('likes.index'));
        }

        $likes = $this->likesRepository->update($request->all(), $id);

        Flash::success('Likes updated successfully.');

        return redirect(route('likes.index'));
    }

    /**
     * Remove the specified Likes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $likes = $this->likesRepository->find($id);

        if (empty($likes)) {
            Flash::error('Likes not found');

            return redirect(route('likes.index'));
        }

        $this->likesRepository->delete($id);

        Flash::success('Likes deleted successfully.');

        return redirect(route('likes.index'));
    }

    public function like(Request $request) {

        if ($request->ajax()) {
            $like = new Likes;
            $like->post_id = $request['post_id'];
            $like->user_id = Auth::id();
            $like->save();

            return json_encode(['response' => true]);
        }
    }
        public function analyzeLike(Request $request) {
            if ($request ->ajax()){
                $like = Likes::where('post_id', $request['post_id'])
                             ->where('user_id', $request['user_id'])
                             ->get();
                             
                    if(count($like)){
                        Likes::where('post_id', $request['post_id'])
                             ->where('user_id', $request['user_id'])
                             ->delete();

                            return json_encode(['result' => 'unliked']);
                    }else{
                            return json_encode(['result' => 'liked']);
            }
        }
    }
}