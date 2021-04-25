<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends AbstractController
{

    public function getBordeaux(): array {
        $xml = file_get_contents("http://data.lacub.fr/wfs?key=9Y2RU3FTE8&SERVICE=WFS&VERSION=1.1.0&REQUEST=GetFeature&TYPENAME=ST_PARK_P&SRSNAME=EPSG:4326");
        
        $parkList = []; //an array of parkings with each one is also an array with 3 indices: 
        /*
        0 = The name
        0 = The X latitude
        0 = The Y longitude
        */

        $crawler = new Crawler($xml);

        $parkNames = $crawler->filter('wfs|FeatureCollection > gml|featureMember > bm|ST_PARK_P > bm|NOM')->each(function (Crawler $actualPark, $i) {
                return $actualPark->text();
        });

        $parkLats = $crawler->filter('wfs|FeatureCollection > gml|featureMember > bm|ST_PARK_P > bm|geometry > gml|Point > gml|pos')->each(function (Crawler $actualPark, $i) {
                return explode(' ', $actualPark->text())[0];
        });
        $parkLngs = $crawler->filter('wfs|FeatureCollection > gml|featureMember > bm|ST_PARK_P > bm|geometry > gml|Point > gml|pos')->each(function (Crawler $actualPark, $i) {
                return explode(' ', $actualPark->text())[1];
        });

        foreach($parkNames as $keyParkName=>$valueParkName) {
            foreach($parkLats as $keyParkLat=>$valueParkLat) {
                foreach($parkLngs as $keyParkLng=>$valueParkLng) {
                    if($keyParkName == $keyParkLat && $keyParkLat == $keyParkLng) {
                        $parkList[] = [$valueParkName, $valueParkLat, $valueParkLng];
                    }
                }
            }
        }
        
        return $parkList;
    }

    public function index(): Response
    {
        $bordeauxParks = $this->getBordeaux();
        return $this->render('default/index.html.twig', [
            'bordeauxParks' => $bordeauxParks
        ]);
    }
}