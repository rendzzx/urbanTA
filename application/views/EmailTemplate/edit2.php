<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <link href="<?=base_url('css/plugins/summernote/summernote-bs3.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">

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
	<div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Edit Email</h3>
                <button class="btn btn-primary pull-right" style="margin-left: 10px; margin-top: -32px" id="send">Send Email</button>
                <button id="back" class="btn btn-primary pull-right" style="margin-top: -32px">Choose Tempalte</button>
            </div>
            <div class="panel-body" style="background-color: #E0E0E0;">
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
                <td style="background-color: #696969; padding: 10px">
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
                            	<div class="sk-spinner sk-spinner-wave">
        							<div class="sk-rect1"></div>
        							<div class="sk-rect2"></div>
        							<div class="sk-rect3"></div>
							        <div class="sk-rect4"></div>
							        <div class="sk-rect5"></div>
							    </div>	
								</div>
								<br>
								<button class="btn btn-primary" id="save">Save</button>
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
            </div>
        </div>
    </div>
</body>
</html>

<script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

		loaddata();

		$('#save').hide();
		$('#content').click(function(){
        	$('#content').summernote()
        	$('#save').show();
		})
		$('#save').click(function(){
			var code = $('#content').summernote('code');
			$('#content').summernote('code', code);
			$('#content').summernote('destroy')
        	$('#save').hide();
		})
		$('#back').click(function(){
			window.location.href = "<?php echo base_url("c_email"); ?>"
		})

		$('#send').click(function(){
            var id = "<?php echo $id; ?>"
            var code = $('#content').summernote('code');
            $('#content').summernote('destroy')
            $('#save').hide();
			var modalClass = $('#modal').attr('class');
	        switch (modalClass) {
	            case "modal fade bs-example-modal-md":
	                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
	                break;
	            case "modal fade bs-example-modal-sm":
	                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
	                break;
	            default:
	                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
	                break;
	        }

	        var modalDialogClass = $('#modalDialog').attr('class');
	        switch (modalDialogClass) {
	            case "modal-dialog modal-md":
	                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
	                break;
	            case "modal-dialog modal-sm":
	                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
	                break;
	            default:
	                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
	                break;
	        }

	        $('#modalTitle').html('Send Email');
	        

	        $('div.modal-body').load("<?php echo base_url("c_email/opensend");?>");

            $('#modal').data('code', code);
            $('#modal').data('footer', "");
	        $('#modal').data('id', id);
	        $('#modal').modal('show');
		})
		

    });

    function loaddata(){
    	var id = "<?php echo $id; ?>"
    	if (id > 0) {
                $.getJSON("<?php echo base_url('c_email/getByID');?>" + "/" + id, function (data) {
                    $('#content').html(data[0].Content_Html);
                });
            }
    }
</script>