<?php
session_start();
/*
--------------------------------------------------------------------------
Digistore24-Dankeseite-Beispiel
--------------------------------------------------------------------------

Author:  Christian Neise
Copyright: © 2020 Digistore24 GmbH, alle Rechte vorbehalten

Dies ist ein Beispiel-Skript für eine Digistore24-Dankeseite.
Digistore24 kann die Bestelldaten an die Dankeseite-URL anhängen und digital signieren.
(Sie aktivieren dies im Digistore24-Produkt-Editor.)

Dann prüft dieses Skript die digitale Signature mittels Ihres Dankeseite-Schlüssels.
So wird sichergestellt, dass die Bestelldaten authentisch sind.


LICENSE AGREEMENT / TERMS OF USAGE

You may use, modify, use the modified version of this file for the purpose of using
any webshop, billing system, web page, sales page or any other page with the
purpose of selling digital or physical goods with the Digistore24 GmbH.

THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS “AS IS” AND ANY EXPRESS OR IMPLIED WARRANTIES,
INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

// Stellen Sie sicher, dass hier Ihr Dankeseite-Schlüssel eingetragen ist
// genauso wie auf https://www.digistore24.com/settings/thank_you:
define( 'THANKYOU_PAGE_KEY', 'U6wbqjF7lTIShb9meGuZ' );



/**************************************************************************************************************************************************************************************************
 * Example data for decoding GET parameters:
 **************************************************************************************************************************************************************************************************
 *
         $querystring = 'yer_email=ds24fd8102faf4eeee5c9a2a70d2dff0ce36-VFN1L3ZvV290SDZ5RGpoNXRQNzl1OE1XMUdhR05EOFpXdFp3Zzh4empHQT0_e&payplan_id=ds2423be8af695370fdbd6b05108c6bc69a6-L285MVl2V3ZhUXJLT1phZGZ0MS82UT09&product_id=ds249720e5dc57ccf55ee1cc36b4fa191b3e-Q0xCT0taQW9rTklWVW1mNzN4ZDBjQT09&product_name=ds24abd7045dc7e600cbb2d1c3a3e5652efd-S29yTW1WcmhwMXp4eXJVQ2Q4YVdkZEgzaFUvZm44WUFDVUFCUVF0WnhMST0_e&quantity=ds24db9968675fff402c3a992f76563fff9b-OHBFRjhMT1hXZmNreVlTZnBJS0hvdz09&country=ds24628a6212b236d2873b1da4f1c12e4997-REJBUTJDcFIwZXU0SlE0cG9mNkxvdz09&buyer_language=ds24a94bfae7731cc0cb6e004306efeda32f-UVZETG5DQkUvT0NmdVMvWk1Fdld1dz09&buyer_id=ds24ab691b84e76059d5d8ca149306619a1e-dDFiNVNNTm45cHo3RzNHb1c5a2xrZz09&buyer_first_name=ds240b9b81088d74c603e3a8bc8f870c5065-am1XNW1PVGJUb3ZaRUdSbXZ0YW1WZz09&buyer_last_name=ds24d84edf0414f9871ecea01c8d131acafb-V0FmVE5lZnNCRVdpcjVIQ25KQ0pOUT09&billing_status=ds24de5c12b5d98df71033a09b08b7375196-R2JuQ2N1emdZL3NIc3NBY3EyY2ljQT09¤cy=ds24e1292ff8777e18195a50c107072f7a07-TCt3T1hYZ04rRW00NVZ1VTcwT0diUT09&amount=ds24f0922f4fca3adbca3b9f73ea64de1cca-ck9Fa2s5ajRCZGU4cDN2eXhQSmF4Zz09&vat_amount=ds248e5a60052f1b1563a3e6d31197f0b3ef-aHB0dXp2bWhEVmJ2cklZOVY0M2RaZz09&other_amounts=ds24b25ab21926f624256c0fe74a8800afb3-ZHFDYXBQOCtNUzFIUjNaZnI1YzBJdz09&other_vat_amounts=ds245c19d94d90bb7640fca3282a0195b718-ang2Mjl1L0lnOFJtaHArTnJkWmhEdz09&sha_sign=842486B8C793B57A237158836DEEC03B34BCC436C13BED1C8412E03317B3ABE314E8D4F8F19FB89FFD3C811DA4E1CD20BF15C43A897375B46C836CD2DBBC528A';

         $secret_key = 'some-secret-key';

         parse_str( $querystring, $encrypted_get_params );

         $get_params = digistore_decrypt_url_args( $secret_key, $encrypted_get_params );

//
//            Result: $get_params is:
//
//            Array
//            (
//                [order_id] => 848RCXR3
//                [order_item_id] => 15718726
//                [order_language] => en
//                [buyer_email] => Michael.TEST@digitest24.de
//                [payplan_id] => 45399
//                [product_id] => 20
//                [product_name] => Instant Happyness
//                [quantity] => 1
//                [country] => DE
//                [buyer_language] => en
//                [buyer_id] => 9420230
//                [buyer_first_name] => Michael
//                [buyer_last_name] => TEST
//                [billing_status] =>
//                [amount] => 297.50
//                [vat_amount] => 47.50
//                [other_amounts] => 595.00
//                [other_vat_amounts] => 95.00
//                [sha_sign] => 842486B8C793B57A237158836DEEC03B34BCC436C13BED1C8412E03317B3ABE314E8D4F8F19FB89FFD3C811DA4E1CD20BF15C43A897375B46C836CD2DBBC528A
//            )
//
*************************************************************************************************************************************************************************************************/


