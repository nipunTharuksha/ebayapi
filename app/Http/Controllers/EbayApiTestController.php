<?php

namespace App\Http\Controllers;

use App\EbayApiTest;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class EbayApiTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch all available item numbers from DB table
        $ebayItemIDs = EbayApiTest::all();

        $appid = 'testmedi-testform-PRD-7387e50aa-57bd40f2';  //Your  appid

        $variableForFrontEnd = []; // creating a empty array to store data . This variable will be passed to view
        //looping
        foreach ($ebayItemIDs as $ebayItem) {
            $client = new Client();  //  Initializing  a  new  client
            //code  from    Guzzle  documentation and ebay  developer  documentation
            $result = $client->request('GET', 'http://open.api.ebay.com/shopping?'
                . 'callname=GetSingleItem&'
                . 'responseencoding=XML&'
                . 'appid=' . $appid . '&'
                . 'siteid=0&'
                . 'version=967&'
                . 'ItemID=' . $ebayItem->ebay_item_id . '&'
                . 'IncludeSelector=ItemSpecifics,ShippingCosts,Details');
            //Sins  $result  return  XML  string  I  use  simplexml_load_string()  method  to  convert  it  into  a  object
            $xml = simplexml_load_string($result->getBody());
            //Now  I  use json_encode()  to  convert  $xml  into  a  JSON string
            $json = json_encode($xml);
            //Now  I  decode $json  into  a  array  with  using  json_decode($val,  TRUE)  .  RATHER  THAN  WORKING  WITH  AN  OBJECT  I  FEEL  ARRAY  IS  MUCH  EASY.
            $jsonResultToArray = json_decode($json, TRUE);
            //push values to array
            array_push($variableForFrontEnd, $jsonResultToArray['Item']);
        }
        return view('index', ['variableForFrontEnd' => $variableForFrontEnd]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EbayApiTest  $ebayApiTest
     * @return \Illuminate\Http\Response
     */
    public function show(EbayApiTest $ebayApiTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EbayApiTest  $ebayApiTest
     * @return \Illuminate\Http\Response
     */
    public function edit(EbayApiTest $ebayApiTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EbayApiTest  $ebayApiTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EbayApiTest $ebayApiTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EbayApiTest  $ebayApiTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(EbayApiTest $ebayApiTest)
    {
        //
    }
}
