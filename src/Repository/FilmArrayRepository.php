<?php

namespace App\Repository;

class FilmArrayRepository {

     
    private $LISTE = array (
        1 => 
        array (
          'id' => 1,
          'title' => 'Asterix and the Gauls (Astérix le Gaulois)',
          'synopsis' => '',
          'genre' => 'Action|Adventure|Animation|Children|Comedy',
          'poster' => 'https://images2.medimops.eu/product/59c2c0/M02012100015-source.jpg',
        ),
        2 => 
        array (
          'id' => 2,
          'title' => 'God\'s Little Acre',
          'synopsis' => '',
          'genre' => 'Comedy|Drama|Romance',
          'poster' => 'http://dummyimage.com/101x129.png/ff4444/ffffff',
        ),
        3 => 
        array (
          'id' => 3,
          'title' => 'Mr. Blandings Builds His Dream House',
          'synopsis' => '部落格',
          'genre' => 'Comedy',
          'poster' => 'http://dummyimage.com/236x242.jpg/ff4444/ffffff',
        ),
        4 => 
        array (
          'id' => 4,
          'title' => 'Hatchet',
          'synopsis' => 'NULL',
          'genre' => 'Comedy|Horror',
          'poster' => 'http://dummyimage.com/151x138.png/dddddd/000000',
        ),
        5 =>
        array (
          'id' => 5,
          'title' => 'For Whom the Bell Tolls',
          'synopsis' => '',
          'genre' => 'Adventure|Drama|Romance|War',
          'poster' => 'http://dummyimage.com/239x112.jpg/ff4444/ffffff',
        ),
        6 => array (
          'id' => 6,
          'title' => 'Christmas in Connecticut',
          'synopsis' => 'בְּרֵאשִׁית, בָּרָא אֱלֹהִים, אֵת הַשָּׁמַיִם, וְאֵת הָאָרֶץ',
          'genre' => 'Comedy|Romance',
          'poster' => 'http://dummyimage.com/120x118.bmp/5fa2dd/ffffff',
        ),
        7 => 
        array (
          'id' => 7,
          'title' => 'Last Run, The',
          'synopsis' => '',
          'genre' => 'Comedy|Drama',
          'poster' => 'http://dummyimage.com/218x231.bmp/cc0000/ffffff',
        ),
        8 => 
        array (
          'id' => 8,
          'title' => 'Girl Who Leapt Through Time, The (Toki o kakeru shôjo)',
          'synopsis' => '',
          'genre' => 'Animation|Comedy|Drama|Romance|Sci-Fi',
          'poster' => 'http://dummyimage.com/132x182.bmp/cc0000/ffffff',
        )
    );
     public function getAll() {
        return $this->LISTE;
    }

    public function get($index) {
        foreach ($this->LISTE as $val) {
            if ($val['id'] == $index)
                return $val;
        }
        return null;
    }


}