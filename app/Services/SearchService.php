<?php


namespace App\Services;

use App\Models\User;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\JsonResponse;

class SearchService
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts(['es01:9200'])->build();
    }

    /**
     * @param String $input
     * @return JsonResponse
     */
    public function autofillUser($input)
    {
        $params = [
            'index' => 'users',
            'body' => [
                [],
                [
                    'query' => [
                        'regexp' => [
                            "name" => [
                                "value"=> ".*$input.*",
                                "flags" => "ALL",
                                "case_insensitive"=> false
                            ]
                        ]
                    ]
                ],
                [],
                [
                    'query' => [
                        'fuzzy' => [
                            'name' => [
                                'value' => $input,
                                'fuzziness' => 1,
                                'transpositions' => true
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->client->msearch($params)['responses'];
        $results = array_merge($response[0]['hits']['hits'], $response[1]['hits']['hits']);
        $cleanResults = array_intersect_key($results, array_unique(array_column($results, '_id')));

        if(!empty($cleanResults)){
            $users = User::with('ifSendRequest')->findMany(array_column($cleanResults, '_id'));
            $users->each(function($user){
                $user->makeHidden(['email_verified_at', 'created_at', 'updated_at']);
            });

            return response()->json($users);
        }

        return response()->json([]);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function indexUser(User $user)
    {
        $params = [
            'index' => 'users',
            'id' => $user->id,
            'body' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ];

        $params['client']['verbose'] = true;

        $this->client->index($params);

        return true;
    }
}
