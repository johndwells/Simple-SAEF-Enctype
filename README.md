# Simple-SAEF-Enctype

Add "multipart/form-data" to your SAEF forms. For ExpressionEngine 1 &amp; 2.

EE2 compatibility thanks to Carl W Crawley, Made by Hippo LTD ([www.madebyhippo.com](http://www.madebyhippo.com)).

===================

## Usage
The following forum post explains the origins and concept behind the extension: [http://expressionengine.com/archived_forums/viewthread/122306/](http://expressionengine.com/archived_forums/viewthread/122306/).


    {exp:weblog:entry_form
        weblog="your-weblog"
        return="/send/here/after"
        enctype="multi"
        }
        ......
    {/exp:weblog:entry_form}