<?php

namespace Nuwave\Lighthouse\Support\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nuwave\Lighthouse\Schema\Context;

class GraphQLController extends Controller
{
    /**
     * Inject middleware into request.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // TODO: Query for middleware
        // if ($query = $request->get('query')) {
        //     $middleware = app('graphql')->schema()
        //         ->parse($query)
        //         ->middleware();
        //
        //     $this->middleware($middleware->toArray());
        // }
    }

    /**
     * Execute graphql query.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function query(Request $request)
    {
        $query = $request->input('query');
        $variables = $request->input('variables');

        if (is_string($variables)) {
            $variables = json_decode($variables, true);
        }

        return graphql()->execute(
            $query,
            new Context($request, auth()->user()),
            $variables
        );
    }
}