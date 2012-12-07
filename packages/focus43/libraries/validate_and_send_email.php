<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    Loader::helper('validation/form');

    /**
     * This class includes mechanisms for both validation AND sending of emails.
     * 
     * @property MailHelper $mailHelper
     * @property Array $formData
     */
    class ValidateAndSendEmail extends ValidationFormHelper {
        
        protected $mailHelper;
        
        protected   $subjectIsSet = false,
                    $toIsSet      = false,
                    $fromIsSet    = false;
        
        public function __construct( array $formData = array() ){
            parent::__construct();
            $this->mailHelper = Loader::helper('mail');
            
            // takes the constructor input, and in the parent class, sets
            // $this->data = $formData
            $this->setData( $formData );
        }
        
        
        public function setSubject( $subject = 'Focus43 Site Submission' ){
            $this->subjectIsSet = true;
            $this->mailHelper->setSubject( $subject );
            return $this;
        }
        
        
        public function setTo( $to = 'stuff@focus-43.com' ){
            $this->toIsSet = true;
            $this->mailHelper->to( $to );
            return $this;
        }
        
        
        public function setFrom( $from = 'stuff@focus-43.com' ){
            $this->fromIsSet = true;
            $this->mailHelper->from( $from );
            return $this;
        }
        
        
        protected function testBeforeSending(){
            
            if( !$this->subjectIsSet ){
                $this->error->add('Email subject set improperly.');
            }
            
            if( !$this->toIsSet ){
                $this->error->add('Email recipient set improperly.');
            }
            
            if( !$this->fromIsSet ){
                $this->error->add('Email sender set improperly.');
            }
            
            return (bool) parent::test();
        }
        
        
        /**
         * To compose the body of the message, we take the name attribute
         * and value attribute (eg. name="firstName" value="Jonathan Hartman")
         * and create a string like {name}: {value} \n\n
        */
        protected function assembleMessageFromInputs(){
            $body = array_map(function($key, $val){
                return ucfirst($key) . ": {$val}";
            }, array_keys($this->data), array_values($this->data));

            $body = implode("\n\n", $body);
            
            $this->mailHelper->setBody($body);
        }
        
        
        public function sendEmail(){
            $this->assembleMessageFromInputs();
            
            if( (bool)$this->testBeforeSending() ){
                try{
                    $this->mailHelper->sendMail();
                }catch(Zend_Mail_Exception $e){
                    $this->error->add( $e->getMessage() );
                }
            }
        }
        
        
        public function sentOK(){
            return (bool) ((int)count($this->fieldsInvalid) === 0);
        }
        
    }
