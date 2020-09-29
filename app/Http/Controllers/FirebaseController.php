<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    private $collectionRef, $firestore, $collection, $document;

    function setCollection($collectioName) {
        $factory = (new Factory())->withServiceAccount(base_path().DIRECTORY_SEPARATOR.env('FIREBASE_CREDENTIALS'));
        $this->firestore = $factory->createFirestore();
        $this->collectionRef = $this->firestore->database()->collection($collectioName);
        $this->collection = $collectioName;
    }

    function setCollectionAndDocument($collectioName, $documentId) {
        $this->setCollection($collectioName);
        $this->setDocument($documentId);
    }

    function setDocument($documentId) {
        $this->collectionRef = $this->collectionRef->document($documentId);
        $this->document = $documentId;
    }

    function getData() {
        if($this->document == null) {
            $documents = $this->collectionRef->documents();
            return $documents;
        } else {
            $data = $this->collectionRef->snapshot()->data();
            return $data;
        }
    }

    function setDataToCollection($data_array) {
        $this->firestore->database()->collection($this->collection)->document($this->document)->set($data_array);
    }

    function orderByColumn($columnName, $direction) {
        $this->collectionRef = ($this->collectionRef)->orderBy($columnName, $direction);
    }

    function deleteDocument() {
        $this->firestore->database()->collection($this->collection)->document($this->document)->delete();
    }
}
