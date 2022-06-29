<?php
//Class
class Word {
    // Properties
    public $word;
    public $definition;
    public $pronunciation;
  
    // Methods
    function __construct($word, $definition,$pronunciation) {
        $this->word = $word;
        $this->definition = $definition;
        $this->pronunciation = $pronunciation;
      }
    function set_word($word) {
      $this->word = $word;
    }
    function get_word() {
      return $this->word;
    }

    function set_definition($definition) {
        $this->definition = $definition;
      }
    function get_definition() {
        return $this->definition;
      }

      function set_pronunciation($pronunciation) {
        $this->pronunciation = $pronunciation;
      }
      function get_pronunciation() {
        return $this->pronunciation;
      }

     
  }
  //an other alternative is to have the object as jsonserialisable and import it to script