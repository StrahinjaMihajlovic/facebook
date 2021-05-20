<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function autofillUsers(Request $request)
    {
        $request->validate([
            'query' => 'string|required'
        ]);

        return $this->searchService->autofillUser($request->input('query'));
    }

    public function indexUser(User $user){
        return $this->searchService->indexUser($user);
    }
}
