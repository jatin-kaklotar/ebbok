<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $apiUrl, $token;

    const NUMBER_OF_ITEM_PER_PAGE = 9;

    public function __construct()
    {
        $this->apiUrl = config('app.PACKT_API_URL') ;
        $this->token = config('app.PACKT_TOKEN') ;
    }

    private function getProductRecords($limit, $page = 1)
    {
        $response=  Http::get($this->apiUrl . "products", [
            'limit' => $limit,
            'page' => $page,
            'token' => $this->token
        ])->json();
        $this->setErrorLogOfApi($response);
        return $response;
    }

    public function getProductList(Request $request)
    {
        $currentPageNumber = $request->page ?? 1;
        $prevPageNumber = null;
        $nextPageNumber = null;
        $data = [];
        $result = $this->getProductRecords(self::NUMBER_OF_ITEM_PER_PAGE, $currentPageNumber);
        $productArr = data_get($result, 'products');
        if ($productArr) {
            foreach ($productArr as $key => $value) {
                $data[$key]['title'] = $value['title'];
                $data[$key]['authors_name'] = collect($value['authors'])->implode(',');
                $data[$key]['publication_date'] = $this->getFormatedDate($value['publication_date']);
            }
            $nextPageUrl = data_get($result, 'next_page_url');
            $prevPageUrl = data_get($result, 'prev_page_url');
            $prevPageNumber = substr($prevPageUrl, strpos($prevPageUrl, 'page=') + 5) ?? null;
            $nextPageNumber = substr($nextPageUrl, strpos($nextPageUrl, 'page=') + 5) ?? null;
        }
        return view('product.index', compact('data', 'prevPageNumber', 'nextPageNumber'));
    }
}
