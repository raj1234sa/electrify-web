<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    static $database;
    static $firestore;
    static $collection;
    static $document;

    static function setCollection($collectioName) {
        $factory = (new Factory())->withServiceAccount(base_path().DIRECTORY_SEPARATOR.env('FIREBASE_CREDENTIALS'));
        self::$firestore = $factory->createFirestore();
        self::$database = self::$firestore->database()->collection($collectioName);
        self::$collection = $collectioName;
    }

    static function setCollectionAndDocument($collectioName, $documentId) {
        self::setCollection($collectioName);
        self::setDocument($documentId);
    }

    static function setDocument($documentId) {
        self::$database = self::$database->document($documentId);
        self::$document = $documentId;
    }

    static function getData() {
        if(self::$document == null) {
            $documents = self::$database->documents();
            return $documents;
        } else {
            $data = self::$database->snapshot()->data();
            return $data;
        }
    }

    static function setDataToCollection($data_array) {
        self::$firestore->database()->collection(self::$collection)->document(self::$document)->set($data_array);
    }

    static function orderBy($columnName, $direction) {
        self::$database = self::$database->orderBy($columnName, $direction);
    }

    static function deleteDocument() {
        self::$firestore->database()->collection(self::$collection)->document(self::$document)->delete();
    }
}
