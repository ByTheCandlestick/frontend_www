<?
    //mail customer
    $from = 'donotreply@'.$website_info['Domain'];
    $to = "rsmith_20@outlook.com";
    $subject = 'Your message has been received.';

    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $headers .= "From: The Sending Name <$from>\r\n";

    $msg = '<html>
                <head>
                    <link href="http://linktocss/.../etc" rel="stylesheet" type="text/css" />
                </head>
                <body>
                    formatted message...
                </body>
            </html>';
    mail($to, $subject, $msg, $headers)or die("mail error");
?>