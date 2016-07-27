<?php

/**
 *
 * Simple API implementation for SendLane
 *
 * @author Matt Twardowski <mttwardowski@gmail.com>
 */

class SendLaneAPI {

    private $api_key;
    private $sendlaneURL;
    private $hash_key;


    public function __construct($sendlaneURL, $api_key, $hash_key) {
        $this->sendlaneURL = $sendlaneURL;
        $this->api_key = $api_key;
        $this->hash_key = $hash_key;
    }

    /**
     * This function will gather the lists in the SendLane account
     * and return it as a JSON
     * @return array containing list information
     */
    public function getLists() {

        //URL of the SendLaneAPI
        $url = $this->sendlaneURL;
        $url .= "/api/v1/lists";

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$this->api_key&hash=$this->hash_key");

        //execute post
        $result = curl_exec($ch);

        //close curl
        curl_close($ch);

        $result = json_decode($result);

        $listsArray = array();
        $pos = 0;
        foreach($result as $obj => $contents)
        {
            $listID = $contents->list_id;
            $listName = $contents->list_name;
            $arrayTemp = array('id' => $listID, 'name' => $listName);
            $listsArray[$pos] = $arrayTemp;
            $pos++;
        }

        return $listsArray;
    }

    /**
     * Adds a subscriber to a list (emailAddress Only)
     *
     * @param listID -- the id of the list to add email to
     * @param email -- address to add to the list
     * @return array cURL result object
     */

    public function addSubscriberToList($listID,$email) {

        //Create URL
        $url = $this->sendlaneURL;
        $url .= "/api/v1/list-subscribers-add";

        //Create cURL query
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$this->api_key&hash=$this->hash_key&email=$email&list_id=$listID");

        //Execute cURL
        $result = curl_exec($ch);

        //Convert JSON to object
        $result = json_decode($result);

        return $result;
    }


    /**
     * Gets lists and echos a string of option tags
     *
     * Mainly used for testing purposes to check for connection
     *
     */
    public function printAllLists() {

        $url = $this->sendlaneURL;
        $url .= "/api/v1/lists";

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$this->api_key&hash=$this->hash_key");

        //execute post
        $result = curl_exec($ch);

        curl_close($ch);


        $result=  json_decode($result);


        $list =NULL;
        foreach($result as $obj)
        {
            $name = $obj->list_name;
            $list_id = $obj->list_id;
            $list .="<option value='".$list_id."'>".$name."</option>";  // listed list in option os select tag
        }

        return $list;

    }



}
