<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale 
    shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
       }
       /* If the above doesn't work, add a .g-img class to any image in question. */
       img.g-img + div {
           display: none !important;
       }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }

    </style>
    <!-- CSS Reset : END -->
	<!-- Reset list spacing because Outlook ignores much of our inline CSS. -->
	<!--[if mso]>
	<style type="text/css">
		ul,
		ol {
			margin: 0 !important;
		}
		li {
			margin-left: 30px !important;
		}
		li.list-item-first {
			margin-top: 0 !important;
		}
		li.list-item-last {
			margin-bottom: 10px !important;
		}
	</style>
	<![endif]-->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
	    .button-td-primary:hover,
	    .button-a-primary:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }
        }

    </style>
    <!-- Progressive Enhancements : END -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #F3F3F4;">
	<center style="width: 100%; background-color: #E0E0E0;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #E0E0E0;">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
Dear andi!

Greetings!!

Thank you for showing interest in SocietyConnect.

We will get in touch with you ASAP as per details shared by you.

Contact #+628129588675
Email: wilandi.chia@gmail.com


Sincerely,
Team SocietyConnect™ 			
						
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!-- Email Body : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
            <!-- Hero Image, Flush : BEGIN -->
            <tr>
                <td style="background-color: #696969;padding: 10px">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td align="center"><img src="http://35.198.219.220:2121/panen-web/img/logo.png" width="100"></td>
                            <td align="center"><img src="http://35.198.219.220:2121/panen-web/img/logo_3.png" width="100"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Hero Image, Flush : END -->

            <!-- 1 Column Text + Button : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                            	<div class="tooltip-demo">
<!-- <pre id="content" style="font-family: Century Gothic" data-html="true" data-toggle="popover" data-placement="right" data-content="<button id='edit' class='btn btn-primary'>Edit Content</button>"> -->
<!--                             		data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" -->
                            	<div id="content" style="font-family: Century Gothic">
                            		<?php echo $code ?>
								</div>
								<!-- <div>
									<p><img src="data:image/jpeg;base64,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" data-filename="test.jpg" style="width: 104px;"><br></p>
								</div> -->
							</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #696969;padding: 20px">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="font-family: Century Gothic; color: white;font-size: 12px;" align="center">Download Mobile App</td>
                            <td style="font-family: Century Gothic; color: white;padding-left: 185px;font-size: 12px;" colspan="2">For Any Further Assistance</td>
                        </tr>
                        <tr><td style="font-size: 2px">&nbsp;</td></tr>
                        <tr>
                        	<td align="center">
                        		<a href="https://play.google.com/store/apps/details?id=id.co.property365.waskita"><img src="http://35.198.219.220:2121/panen-web/img/email/android.png" width="20"></a>
                        		<img src="http://35.198.219.220:2121/panen-web/img/email/apple.png" width="20">
                        	</td>
                        	<td align="right" style="font-family: Century Gothic;">
                        		<img src="http://35.198.219.220:2121/panen-web/img/email/email.png" width="20">
                        	</td>
                            <td style="font-family: Century Gothic;color: white;font-size: 12px;">&nbsp;admin@ifca.co.id</td>
                        </tr>
                        <tr>
                            <td style="font-family: Century Gothic; color: white;font-size: 12px;" align="center">Follow Us On</td>
                            <td align="right" style="font-family: Century Gothic;padding-left: 105px">
                                <img src="http://35.198.219.220:2121/panen-web/img/email/telpon.png" width="20">
                            </td>
                            <td style="font-family: Century Gothic;color: white;font-size: 12px;">&nbsp;(021) 8282455</td>
                        </tr>
                        <tr>
                            <td align="center">
                                <img src="http://35.198.219.220:2121/panen-web/img/email/facebook.png" width="20">
                                &nbsp;
                                <img src="http://35.198.219.220:2121/panen-web/img/email/twitter.png" width="20">
                                &nbsp;
                                <img src="http://35.198.219.220:2121/panen-web/img/email/instagram.png" width="20">
                            </td>
                        </tr>
                    </table>
                    <!-- <hr> -->
                </td>
            </tr>
	    </table>
        <table align="center">
            <tr>
                <td><p style="font-family: Century Gothic;font-size: 12px;">Copyright © 2018 <span style="color: #FFA632">PT. IFCA Property365</span> Indonesia All Right Reserved</p></td>
                </tr>
        </table>
    </center>
</body>
</html>