///////////////////////////////////////////////////////////////////////////
// Bitte unverändert lassen: 
define( 'DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX',    'ds24' );
define( 'DS24_ARRAY_ENCRYPTPTION_VALIDATION_CHAR_COUNT', 5 );
                  
function digistore_string_starts_with( $string, $substring )
{
    if ($substring==='') {
        return true;
    }
    
    if (strlen($string)<strlen($substring))
    {
        return false;
    }
    
    
    if ($string[0] != $substring[0])
    {
        return false;
    }
    
    return substr( $string, 0, strlen($substring) ) === $substring; 
    
}


function digistore_encrypt( $secret_key, $plain_text ) {

    if (empty($secret_key)) {
        $secret_key = DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX;
    }

    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);

    $iv = random_bytes( 16 );

    $output = openssl_encrypt( $plain_text, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);

    $output = str_replace( array( '=', '+' ), array( '_e', '_p' ), $output );

    $output = bin2hex($iv ) . '-' . $output;

    return $output;
}


function digistore_decrypt( $secret_key, $encrypted_string ) {

    if (empty($secret_key)) {
        $secret_key = DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX;
    }

    $encrypt_method = "AES-256-CBC";

    $secret_iv = $secret_key;
    $key = hash('sha256', $secret_key);

    $encrypted_string = str_replace( array( '_e', '_p' ), array( '=', '+' ), $encrypted_string );

    $is_iv_appended = strlen($encrypted_string) > 33 && $encrypted_string[32] === '-';

    if ($is_iv_appended) {
        $iv = @hex2bin( substr( $encrypted_string, 0, 32 ) );
        $encrypted_string = substr( $encrypted_string, 33 );

        if (empty($iv)) {
            return $encrypted_string;
        }
    }
    else {
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    }

    $plain_text = openssl_decrypt(base64_decode($encrypted_string), $encrypt_method, $key, 0, $iv);

    return $plain_text;
}

function digistore_encrypt_url_one_arg( $secret_key, $plaintext )
{
    if (empty($secret_key)) {
        $secret_key = DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX;
    }

    $len = DS24_ARRAY_ENCRYPTPTION_VALIDATION_CHAR_COUNT;

    $validation_prefix = $secret_key
                       ? mb_substr($secret_key,0,$len)
                       : '';

    return DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX.digistore_encrypt( $secret_key, $validation_prefix.$plaintext );
}

function digistore_decrypt_url_one_arg( $secret_key, $enrypted_string )
{
    if (!$enrypted_string) {
        return $enrypted_string;
    }

    $is_maybe_encrypted = digistore_string_starts_with( $enrypted_string, DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX );
    if (!$is_maybe_encrypted) {
        return $enrypted_string;
    }

    if (empty($secret_key)) {
        $secret_key = DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX;
    }

    $encrypted = mb_substr( $enrypted_string, strlen(DS24_ARRAY_ENCRYPTPTION_VALIDATION_PREFIX));

    $decrypted = digistore_decrypt( $secret_key, $encrypted );
    if (!$decrypted) {
        return false;
    }

    $len = DS24_ARRAY_ENCRYPTPTION_VALIDATION_CHAR_COUNT;

    $validation_prefix = $secret_key
                       ? mb_substr($secret_key,0,$len)
                       : '';

    $is_valid = $secret_key
              ? digistore_string_starts_with( $decrypted, $validation_prefix )
              : true;

    return $is_valid
           ? mb_substr( $decrypted, mb_strlen($validation_prefix) )
           : false;
}

