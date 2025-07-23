<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\DefaultWebController;
use App\Models\RealEstate\Amenity;
use Illuminate\Support\Facades\Cache;

class SchemaTools extends DefaultWebController {

    public bool $setBr;
    public string $lang;
    public string $langalternate;
    public string $lastamenities;
    public mixed $amenities;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function __construct(

        $setBr = true,
//        $StopeCash = 0 ,


    ) {
        parent::__construct();
        $this->setBr = $setBr;

        $this->lang = thisCurrentLocale();
        if ($this->lang == 'ar') {
            $this->langalternate = 'en';
            $this->lastamenities = 'تقسيط';
        } else {
            $this->langalternate = 'ar';
            $this->lastamenities = 'installment';
        }

        $this->amenities = self::cashAmenitiesList($this->is_cash);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Businesses() {
        $publisher_logo = defImagesDir('logo', 'photo');

        $line = "";
        $line .= '<script type="application/ld+json">{' . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "RealEstateAgent",' . self::PHP_MY_EOL();
        $line .= '"@id": "' . __('web/schema.b_url') . '",' . self::PHP_MY_EOL();

        if (count(config('app.web_lang'))) {
            $line .= '"name" : "' . $this->webConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
            $line .= '"alternateName": "' . $this->webConfig->translate($this->langalternate)->name . '",' . self::PHP_MY_EOL();
        } else {
            $line .= '"name" : "' . $this->webConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        }

        $line .= '"logo": "' . $publisher_logo . '",' . self::PHP_MY_EOL();
        $line .= '"image": "' . $publisher_logo . '",' . self::PHP_MY_EOL();
        $line .= '"url": "' . __('web/schema.b_url') . '",' . self::PHP_MY_EOL();
        $line .= '"telephone": "' . $this->webConfig->phone_call . '",' . self::PHP_MY_EOL();
        $line .= '"address": {' . self::PHP_MY_EOL();
        $line .= '"@type": "PostalAddress",' . self::PHP_MY_EOL();
        $line .= '"streetAddress": "' . __('web/schema.b_street_address') . '",' . self::PHP_MY_EOL();
        $line .= '"addressLocality": "' . __('web/schema.b_address_locality') . '",' . self::PHP_MY_EOL();
        $line .= '"postalCode": "' . __('web/schema.b_postal_code') . '",' . self::PHP_MY_EOL();
        $line .= '"addressCountry": "' . __('web/schema.b_address_country') . '",' . self::PHP_MY_EOL();
        $line .= '"addressRegion": "' . __('web/schema.b_address_region') . '"' . self::PHP_MY_EOL();
        $line .= '},' . self::PHP_MY_EOL();

        $line .= '"openingHoursSpecification": [' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Monday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Tuesday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Wednesday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Thursday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Friday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Saturday","opens": "10:00","closes": "18:00"},' . self::PHP_MY_EOL();
        $line .= '{"@type": "OpeningHoursSpecification","dayOfWeek": "Sunday","opens": "10:00","closes": "18:00"}' . self::PHP_MY_EOL();
        $line .= '],' . self::PHP_MY_EOL();
        $line .= '"priceRange": "1000000",' . self::PHP_MY_EOL();
        $line .= '"sameAs": [' . self::PHP_MY_EOL();

        if ($this->webConfig->facebook) {
            $line .= '"' . $this->webConfig->facebook . '",' . self::PHP_MY_EOL();
        }
        if ($this->webConfig->youtube) {
            $line .= '"' . $this->webConfig->youtube . '",' . self::PHP_MY_EOL();
        }
        if ($this->webConfig->twitter) {
            $line .= '"' . $this->webConfig->twitter . '",' . self::PHP_MY_EOL();
        }
        if ($this->webConfig->instagram) {
            $line .= '"' . $this->webConfig->instagram . '",' . self::PHP_MY_EOL();
        }

        $line .= '"' . __('web/schema.b_url') . '"' . self::PHP_MY_EOL();
        $line .= ']' . self::PHP_MY_EOL();
        $line .= '}</script>' . self::PHP_MY_EOL();

        return $line;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Article($row, $route) {

        $url = urldecode(route($route, [$row->category->slug, $row->slug]));
        $Photo = getPhotoPath($row->photo, 'blog', "photo");
        $publisher_logo = defImagesDir('logo', 'photo');


        $line = self::PHP_MY_EOL();
        $line .= '<script type="application/ld+json">' . self::PHP_MY_EOL();
        $line .= '{' . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "NewsArticle",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $url . '",' . self::PHP_MY_EOL();

        $line .= '"author": {' . self::PHP_MY_EOL();
        $line .= '"@type": "Website",' . self::PHP_MY_EOL();
        $line .= '"name": "' . $this->webConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $Photo . '"' . self::PHP_MY_EOL();
        $line .= '},' . self::PHP_MY_EOL();

        $line .= '"publisher":{' . self::PHP_MY_EOL();
        $line .= '"@type":"Organization",' . self::PHP_MY_EOL();
        $line .= '"name":"' . $this->webConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        $line .= '"logo":"' . $publisher_logo . '"' . self::PHP_MY_EOL();
        $line .= ' },' . self::PHP_MY_EOL();

        $line .= '"headline": "' . self::Clean($row->translate($this->lang)->name) . '",' . self::PHP_MY_EOL();
        $line .= '"mainEntityOfPage": "' . $url . '",' . self::PHP_MY_EOL();
        $line .= '"articleBody": "' . self::Clean($row->translate($this->lang)->g_des) . '",' . self::PHP_MY_EOL();
        $line .= '"image": "' . $Photo . '",' . self::PHP_MY_EOL();
        $line .= '"datePublished": "' . date(DATE_ATOM, strtotime($row->published_at)) . '",' . self::PHP_MY_EOL();
        $line .= '"dateModified": "' . date(DATE_ATOM, strtotime($row->updated_at)) . '"' . self::PHP_MY_EOL();

        $line .= '}' . self::PHP_MY_EOL();
        $line .= '</script>' . self::PHP_MY_EOL();

        return $line;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Project($row) {

        $Photo = getPhotoPath($row->photo, 'project', "photo");
        $url = urldecode(route("page_ListView", $row->slug));
        $This_AreaName = $row->location->name;
        $name = self::Clean($row->translate($this->lang)->name);
        $description = self::Clean($row->translate($this->lang)->g_des);
        if ($description == null) {
            $description = seoDesClean($row->translate($this->lang)->des);
        }

        $line = '<script type="application/ld+json">' . self::PHP_MY_EOL();
        $line .= "{" . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "SingleFamilyResidence",' . self::PHP_MY_EOL();
        $line .= '"name": "' . $name . '",' . self::PHP_MY_EOL();
        $line .= '"description": "' . $description . '",' . self::PHP_MY_EOL();
        $line .= '"image": "' . $Photo . '",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $url . '",' . self::PHP_MY_EOL();

        $line .= '"address": {"@type": "PostalAddress","addressCountry": "EG","addressRegion": "' . $This_AreaName . '"},' . self::PHP_MY_EOL();

        if ($row->latitude != null and $row->longitude != null) {
            $line .= '"geo": {"@type": "GeoCoordinates","latitude": "' . $row->latitude . '","longitude": "' . $row->longitude . '"},' . self::PHP_MY_EOL();
        }

        if (intval($row->price) > 0) {
            $line .= '"offers":[{"@type":"Offer","priceSpecification":{"@type":"UnitPriceSpecification","price":' . $row->price . ',"priceCurrency":"EGP","unitText":"sell"}}],' . self::PHP_MY_EOL();
        }

        if (is_array($row->amenity) and count($row->amenity) > 0) {
            $line .= '"amenityFeature": [';
            foreach ($this->amenities as $amenity) {
                if (in_array($amenity->id, $row->amenity)) {
                    $line .= '{"@type":"LocationFeatureSpecification","value": "true","name":"' . $amenity->name . '"},' . self::PHP_MY_EOL();
                }
            }
            $line .= '{"@type":"LocationFeatureSpecification","value": "true","name":"' . $this->lastamenities . '"}' . self::PHP_MY_EOL();
            $line .= ' ],';
        }

        $line .= '"telephone": "' . $this->webConfig->phone_call . '"' . self::PHP_MY_EOL();
        $line .= "}" . self::PHP_MY_EOL();
        $line .= '</script>' . self::PHP_MY_EOL();

        return $line;

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Units
//    public function  Units($row){
//
//        $Photo = getPhotoPath($row->photo,'project',"photo");
//        $url =  urldecode(route("page_ListView",$row->slug));
//        $This_AreaName = $row->locationName->name;
//        $name = self::Clean($row->translate($this->lang)->name) ;
//        $description = self::Clean($row->translate($this->lang)->g_des) ;
//        if($description == null){
//            $description = AdminHelper::seoDesClean($row->translate($this->lang)->des);
//        }
//
//        if($row->listing_type == 'Unit'){
//            $latitude = $row->projectName->latitude ;
//            $longitude = $row->projectName->longitude ;
//            $rowAmenity = $row->projectName->amenity ;
//        }else{
//            $latitude = $row->latitude ;
//            $longitude = $row->longitude ;
//            $rowAmenity = $row->amenity ;
//        }
//
//        $line = '<script type="application/ld+json">'.self::PHP_MY_EOL();
//        $line .= '{'.self::PHP_MY_EOL();
//        $line .= '"@context": "https://schema.org",'.self::PHP_MY_EOL();
//        $line .= '"@id": "'.$url.'",'.self::PHP_MY_EOL();
//        $line .= '"@type": ["ApartmentComplex","RealEstateListing","House"] ,'.self::PHP_MY_EOL();
//        $line .= '"name": "'.$name.'",'.self::PHP_MY_EOL();
//        $line .= '"description": "'.$description.'",'.self::PHP_MY_EOL();
//        $line .= '"image": "'.$Photo.'",'.self::PHP_MY_EOL();
//        $line .= '"url": "'.$url.'",'.self::PHP_MY_EOL();
//
//        if(intval($row->area)>0){
//            $line .= '"floorSize": {'.self::PHP_MY_EOL();
//            $line .= '"@type": "QuantitativeValue",'.self::PHP_MY_EOL();
//            $line .= '"value": '.$row->area.','.self::PHP_MY_EOL();
//            $line .= '"unitCode": "sqm"'.self::PHP_MY_EOL();
//            $line .= '},'.self::PHP_MY_EOL();
//        }
//
//        if(intval($row->baths) >0 ){
//            $line .= '"numberOfBathroomsTotal": '.$row->baths.','.self::PHP_MY_EOL();
//        }
//
//        if(intval($row->rooms) >0 ){
//            $line .= '"numberOfBedrooms": '.$row->rooms.' ,'.self::PHP_MY_EOL();
//        }
//
//        $line .= '"address": {"@type": "PostalAddress","addressCountry": "EG","addressRegion": "'.$This_AreaName.'"},'.self::PHP_MY_EOL();
//        if($latitude != null and $longitude != null){
//            $line .= '"geo": {"@type": "GeoCoordinates","latitude": "'.$latitude.'","longitude": "'.$longitude.'"},'.self::PHP_MY_EOL();
//        }
//
//        if(intval($row->price)>0){
//            $line .= '"offers":[{"@type":"Offer","priceSpecification":{"@type":"UnitPriceSpecification","price":'.$row->price.',"priceCurrency":"EGP","unitText":"sell"}}],'.self::PHP_MY_EOL();
//        }
//
//        if(is_array($rowAmenity)  and count($rowAmenity) > 0){
//            $line .= '"amenityFeature": [';
//            foreach($this->amenities as $amenity) {
//                if(in_array($amenity->id,$rowAmenity)){
//                    $line .= '{"@type":"LocationFeatureSpecification","value": "true","name":"'.$amenity->name.'"},' .self::PHP_MY_EOL();
//                }
//            }
//            $line .= '{"@type":"LocationFeatureSpecification","value": "true","name":"'. $this->lastamenities.'"}'.self::PHP_MY_EOL();
//            $line .= ' ],';
//        }
//
//        $line .= '"telephone": "'.$this->WebConfig->phone_call.'"'.self::PHP_MY_EOL();
//
//        $line .= '}'.self::PHP_MY_EOL();
//        $line .= '</script>'.self::PHP_MY_EOL();
//
//        return  $line ;
//
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Video($row) {
//        $publisher_logo = getDefPhotoPath($this->DefPhotoList, 'logo', 'photo');
        $publisher_logo = defImagesDir('logo', 'photo');
        $Photo = getPhotoPath($row->photo, 'project', "photo");
        $PageUrl = url()->full();
        $embedUrl = "https://www.youtube.com/embed/" . $row['youtube_url'];

        $line = '<script type="application/ld+json">' . self::PHP_MY_EOL();
        $line .= '{' . self::PHP_MY_EOL();
        $line .= '"@context": "https://schema.org",' . self::PHP_MY_EOL();
        $line .= '"@type": "VideoObject",' . self::PHP_MY_EOL();
        $line .= '"name": "' . self::Clean($row->translate($this->lang)->name) . '",' . self::PHP_MY_EOL();
        $line .= '"description": "' . self::Clean($row->translate($this->lang)->g_des) . '",' . self::PHP_MY_EOL();
        $line .= '"thumbnailUrl": "' . $Photo . '",' . self::PHP_MY_EOL();
        $line .= '"uploadDate": "' . date(DATE_ATOM, strtotime($row->created_at)) . '",' . self::PHP_MY_EOL();

        $line .= '"publisher": {' . self::PHP_MY_EOL();
        $line .= '"@type": "Organization",' . self::PHP_MY_EOL();
        $line .= '"name": "' . $this->webConfig->translate($this->lang)->name . '",' . self::PHP_MY_EOL();
        $line .= '"logo": {' . self::PHP_MY_EOL();
        $line .= '"@type": "ImageObject",' . self::PHP_MY_EOL();
        $line .= '"url": "' . $publisher_logo . '"' . self::PHP_MY_EOL();
        $line .= '}' . self::PHP_MY_EOL();
        $line .= '},' . self::PHP_MY_EOL();

        $line .= '"embedUrl": "' . $embedUrl . '",' . self::PHP_MY_EOL();
        $line .= '"contentUrl": "' . $PageUrl . '"' . self::PHP_MY_EOL();
        $line .= '}' . self::PHP_MY_EOL();
        $line .= '</script>' . self::PHP_MY_EOL();

        return $line;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PHP_MY_EOL() {
        if ($this->setBr) {
            return PHP_EOL;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Clean($Text) {
        $Text = self::strip_tags_content($Text);
        $Text = preg_replace("/\r|\n/", " ", $Text);
        return $Text;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function strip_tags_content($text, $tags = '', $invert = FALSE) {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);
        if (is_array($tags) and count($tags) > 0) {
            if ($invert == FALSE) {
                return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            } else {
                return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
            }
        } elseif ($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function cashAmenitiesList($cash = true) {
        if ($cash) {
            $location = Cache::remember("Amenity_CashList_" . app()->getLocale(), cashDay(1), function () {
                return Amenity::query()->with('translation')->get();
            });
        } else {
            $location = Amenity::query()->with('translation')->get();
        }
        return $location;
    }
}
