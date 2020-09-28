<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    static $collectionRef;
    static $firestore;
    static $collection;
    static $document;

    static function setCollection($collectioName) {
        $factory = (new Factory())->withServiceAccount(base_path().DIRECTORY_SEPARATOR.env('FIREBASE_CREDENTIALS'));
        self::$firestore = $factory->createFirestore();
        self::$collectionRef = self::$firestore->database()->collection($collectioName);
        self::$collection = $collectioName;
    }

    static function setCollectionAndDocument($collectioName, $documentId) {
        self::setCollection($collectioName);
        self::setDocument($documentId);
    }

    static function setDocument($documentId) {
        self::$collectionRef = self::$collectionRef->document($documentId);
        self::$document = $documentId;
    }

    static function getData() {
        if(self::$document == null) {
            $documents = self::$collectionRef->documents();
            return $documents;
        } else {
            $data = self::$collectionRef->snapshot()->data();
            return $data;
        }
    }

    static function setDataToCollection($data_array) {
        self::$firestore->database()->collection(self::$collection)->document(self::$document)->set($data_array);
    }

    static function orderByColumn($columnName, $direction) {
        self::$collectionRef = (self::$collectionRef)->orderBy($columnName, $direction);
    }

    static function deleteDocument() {
        self::$firestore->database()->collection(self::$collection)->document(self::$document)->delete();
    }
}