function digistore_encrypt_url_args( $secret_key, $array, $keys_to_encrypt='all', $keys_to_not_encrypt=[] )
{
    foreach ($array as $key => &$value)
    {
        if (in_array($key,$keys_to_not_encrypt))
        {
            continue;
        }

        $must_encrypt = $keys_to_encrypt === 'all' || in_array( $key, $keys_to_encrypt );
        if ($must_encrypt) {
            $value = digistore_encrypt_url_one_arg( $secret_key, $value );
        }
    }

    return $array;
}

function digistore_decrypt_url_args( $secret_key, $array )
{
    foreach ($array as $key => &$value)
    {
        $value = digistore_decrypt_url_one_arg($secret_key, $value );
    }

    return $array;
}

function digistore_signature( $sha_passphrase, $parameters, $convert_keys_to_uppercase = false )
{
    $algorythm           = 'sha512';
    $sort_case_sensitive = true;

    if (!$sha_passphrase)
    {
        return 'no_signature_passphrase_provided';
    }

    unset( $parameters[ 'sha_sign' ] );
    unset( $parameters[ 'SHASIGN' ] );

    if ($convert_keys_to_uppercase)
    {
        $sort_case_sensitive = false;
    }

    $keys = array_keys($parameters);
    $keys_to_sort = array();
    foreach ($keys as $key)
    {
        $keys_to_sort[] = $sort_case_sensitive
                      ? $key
                      : strtoupper( $key );
    }

    array_multisort( $keys_to_sort, SORT_STRING, $keys );

    $sha_string = "";
    foreach ($keys as $key)
    {
        $value = $parameters[$key];

        $is_empty = !isset($value) || $value === "" || $value === false;
        if ($is_empty)
        {
            continue;
        }

        $upperkey = $convert_keys_to_uppercase
                  ? strtoupper( $key )
                  : $key;

        $sha_string .= "$upperkey=$value$sha_passphrase";
    }

    $sha_sign = strtoupper( hash( $algorythm, $sha_string) );

    return $sha_sign;
}

///////////////////////////////////////////////////////////////////////////






if (!$_GET)
{
    die( "FEHLER: Es wurden keine (Bestell-)Daten als GET-Parameter übergeben." );
}

$received_signature = isset( $_GET['sha_sign'] ) ? $_GET['sha_sign'] : false;
$expected_signature = digistore_signature( THANKYOU_PAGE_KEY, $_GET );

$sha_sign_valid = $received_signature == $expected_signature;

if ( !$sha_sign_valid )
{
    die( "FEHLER: Die digitale Signatur passt nicht zu den übergebenen Daten. Mögliche Fehler: (1) Falscher Dankeseite-Schlüssel (2) Sie überprüfen andere Daten als Digistore24 signiert hat." );
}

$DECRYPTED_GET_PARAMS = digistore_decrypt_url_args( THANKYOU_PAGE_KEY, $_GET );


// Ggf. persönliche Daten aus der Danke-Seite-Url entnehmen
$order_id = isset( $DECRYPTED_GET_PARAMS[ 'order_id' ] )
            ? $DECRYPTED_GET_PARAMS[ 'order_id' ]
            : '';
            
$email = isset( $DECRYPTED_GET_PARAMS[ 'buyer_email' ] )
            ? $DECRYPTED_GET_PARAMS[ 'buyer_email' ]
            : '';                 
            
$first_name = isset( $DECRYPTED_GET_PARAMS[ 'buyer_first_name' ] )
            ? $DECRYPTED_GET_PARAMS[ 'buyer_first_name' ]
            : '';           
            
// Liefern Sie hier Ihre Inhalte aus
$_SESSION['email'] = $email;
$_SESSION['vorname'] = $first_name;

header('Location: http://www.mathe-abi-vorbereitung.de/register/');
?>
<!-- <h1>Ihre gekauften Inhalte</h1>


<p>
    Bestell-ID:  <?=$order_id?><br />
    E-Mail:  <?=$email?><br />
    Vorname:  <?=$first_name?>
</p>     -->

