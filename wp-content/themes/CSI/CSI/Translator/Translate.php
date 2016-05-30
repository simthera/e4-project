<?php

namespace CSI\Translator;


class Translate {
    protected static $translator = null;
    public $translated = array();

    static function t(){
        if(self::$translator === null){
            self::$translator = new Translate();
        }
        return self::$translator;
    }

    public function translate($afrikaans){
        $_SESSION['translate'] = true;
        if($_SESSION['translate'] == true){
            if(!count($this->translated)>0){
                $posts_array = get_posts( array('post_type'=>'translations') );
                foreach($posts_array as $key=>$val){
                    $english = get_post_meta( $val->ID, 'csi_english', true );

                    $this->translated[strtolower($val->post_title)] = $english;
                }
            }
            if(array_key_exists(strtolower($afrikaans),$this->translated)) {
                return ucfirst($this->translated[strtolower($afrikaans)]);
            }else{
                return $afrikaans;
            }

        }
    }
}