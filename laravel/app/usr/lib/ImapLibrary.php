<?php
/**
* ImapLibrary  
* 
* Get  Internet Message Access Protocol (IMAP)  
* 
* @author Badiul Valentin
* @version 1.0.0
*/
 
class ImapLibrary {

    /**
    * @var int number of records on the monitor
    */
    const RECORDS = 101;
     
    /**
    * @var string hostname
    */
    private $hostname = '';

    /**
    * @var string username
    */
    private $username = '';

    /**
    * @var string password
    */
    private $password = '';

    /**
    * __construct
    * 
    * @param  string $hostname hostname
    * @param  string $username username
    * @param  string $password password
    * @return void
    */
    public function __construct( $hostname , $username , $password ) 
    { 
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
    }

    /**
    * tryToConnect - Open an IMAP stream to a mailbox and try to connect 
    * 
    * @param   void
    * @return  resource 
    */
    private function tryToConnect()
    {
        $imapOpen = imap_open( $this->hostname , $this->username , $this->password );
        if ( $imapOpen ) {
            return $imapOpen; 
        } else {
            throw new Exception(); 
        }
    }

    /**
    * grabEmails -  This function returns an array of messages matching the given search criteria
    * 
    * @param   void
    * @return  bool | array
    */
    private function grabEmails()
    {

        try {
            $inbox = $this->tryToConnect();
            $imapSearch = imap_search( $inbox , 'ALL' );
            $imapReturn = array();              
            rsort($imapSearch);
            $innerCount  = 0;
            foreach( $imapSearch as $emailNumber ) { 
                ++$innerCount;
                if ($innerCount == self::RECORDS ) {
                    break;
                } 
                /**
                *   Sequence will contain a sequence of message indices or UIDs, if this parameter is set to FT_UID.
                *    ()Root Message Part (multipart/related)
                *    (1) The text parts of the message (multipart/alternative)
                *    (1.1) Plain text version (text/plain)
                *    (1.2) HTML version (text/html)
                *    (2) The background stationary (image/gif)
                */
                $imapOptions = 0; // The text parts of the message (multipart/alternative)
                
                /* get information specific to a email */
                $overview    = imap_fetch_overview($inbox,$emailNumber , $imapOptions );
                $structure   = imap_fetchstructure($inbox, $emailNumber);

                if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
                    $part        = $structure->parts[1];
                    $imapOptions = 2;  // The background stationary (image/gif)
                    $message     = imap_fetchbody($inbox,$emailNumber , $imapOptions);
                    $application = 3;  // Application body type 
                    $multipart   = 1;  // Multipart   body type
                    if($part->encoding == $application) {
                        $message = imap_base64($message);
                    } else if($part->encoding == $multipart) {
                        $message = imap_8bit($message);
                    } else {
                        $message = imap_qprint($message);
                    }
                } 

                $imapOptions = 0; // The text parts of the message (multipart/alternative)
                $arrayName = array(
                    'imap_fetch_overview' => imap_fetch_overview( $inbox , $emailNumber , $imapOptions ),
                    'imap_fetchbody'      => $message 
                ); 
                array_push( $imapReturn , $arrayName );
            }
            imap_close( $inbox );
            return $imapReturn;
        } catch ( Exception $e ) {
            return false;
        }  
    }

    /**
    * getEmailsInfo  
    * 
    * @param   void
    * @return  bool | array
    */
    public function getEmailsInfo()
    {
        if ( $this->grabEmails() ) {
            return $this->grabEmails();
        } else {
            return false; 
        }
    }

}
 