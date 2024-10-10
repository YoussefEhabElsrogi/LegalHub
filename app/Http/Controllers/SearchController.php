<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Procuration;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @desc Search for admins by name or email.
     * @router POST /search-admin
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAdmin(Request $request): JsonResponse
    {
        return $this->search(Admin::class, ['name', 'email'], $request, 'dashboard.search.search-admin');
    }

    /**
     * @desc Search for clients by name, phone, or national ID and return results as HTML.
     * @router POST /search-client
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchClient(Request $request): JsonResponse
    {
        return $this->search(Client::class, ['name', 'phone', 'national_id'], $request, 'dashboard.search.search-client');
    }

    /**
     * @desc Search for procurations by client or authorization_number and return results as HTML.
     * @router POST /search-procuration
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProcuration(Request $request): JsonResponse
    {
        return $this->search(Procuration::class, ['authorization_number','notebook_number'], $request, 'dashboard.search.search-procuration', true);
    }

    /**
     * @desc Search for sessions by client or session_number and return results as HTML.
     * @router POST /search-session
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchSession(Request $request): JsonResponse
    {
        return $this->search(Session::class, ['session_number'], $request, 'dashboard.search.search-session', true);
    }

    /**
     * @desc Search for expenses by client or expense_name and return results as HTML.
     * @router POST /search-expense
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchExpense(Request $request): JsonResponse
    {
        return $this->search(Expense::class, ['expense_name'], $request, 'dashboard.search.search-expense', true);
    }

    /**
     * @desc Search for company by client and return results as HTML.
     * @router POST /search-company
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchCompany(Request $request): JsonResponse
    {
        return $this->search(Company::class, [], $request, 'dashboard.search.search-company', true);
    }

    /**
     * @desc Common search function.
     * @param string $model
     * @param array $searchableFields
     * @param \Illuminate\Http\Request $request
     * @param string $view
     * @param bool $includeClient = false
     * @return \Illuminate\Http\JsonResponse
     */
    private function search(string $model, array $searchableFields, Request $request, string $view, bool $includeClient = false): JsonResponse
    {
        $this->ensureAjaxRequest($request);
        $search = $request->input('search', '');

        $query = $model::query();

        if ($includeClient) {
            $query->with('client')
                ->whereHas('client', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('national_id', 'LIKE', "%{$search}%");
                });
        }

        foreach ($searchableFields as $field) {
            $query->orWhere($field, 'LIKE', "%{$search}%");
        }

        $results = $query->orderByDesc('id')->paginate(10);

        return $this->renderResults($results, $view);
    }

    /**
     * @desc Render results or return "Nothing Found" response.
     * @param $results
     * @param string $view
     * @return \Illuminate\Http\JsonResponse
     */
    private function renderResults($results, string $view): JsonResponse
    {
        if ($results->isEmpty()) {
            return response()->json(['status' => 'Nothing Found']);
        }

        $html = view($view, ['results' => $results])->render();
        return response()->json(['html' => $html]);
    }

    /**
     * @desc Ensure the request is an AJAX request.
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function ensureAjaxRequest(Request $request): void
    {
        if (!$request->ajax()) {
            abort(400, 'Bad Request');
        }
    }
}
