<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Exception\Auth\EmailExists;
use Kreait\Firebase\Exception\InvalidArgumentException;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    private $collectionRef, $firestore, $collection, $document, $auth;

    public function __construct()
    {
        $factory = (new Factory())->withServiceAccount(base_path() . DIRECTORY_SEPARATOR . env('FIREBASE_CREDENTIALS'));
        $this->firestore = $factory->createFirestore();
        $this->auth = $factory->createAuth();
    }

    function setCollection($collectionName)
    {
        $this->collectionRef = $this->firestore->database()->collection($collectionName);
        $this->collection = $collectionName;
    }

    function setCollectionAndDocument($collectionName, $documentId)
    {
        $this->setCollection($collectionName);
        $this->setDocument($documentId);
    }

    function setDocument($documentId)
    {
        $this->collectionRef = $this->collectionRef->document($documentId);
        $this->document = $documentId;
    }

    function getData()
    {
        if ($this->document == null) {
            $documents = $this->collectionRef->documents();
            return $documents;
        } else {
            $data = $this->collectionRef->snapshot()->data();
            return $data;
        }
    }

    function setDataToCollection($data_array)
    {
        $this->firestore->database()->collection($this->collection)->document($this->document)->set($data_array);
    }

    function orderByColumn($columnName, $direction)
    {
        $this->collectionRef = ($this->collectionRef)->orderBy($columnName, $direction);
    }

    function deleteDocument()
    {
        $this->firestore->database()->collection($this->collection)->document($this->document)->delete();
    }

    function deleteAuth($userId) {
        $this->auth->deleteUser($userId);
    }
}
