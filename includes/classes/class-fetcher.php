<?php

namespace Tokofetcher;

use Throwable;

final class Fetcher {

    private static function request( $ep, $request_data ){
        try{
            $options = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_TIMEOUT        => 2,
                CURLOPT_MAXREDIRS      => 5,
                CURLINFO_HEADER_OUT    => true,
                CURLOPT_FAILONERROR    => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_POSTFIELDS     => $request_data,
                CURLOPT_COOKIE         => '_gid=GA1.2.1876651544.1659638713; lang=id; _gcl_au=1.1.578582559.1659638721; DID=8f5a3b33dc6d8b74ddf6b6a6a83f3bd0cb3ab689bb5d8de06432215be5136e59e097c9f76d4babef368670979f6865f7; DID_JS=OGY1YTNiMzNkYzZkOGI3NGRkZjZiNmE2YTgzZjNiZDBjYjNhYjY4OWJiNWQ4ZGUwNjQzMjIxNWJlNTEzNmU1OWUwOTdjOWY3NmQ0YmFiZWYzNjg2NzA5NzlmNjg2NWY347DEQpj8HBSa+/TImW+5JCeuQeRkm5NMpJWZG3hSuFU=; CSHLD_SID=dfbe0222141bc1a514457dd44382cfe9de223127084d914b6f909512859441c7; __auc=0854c7e91826a2d33adbfe83890; S_L_d67dbdd0a194e17d499a674fe8f3d081=a2a4dbbef72af475cef8d750680c8805~20221103014756; l=1; aus=1; FPF=1; lasty=6; tuid=214912683; _tu_prod=214912683; uidh=GL2Tiqiw9FKT1Cc+AG092iksN6Od8OBhngWP4tg7ljU=; _SID_Tokopedia_=sjHPyXXQA_BDgABCWJJaJrCEm6D2uwnAshe3D-YUOes3fS32PqApwlwi3VKUy1gpVzfDgml9H7bZk4Z7OeKVDimQdaYgET8a64nuUQ3n-UbXeOoi9oL0ya67xdKlPyvj; _UUID_CAS_=5020bdbe-3f07-4247-bce6-7bb4a36a267b; TOPATK=5T5p0ahpQlKRFsW594tmcA; uide=aVdQ4BJ+DwgH7paeNMm7EJRb4p47x7wRTPp4cCIQpr9/dQ3QIA==; _UUID_NONLOGIN_=43c94774314b73f3587de1dfbbc65744; NR_SID=NRl6grrj2rf5kbh9; _jxx=0b3f9d40-14e8-11ed-b9c4-19828b85082a; _jx=0b3f9d40-14e8-11ed-b9c4-19828b85082a; _CASE_=2f76301d30766e666663607876351d30766e647876383638766e761e353f35262035740421273520767876371d30766e6563627876383b3a33766e76767876383520766e7676787624173b766e76767876231d30766e65666665646763617876271d30766e6565616764616367787627002d2431766e76663c767876233c27766e760f2f0876233526313c3b2127310b3d3008766e6566666564676361780876273126223d37310b202d243108766e0876663c08767808760b0b202d24313a35393108766e0876033526313c3b21273127087629782f0876233526313c3b2127310b3d3008766e64780876273126223d37310b202d243108766e087665613908767808760b0b202d24313a35393108766e0876033526313c3b212731270876290976787638012430766e766664666679646c7964620064646e61636e656d7f64636e64647629; _fbp=fb.1.1659722296434.814561684; _ga=GA1.2.1480158429.1659638713; webauthn-session=6a022e20-2e48-41e7-a816-171990bc7abf; _ga_70947XW48P=GS1.1.1659810098.6.1.1659810154.4; _abck=10D00AB9B4C03D8A0D7BAAEC97586D23~-1~YAAQzN5FaDv7X2KCAQAAJZesdwibHULv1tDw0ORlfLe+aasCRgE50nzvDdK9W419+src3OrPmV4lbCLUCXR6iolLPZhSAP4EODkBrrrNNljs40s/ZW3ACWQhRU9CAEweamu60fjRUlqr9pSlE3PxC9BlqDkrELmJtfb96LTQJwB9l6I7FAFLqzgIhPxx4VmEKdOYYK9a1VMkHW+IvthwWpJ++VB9vYgbNUS4NyRqMXUFSnXXaI/3XFUqY48ZdA/JsaLYlGyFiBZea8fyLY+5S0TlntMcyatqXfIJIx6tq6pJ2wdpkKBoWLpvA4eY4SrV0TgCsDijYK9lLUX5G//NQhmX6JVLFHfVC1sVWvQTaVAgQSj1jff2D7vqZ+ec1xW96fDT8yN1ZS/fAJd8RBbMqviPY3BWyUF2s4VW~-1~-1~-1; bm_sz=EB09EADF5918E82328FBBFB9A811DDFD~YAAQzN5FaDz7X2KCAQAAJZesdxD+2/Y7iAFoVxjuxTZAP0zL9lkKVAOBiL1Qdiz5ubgIS+nkRR+NBfz8X/DHt4Fdrf1Nc/ks6hACc+F7XS29821l9VM0xs0XFMz2FEEJKdO4cdyMlvN6FB4ZWuFSQi0SNfE5pLtRKpvA+nc8ss5FSbcH1yGt/Pry8zkCoyUQGCMESbBEBe/p0+0QcQaf2oLM9A1+IBJeNqAFze2YkgJtB7x28DFAkoHa9MizEDOpZZB2D/xmpDmfNEOKxYpL90KqBwRCzBt4eU/zstQHIpGj6o1rakY=~3162948~3425861'
            ];

            $ch      = curl_init( $ep );
            curl_setopt_array( $ch, $options );
            $rough_content = curl_exec( $ch );
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
            if( ! empty( $errmsg ) )
                throw new \Exception( $errmsg, $err );

            $header  = curl_getinfo( $ch );
            curl_close( $ch );

            $header_content = substr( $rough_content, 0, $header['header_size'] );
            $response = trim( str_replace( $header_content, '', $rough_content ) );

        }catch( Throwable $e ){
            $response = '{"error":"' . log( $e->getMessage() ) . '"}';
        } finally {
            return json_decode( $response, true );
        }
    }

    static function fetch_via_shell( $ep, $data ){
        exec(
            log( 'curl -i -X POST    -H "Content-Type:application/json"    -d \'' . $data . '\' ' .
                '--cookie   "_gid=GA1.2.1876651544.1659638713; lang=id; _gcl_au=1.1.578582559.1659638721; DID=8f5a3b33dc6d8b74ddf6b6a6a83f3bd0cb3ab689bb5d8de06432215be5136e59e097c9f76d4babef368670979f6865f7; DID_JS=OGY1YTNiMzNkYzZkOGI3NGRkZjZiNmE2YTgzZjNiZDBjYjNhYjY4OWJiNWQ4ZGUwNjQzMjIxNWJlNTEzNmU1OWUwOTdjOWY3NmQ0YmFiZWYzNjg2NzA5NzlmNjg2NWY347DEQpj8HBSa+/TImW+5JCeuQeRkm5NMpJWZG3hSuFU=; CSHLD_SID=dfbe0222141bc1a514457dd44382cfe9de223127084d914b6f909512859441c7; __auc=0854c7e91826a2d33adbfe83890; S_L_d67dbdd0a194e17d499a674fe8f3d081=a2a4dbbef72af475cef8d750680c8805~20221103014756; l=1; aus=1; FPF=1; lasty=6; tuid=214912683; _tu_prod=214912683; uidh=GL2Tiqiw9FKT1Cc+AG092iksN6Od8OBhngWP4tg7ljU=; _SID_Tokopedia_=sjHPyXXQA_BDgABCWJJaJrCEm6D2uwnAshe3D-YUOes3fS32PqApwlwi3VKUy1gpVzfDgml9H7bZk4Z7OeKVDimQdaYgET8a64nuUQ3n-UbXeOoi9oL0ya67xdKlPyvj; _UUID_CAS_=5020bdbe-3f07-4247-bce6-7bb4a36a267b; TOPATK=5T5p0ahpQlKRFsW594tmcA; uide=aVdQ4BJ+DwgH7paeNMm7EJRb4p47x7wRTPp4cCIQpr9/dQ3QIA==; _UUID_NONLOGIN_=43c94774314b73f3587de1dfbbc65744; NR_SID=NRl6grrj2rf5kbh9; _jxx=0b3f9d40-14e8-11ed-b9c4-19828b85082a; _jx=0b3f9d40-14e8-11ed-b9c4-19828b85082a; _CASE_=2f76301d30766e666663607876351d30766e647876383638766e761e353f35262035740421273520767876371d30766e6563627876383b3a33766e76767876383520766e7676787624173b766e76767876231d30766e65666665646763617876271d30766e6565616764616367787627002d2431766e76663c767876233c27766e760f2f0876233526313c3b2127310b3d3008766e6566666564676361780876273126223d37310b202d243108766e0876663c08767808760b0b202d24313a35393108766e0876033526313c3b21273127087629782f0876233526313c3b2127310b3d3008766e64780876273126223d37310b202d243108766e087665613908767808760b0b202d24313a35393108766e0876033526313c3b212731270876290976787638012430766e766664666679646c7964620064646e61636e656d7f64636e64647629; _fbp=fb.1.1659722296434.814561684; _ga=GA1.2.1480158429.1659638713; webauthn-session=6a022e20-2e48-41e7-a816-171990bc7abf; _ga_70947XW48P=GS1.1.1659810098.6.1.1659810154.4; _abck=10D00AB9B4C03D8A0D7BAAEC97586D23~-1~YAAQzN5FaDv7X2KCAQAAJZesdwibHULv1tDw0ORlfLe+aasCRgE50nzvDdK9W419+src3OrPmV4lbCLUCXR6iolLPZhSAP4EODkBrrrNNljs40s/ZW3ACWQhRU9CAEweamu60fjRUlqr9pSlE3PxC9BlqDkrELmJtfb96LTQJwB9l6I7FAFLqzgIhPxx4VmEKdOYYK9a1VMkHW+IvthwWpJ++VB9vYgbNUS4NyRqMXUFSnXXaI/3XFUqY48ZdA/JsaLYlGyFiBZea8fyLY+5S0TlntMcyatqXfIJIx6tq6pJ2wdpkKBoWLpvA4eY4SrV0TgCsDijYK9lLUX5G//NQhmX6JVLFHfVC1sVWvQTaVAgQSj1jff2D7vqZ+ec1xW96fDT8yN1ZS/fAJd8RBbMqviPY3BWyUF2s4VW~-1~-1~-1; bm_sz=EB09EADF5918E82328FBBFB9A811DDFD~YAAQzN5FaDz7X2KCAQAAJZesdxD+2/Y7iAFoVxjuxTZAP0zL9lkKVAOBiL1Qdiz5ubgIS+nkRR+NBfz8X/DHt4Fdrf1Nc/ks6hACc+F7XS29821l9VM0xs0XFMz2FEEJKdO4cdyMlvN6FB4ZWuFSQi0SNfE5pLtRKpvA+nc8ss5FSbcH1yGt/Pry8zkCoyUQGCMESbBEBe/p0+0QcQaf2oLM9A1+IBJeNqAFze2YkgJtB7x28DFAkoHa9MizEDOpZZB2D/xmpDmfNEOKxYpL90KqBwRCzBt4eU/zstQHIpGj6o1rakY=~3162948~3425861" ' .
            $ep ),
            $output,
            $exit_code
        );
        if( $exit_code !== 0 )
            return log( [ 'error' => $output ] );
        $response = end( $output );
        return json_decode( $response, true );
    }

    static function categories(){
        //return self::request( SOURCE['categories']['url'], SOURCE['categories']['query'] ); failed
        $result = self::fetch_via_shell( SOURCE['categories']['url'], SOURCE['categories']['query'] );
        if( ! isset( $result['error'] ) )
            $result = $result[0]['data']['categoryAllListLite']['categories'];
        return $result;
    }

    static function products( $category_id, $page = 1, $workers = 10 ){
        $query = preg_replace( [ '/%PAGE%/', '/%CAT%/' ], [ $page, $category_id ], SOURCE['products']['query'] );
        //return self::request( SOURCE['products']['url'], $query );
        $result = self::fetch_via_shell( SOURCE['products']['url'], $query );
        if( ! isset( $result['error'] ) )
            $result = $result[0]['data']['CategoryProducts'];
        return $result;
    }

}