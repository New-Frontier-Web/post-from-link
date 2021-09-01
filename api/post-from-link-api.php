<?php

class PostFromLink {

    function __construct($url) {

        $this->url = $url;
        $this->file_contents = '';
        $this->parsed_response = '';
        $this->file_get_contents_ssl($this->url);
        $this->parse_file_contents($this->url);

    }

    public function file_get_contents_ssl($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
        $result = curl_exec($ch);
        curl_close($ch);

        $this->file_contents = $result;

    }

    public function parse_file_contents($url) {

        $dirty_url = parse_url($this->url)['host']; // Get host of the intended URL
        $clean_url = str_replace(['www.', '.com'], '', $dirty_url); // Strip unecessary text and just return website name

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(htmlspecialchars_decode($this->file_contents));
        libxml_use_internal_errors(false);

        $content_array = array();

        if ( $clean_url == 'amazon') {

            $spans  = $dom->getElementsByTagName('span');
            $imgs   = $dom->getElementsByTagName('img');

            foreach( $spans as $span ) { // For each span
                if ( $span->hasAttributes()) { // Make sure the span has attributes
                    foreach( $span->attributes as $attr ) { // For each of those attributes

                        switch ($attr->nodeValue) { // If the value of the attribute is

                            case 'productTitle':
                                $content_array['title'] = $span->nodeValue;
                                break;
                            case 'author notFaded':
                                if (!isset($content_array['description'])) { // The reason for this is that the description kept getting overriden - this provides you with the very first instance
                                    $content_array['description'] = str_replace( ',', '', $span->textContent); // Remove the comma
                                }
                                break;
                        }
                    }
                }
            }

            foreach( $imgs as $img ) { // For each span
                if ( $img->hasAttributes()) { // Make sure the span has attributes
                    foreach( $img->attributes as $attr ) { // For each of those attributes

                        switch ($attr->nodeValue) { // If the value of the attribute is

                            case 'main-image':
                                $content_array['image'] = $img->getAttribute('src');
                                break;
                            case 'imgBlkFront':
                                $content_array['image'] = $img->getAttribute('src');
                                break;
                            case 'a-dynamic-image frontImage':
                                $content_array['image'] = $img->getAttribute('src');
                                break;
                        }

                    }
                }
            }

        }
        else {

            $divs = $dom->getElementsByTagName('meta');

            foreach ($divs as $div) { // Search through each meta element
                if ($div->hasAttributes()) { // if it has attributes (all do)
                    foreach($div->attributes as $attr) { // cycle through the attributes of the element
                        switch ($attr->nodeValue) {

                            case 'og:image':
                                $content_array['image'] = $div->getAttribute('content');
                                break;
                            case 'og:title':
                                $content_array['title'] = $div->getAttribute('content');
                                break;
                            case 'og:description':
                                $content_array['description'] = $div->getAttribute('content');
                                break;
                            case 'og:url':
                                $content_array['url'] = $div->getAttribute('content');
                                break;

                        }
                    }
                }
            }

        }

        $this->parsed_response = $content_array;

    }

    public function return_response() {

        return $this->parsed_response;

    }

}

$pfl = new PostFromLink($_POST['pfl-url']);
echo json_encode($pfl->return_response());
